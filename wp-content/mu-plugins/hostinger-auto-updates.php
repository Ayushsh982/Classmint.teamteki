<?php
/**
 * Plugin Name:       Hostinger Smart Auto Updates
 * Plugin URI:        https://www.hostinger.com
 * Description:       Faster and more secure updates for your themes, plugins, and core files. Managed entirely by Hostinger.
 * Version:           1.0.10
 * Author:            Hostinger
 * Author URI:        https://www.hostinger.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hostinger-auto-updates
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Network:           true
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Disable automatic updates
 */
add_filter( 'automatic_updater_disabled', '__return_true' ); // Core updates
add_filter( 'auto_update_theme', '__return_false' );         // Theme updates
add_filter( 'auto_update_plugin', '__return_false' );        // Plugin updates

/**
 * Endpoints used to serve package downloads and the WordPress.org API.
 */
if ( ! defined( 'HOSTINGER_CDN_DOWNLOAD_HOST' ) ) {
    define( 'HOSTINGER_CDN_DOWNLOAD_HOST', 'wpdownloads.hostinger.io' );
}

if ( ! defined( 'HOSTINGER_API_PROXY_HOST' ) ) {
    define( 'HOSTINGER_API_PROXY_HOST', 'wpapi.hostinger.io' );
}

/**
 * Anything smaller than this is an error page, not a package.
 */
if ( ! defined( 'HOSTINGER_MIN_PACKAGE_BYTES' ) ) {
    define( 'HOSTINGER_MIN_PACKAGE_BYTES', 1024 );
}

/**
 * Build the ordered list of endpoints to try for a downloads.wordpress.org URL.
 *
 * Every tier is a public HTTPS endpoint, so packages are authenticated by TLS
 * and requests keep WordPress's URL safety checks (wp_http_validate_url()),
 * including on redirects. Do not add plain-HTTP or loopback tiers here: on a
 * shared server any tenant can bind a free loopback port and serve a package.
 */
if ( ! function_exists( 'hostinger_download_tiers' ) ) {
    function hostinger_download_tiers( $url ) {
        $url = set_url_scheme( $url, 'https' );
        $tiers = [
            'hcdn' => str_replace( 'downloads.wordpress.org', HOSTINGER_CDN_DOWNLOAD_HOST, $url ),
        ];

        if ( ! defined( 'HOSTINGER_DISABLE_ORIGIN_FALLBACK' ) || ! HOSTINGER_DISABLE_ORIGIN_FALLBACK ) {
            $tiers['wporg'] = $url;
        }

        /**
         * Filter the download tiers.
         */
        return apply_filters( 'hostinger_download_tiers', $tiers, $url );
    }
}

/**
 * Whether the requested path looks like a zip archive.
 */
if ( ! function_exists( 'hostinger_url_is_zip' ) ) {
    function hostinger_url_is_zip( $url ) {
        $path = (string) wp_parse_url( $url, PHP_URL_PATH );

        return strtolower( substr( $path, -4 ) ) === '.zip';
    }
}

/**
 * Read the first bytes of a file.
 */
if ( ! function_exists( 'hostinger_read_file_head' ) ) {
    function hostinger_read_file_head( $file, $length ) {
        $handle = @fopen( $file, 'rb' );

        if ( ! $handle ) {
            return '';
        }

        $head = (string) fread( $handle, $length );
        fclose( $handle );

        return $head;
    }
}

/**
 * Decide whether a tier actually returned a usable package.
 *
 * This is a sanity check that catches error pages served with a 200 status. It
 * is not an integrity check; package authenticity comes from TLS on each tier.
 */
if ( ! function_exists( 'hostinger_inspect_response' ) ) {
    function hostinger_inspect_response( $response, $args, $url ) {
        $result = [
            'ok'     => false,
            'code'   => 0,
            'reason' => '',
        ];

        if ( is_wp_error( $response ) ) {
            $result['reason'] = $response->get_error_message();

            return $result;
        }

        $result['code'] = (int) wp_remote_retrieve_response_code( $response );

        if ( $result['code'] !== 200 ) {
            $result['reason'] = 'unexpected response code';

            return $result;
        }

        if ( ! empty( $args['stream'] ) && ! empty( $args['filename'] ) && file_exists( $args['filename'] ) ) {
            clearstatcache( true, $args['filename'] );

            $bytes = (int) filesize( $args['filename'] );
            $head  = hostinger_read_file_head( $args['filename'], 2 );
        } else {
            $body  = wp_remote_retrieve_body( $response );
            $bytes = strlen( $body );
            $head  = substr( $body, 0, 2 );
        }

        if ( $bytes < HOSTINGER_MIN_PACKAGE_BYTES ) {
            $result['reason'] = 'response too small to be a package';

            return $result;
        }

        if ( hostinger_url_is_zip( $url ) && $head !== 'PK' ) {
            $result['reason'] = 'response is not a zip archive';

            return $result;
        }

        $result['ok'] = true;

        return $result;
    }
}

