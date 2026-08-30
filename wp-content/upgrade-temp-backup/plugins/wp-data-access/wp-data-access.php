<?php

/**
 * Plugin Name:       WP Data Access
 * Plugin URI:        https://wpdataaccess.com/
 * Description:       A powerful data-driven App Builder with an intuitive Table Builder, a highly customizable Form Builder and interactive Chart support in 35 languages
 * Version:           5.5.81
 * Author:            Passionate Programmers B.V.
 * Author URI:        https://wpdataaccess.com/
 * Text Domain:       wp-data-access
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 *
 *
 * @package plugin
 * @author  Peter Schulz
 * @since   1.0.0
 */
use WPDataAccess\WPDA;
if ( !defined( 'WPINC' ) ) {
    die;
}
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Add freemius to WP Data Access.
if ( !function_exists( 'wpda_freemius' ) ) {
    // Load WPDataAccess namespace.
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
    /**
     * Create a helper function for easy SDK access
     *
     * @return Freemius
     */
    function wpda_freemius() {
        global $wpda_freemius;
        if ( !isset( $wpda_freemius ) ) {
            // Create a helper function for easy SDK access.
            require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
            $wpda_freemius = fs_dynamic_init( array(
                'id'               => '6189',
                'slug'             => 'wp-data-access',
                'type'             => 'plugin',
                'public_key'       => 'pk_fc2d1714ca61c930152f6e326b575',
                'is_premium'       => false,
                'premium_suffix'   => 'Premium',
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'trial'            => array(
                    'days'               => 14,
                    'is_require_payment' => false,
                ),
                'menu'             => array(
                    'slug'    => 'wpda_navi',
                    'contact' => false,
                    'network' => true,
                ),
                'is_live'          => true,
                'is_org_compliant' => true,
            ) );
        }
        return $wpda_freemius;
    }

    // Init Freemius.
    wpda_freemius();
    // Signal that SDK was initiated.
    do_action( 'wpda_freemius_loaded' );
    /**
     * Check if legacy tools are currently used on this server.
     * @return bool
     */
    function wpda_has_legacy_tools_inuse() {
        $option_legacy_tools = WPDA::get_option( WPDA::OPTION_PLUGIN_LEGACY_TOOLS );
        $has_legacy_tools = false;
        if ( !empty( $option_legacy_tools ) && is_array( $option_legacy_tools ) ) {
            foreach ( $option_legacy_tools as $tool ) {
                if ( isset( $tool[0] ) && $tool[0] === true && isset( $tool[1] ) && $tool[1] > 0 ) {
                    $has_legacy_tools = true;
                    break;
                }
            }
        }
        return $has_legacy_tools;
    }

    /**
     * Hook into the plugin_row_meta filter.
     * @param mixed $links Links.
     * @param mixed $file File.
     * @param mixed $data Data.
     * @return mixed
     */
    function wpda_row_meta(  $links, $file, $data  ) {
        if ( plugin_basename( __FILE__ ) == $file ) {
            // Add settings link.
            $settings_url = admin_url( 'options-general.php' ) . '?page=wpdataaccess';
            $settings_link = '<a href="' . esc_url( $settings_url ) . '">Settings</a>';
            array_push( $links, $settings_link );
            // phpcs:ignore -- 8.1 proof
            // Add comment for legacy users only
            if ( wpda_has_legacy_tools_inuse() ) {
                if ( isset( $data['new_version'] ) ) {
                    $new_version = $data['new_version'];
                    if ( version_compare( $new_version, '6.0', '>=' ) ) {
                        $notice = '
							<p style="margin-top: 10px; margin-bottom: 0; padding: 6px 10px; border-radius: 2px;"
								class="update-message notice inline notice-warning notice-alt"
							>
								<span class="dashicons dashicons-warning" style="color: #f0b849;"></span>
								<strong>Warning for legacy users:</strong> Version ' . esc_html( $new_version ) . ' (available now) removes legacy tools. 
								<strong style="color: #cc1818;">Stay on Version 5.x</strong> to keep using them. 
								<a href="https://docs.legacy.wpdataaccess.com/docs/deprecating/" target="_blank">Read more →</a>
							</p>';
                    } else {
                        $notice = '
							<p style="margin-top: 10px; margin-bottom: 0; padding: 6px 10px; border-radius: 2px;"
								class="update-message notice inline notice-info notice-alt"
							>
								<span class="dashicons dashicons-info" style="color: #3858e9;"></span>
								<strong>Info for legacy users:</strong> Version 6 is coming soon and removes legacy tools. 
								<strong>Stay on Version 5.x</strong> to keep using them. 
								<a href="https://docs.legacy.wpdataaccess.com/docs/deprecating/" target="_blank">Read more →</a>
							</p>';
                    }
                    $links[] = $notice;
                }
            }
        }
        return $links;
    }

    add_filter(
        'plugin_row_meta',
        'wpda_row_meta',
        10,
        3
    );
    /**
     * Remove last | character from plugin links.
     * @return void
     */
    function wpda_clean_plugin_row_script() {
        if ( !wpda_has_legacy_tools_inuse() ) {
            return;
        }
        ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var $row = $('tr[data-slug="wp-data-access"] .plugin-version-author-uri');
				if ($row.length) {
					$row.contents().each(function(index) {
						if (this.nodeType === 3 && index === 6) {
							this.nodeValue = this.nodeValue.replace(/\|/g, '');
						}
					});
				}
			});
		</script>
		<?php 
    }

    add_action( 'admin_footer-plugins.php', 'wpda_clean_plugin_row_script' );
    /**
     * Show legacy tools info widget.
     * @return void
     */
    function wpda_legacy_tools_notice_widget() {
        // Add widget for legacy users only
        if ( wpda_has_legacy_tools_inuse() ) {
            wp_add_dashboard_widget( 'wporg_dashboard_widget', 'WP Data Access - Info for legacy tools users', function () {
                ?>
						<p>
							Version 6 is coming soon and removes legacy tools.
						</p>
						<p>
                            <strong>To keep using the legacy tools:</strong><br>
							✓ Stay on the latest Version 5.x<br>
							✓ Disable auto-updates<br>
							✓ Do not update manually to Version 6
						</p>
						<p>
							<a href="https://docs.legacy.wpdataaccess.com/docs/deprecating/" target="_blank">Read more →</a>
						</p>
					<?php 
            } );
        }
    }

    add_action( 'wp_dashboard_setup', 'wpda_legacy_tools_notice_widget' );
    /**
     * Activate plugin
     *
     * @author  Peter Schulz
     * @since   1.0.0
     */
    function wpda_activate() {
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-access-switch.php';
        WP_Data_Access_Switch::activate();
    }

    register_activation_hook( __FILE__, 'wpda_activate' );
    /**
     * Deactivate plugin
     *
     * @author  Peter Schulz
     * @since   1.0.0
     */
    function wpda_deactivate() {
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-access-switch.php';
        WP_Data_Access_Switch::deactivate();
    }

    register_deactivation_hook( __FILE__, 'wpda_deactivate' );
    /**
     * Check if database needs to be updated
     *
     * @author  Peter Schulz
     * @since   1.5.2
     */
    function wpda_update_db_check() {
        if ( get_option( WPDataAccess\WPDA::OPTION_WPDA_VERSION[0] ) !== WPDataAccess\WPDA::OPTION_WPDA_VERSION[1] ) {
            wpda_activate();
        }
    }

    add_action( 'plugins_loaded', 'wpda_update_db_check' );
    /**
     * Uninstall blog
     *
     * This functions is called when the plugin is uninstalled. The following actions are performed:
     * + Drop plugin tables (unless settings indicate not to)
     * + Delete plugin options from $wpdb->options (unless settings indicate not to)
     * + Unscheduled all WP Data Access events
     *
     * Actions are processed on the current blog and are repeated for every blog on a multisite installation. Must be
     * called from the dashboard (WP_UNINSTALL_PLUGIN defined). User must have the proper privileges (activate_plugins).
     *
     * @author      Peter Schulz
     * @since       1.0.0
     */
    function wpda_uninstall_blog() {
        global $wpdb;
        $drop_tables = get_option( 'wpda_uninstall_tables' );
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQLPlaceholders, WordPress.DB.DirectDatabaseQuery.SchemaChange
        if ( 'on' === $drop_tables ) {
            // Get all plugin table names (without WP prefix).
            $plugin_tables = WPDataAccess\WPDA::get_wpda_tables();
            foreach ( $plugin_tables as $plugin_table ) {
                // Loop through plugin tables.
                // Drop plugin table.
                $wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS `%1s`', WPDataAccess\WPDA::remove_backticks( $plugin_table ) ) );
                // db call ok; no-cache ok.
                // Get plugin backup tables (if applicable).
                $backup_tables = $wpdb->get_results( $wpdb->prepare( '
						select table_name as table_name from information_schema.tables
						where table_schema = %s
						  and table_name like %s
					  	', array($wpdb->dbname, "{$plugin_table}_BACKUP_%") ), 'ARRAY_A' );
                // db call ok; no-cache ok.
                foreach ( $backup_tables as $backup_table ) {
                    // Drop plugin backup table.
                    $wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS `%1s`', WPDataAccess\WPDA::remove_backticks( $backup_table['table_name'] ) ) );
                    // db call ok; no-cache ok.
                }
            }
        }
        $delete_options = get_option( 'wpda_uninstall_options' );
        if ( 'on' === $delete_options ) {
            // Delete all options from wp_options.
            $wpdb->query( "\n\t\t\t\t\tDELETE FROM {$wpdb->options}\n\t\t\t\t\tWHERE option_name LIKE 'wpda%'\n\t\t\t\t" );
            // db call ok; no-cache ok.
            $wpdb->query( "\n\t\t\t\t\tDELETE FROM {$wpdb->usermeta}\n\t\t\t\t\tWHERE meta_key LIKE 'wpda%'\n\t\t\t\t\t   OR meta_key LIKE '%wp-data-access%'\n\t\t\t\t" );
            // db call ok; no-cache ok.
        }
        // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQLPlaceholders, WordPress.DB.DirectDatabaseQuery.SchemaChange
    }

    /**
     * Uninstall WP Data Access tables, options and meta keys
     *
     * @return void
     */
    function wpda_uninstall() {
        if ( is_multisite() ) {
            global $wpdb;
            // Uninstall plugin for all blogs one by one (will fail silently for blogs having no plugin tables/options).
            // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQLPlaceholders, WordPress.DB.DirectDatabaseQuery.SchemaChange
            $blogids = $wpdb->get_col( "select blog_id from {$wpdb->blogs}" );
            // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQLPlaceholders, WordPress.DB.DirectDatabaseQuery.SchemaChange
            foreach ( $blogids as $blog_id ) {
                // Uninstall blog.
                switch_to_blog( $blog_id );
                wpda_uninstall_blog();
                restore_current_blog();
            }
        } else {
            // Uninstall on single site installation.
            wpda_uninstall_blog();
        }
        WPDA::wpda_delete_content_folder();
    }

    wpda_freemius()->add_action( 'after_uninstall', 'wpda_uninstall' );
    /**
     * Add WP Data Access icon to freemius
     *
     * @return string
     */
    function wpda_freemius_icon() {
        return dirname( __FILE__ ) . '/vendor/freemius/assets/img/wpda.png';
    }

    wpda_freemius()->add_filter( 'plugin_icon', 'wpda_freemius_icon' );
    /**
     * Start plugin
     *
     * @author  Peter Schulz
     * @since   1.0.0
     */
    function wpda_run() {
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-data-access.php';
        $wpdataaccess = new WP_Data_Access();
        $wpdataaccess->run();
    }

    wpda_run();
}