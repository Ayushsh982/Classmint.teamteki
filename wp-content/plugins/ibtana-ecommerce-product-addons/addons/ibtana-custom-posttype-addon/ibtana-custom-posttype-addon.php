<?php
define( 'ICPA_PLUGIN_FILE', __FILE__ );
define( 'ICPA_PATH', plugin_dir_path( ICPA_PLUGIN_FILE ) );
define( 'ICPA_ABSPATH', dirname(ICPA_PLUGIN_FILE) . '/' );
define( 'ICPA_PLUGIN_URI', plugins_url( '/', ICPA_PLUGIN_FILE ) );

define( 'ICPA_VERSION', IEPA_VERSION );

require_once ICPA_PATH . 'classes/class-icpa-loader.php';
require_once ICPA_PATH . 'classes/class-icpa-submenu.php';