/**
 * Empty the streaming target so a partial body cannot leak into the next tier.
 */
if ( ! function_exists( 'hostinger_reset_stream_target' ) ) {
    function hostinger_reset_stream_target( $args ) {
        if ( empty( $args['stream'] ) || empty( $args['filename'] ) || ! file_exists( $args['filename'] ) ) {
            return;
        }

        $handle = @fopen( $args['filename'], 'w' );

        if ( $handle ) {
            fclose( $handle );
        }
    }
}

/**
 * Fetch a package, walking the cache chain until one tier returns something usable.
 */
if ( ! function_exists( 'hostinger_fetch_package' ) ) {
    function hostinger_fetch_package( $args, $url ) {
        $response   = new WP_Error( 'hostinger_no_download_tier', 'No download endpoint available.' );
        $inspection = null;

        foreach ( hostinger_download_tiers( $url ) as $tier_url ) {
            $response   = wp_remote_request( $tier_url, $args );
            $inspection = hostinger_inspect_response( $response, $args, $url );

            if ( $inspection['ok'] ) {
                return $response;
            }

            hostinger_reset_stream_target( $args );
        }

        if ( ! is_wp_error( $response ) && is_array( $inspection ) ) {
            return new WP_Error(
                'hostinger_package_download_failed',
                sprintf( 'Package download failed: %s (HTTP %d).', $inspection['reason'], $inspection['code'] )
            );
        }

        return $response;
    }
}

/**
 * Send WordPress.org API traffic through Hostinger's proxy.
 */
if ( ! function_exists( 'hostinger_fetch_api' ) ) {
    function hostinger_fetch_api( $args, $url ) {
        $proxy_url = str_replace( 'api.wordpress.org', HOSTINGER_API_PROXY_HOST, $url );

        return wp_remote_request( $proxy_url, $args );
    }
}

/**
 * Use Hostinger's cache chain for WordPress.org API and download requests.
 */
if ( ! function_exists( 'hostinger_use_proxy_services' ) ) {
    function hostinger_use_proxy_services( $response_override, $args, $url ) {
        static $in_flight = false;

        if ( $in_flight ) {
            return $response_override;
        }

        $host = strtolower( (string) wp_parse_url( $url, PHP_URL_HOST ) );
        if ( $host !== 'downloads.wordpress.org' && $host !== 'api.wordpress.org' ) {
            return $response_override;
        }

        $in_flight = true;

        try {
            if ( $host === 'downloads.wordpress.org' ) {
                return hostinger_fetch_package( $args, $url );
            }

            return hostinger_fetch_api( $args, $url );
        } finally {
            $in_flight = false;
        }
    }
}

add_filter( 'pre_http_request', 'hostinger_use_proxy_services', 10, 3 );

/**
 * Modify the default auto-update tests.
 */
if ( ! function_exists( 'hostinger_change_default_autoupdates_test' ) ) {
    function hostinger_change_default_autoupdates_test( $tests ) {
        // Remove default auto-update tests
        unset( $tests['async']['background_updates'] );
        unset( $tests['direct']['plugin_theme_auto_updates'] );

        // Add a new test to indicate Hostinger manages updates
        $tests['direct']['hostinger_plugin_theme_auto_updates'] = [
            'label' => __( 'Auto-updates managed by Hostinger' ),
            'test'  => function () {
                $result = [
                    'label'       => __( 'Automatic updates managed by Hostinger' ),
                    'status'      => 'good',
                    'badge'       => [
                        'label' => __( 'Security' ),
                        'color' => 'blue',
                    ],
                    'description' => __( 'Automatic updates ensure your site is always running the latest and most secure versions of WordPress, plugins, and themes.' ),
                    'actions'     => '',
                    'test'        => 'hostinger_managed_updates',
                ];

                return $result;
            },
        ];

        return $tests;
    }
}

add_filter( 'site_status_tests', 'hostinger_change_default_autoupdates_test' );
