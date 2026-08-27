<?php
/**
 * Plugin Name:       Ace Post Type Builder
 * Plugin URI:        
 * Description:       The Plugin simplifies creating and managing custom post types in WordPress with an intuitive interface and page builder compatibility.
 * Version:           2.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            buywptemplates
 * Author URI:        https://www.buywptemplates.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ace-post-type-builder
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CPTB_PLUGIN_VERSION', '2.1');
define('CPTB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CPTB_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CPTB_MAIN_URL', 'https://license.buywptemplates.com/api/public/');
define('CPTB_SERVER_URL', 'https://www.buywptemplates.com/');

require_once CPTB_PLUGIN_DIR . 'includes/cptb-post-types.php';
require_once CPTB_PLUGIN_DIR . 'includes/class-cptb-core.php';
require_once CPTB_PLUGIN_DIR . 'includes/cptb-taxonomies.php';
require_once CPTB_PLUGIN_DIR . 'global-functions.php';

register_activation_hook(__FILE__, 'cptb_activate');
function cptb_activate()
{
    require_once CPTB_PLUGIN_DIR . 'includes/class-cptb-core.php';
    $cptb_instance = Cptb_Type_Builder::instance();
    flush_rewrite_rules();
    $cptb_instance->cptb_activate();
}

register_deactivation_hook(__FILE__, 'cptb_deactivate');
function cptb_deactivate()
{
    flush_rewrite_rules();
}

function cptb_init()
{
    $cptb_instance = Cptb_Type_Builder::instance();
    $cptb_instance->init();
}
add_action('plugins_loaded', 'cptb_init');

add_action('admin_notices', 'cptb_admin_notice_with_html');
function cptb_admin_notice_with_html()
{
    $user_id = get_current_user_id();
    $dismissed_at = get_user_meta($user_id, 'cptb_notice_dismissed_at', true);
    $current_time = current_time('timestamp');

    if (!$dismissed_at || ($current_time - $dismissed_at) > 86400) {
        ?>
        <div class="notice is-dismissible cptb">
            <div class="cptb-notice-banner-wrap">
                <div class="cptb-notice-banner-wrap">
                    <div class="cptb-notice-banner-left" style="position:relative">
                        <div class="cptb-per-wrap">
                        </div>

                        <?php
                        // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                        echo '<img class="cptb-img" src="' . esc_url(CPTB_PLUGIN_URL . 'assets/images/banner-img.png') . '" />';
                        ?>

                    </div>
                    <div class="cptb-notice-banner-right">
                        <div class="cptb-notice-banner-content-wrap">
                            <h1 class="cptb-banner-heading">Get Access to 250+ Premium WordPress Themes in One Powerful Bundle
                            </h1>
                            <p class="banner-para">Save countless hours and thousands of dollars with a massive collection of
                                250+ professionally designed WordPress themes — perfect for blogs, businesses, eCommerce stores,
                                portfolios, agencies, and more.</p>
                        </div>
                    </div>
                    <div class="banner-limited">
                        <p class="banner-para">Limited Time Offer!</p>
                        <h2 class="banner-heading">FLAT 20% OFF</h2>
                        <button class="custom-button"><a
                                href="https://www.buywptemplates.com/discount/ACE20?redirect=/products/wp-theme-bundle"
                                class="get" target="_blank">GET BUNDLE</a></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
