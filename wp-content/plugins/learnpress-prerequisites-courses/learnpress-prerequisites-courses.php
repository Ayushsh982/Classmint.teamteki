<?php
/**
 * Plugin Name: LearnPress - Prerequisites Courses
 * Plugin URI: https://thimpress.com/product/learnpress-prerequisites-courses/
 * Description: Course you have to finish before you can enroll to this course.
 * Author: ThimPress
 * Version: 4.0.9
 * Author URI: http://thimpress.com
 * Tags: learnpress, lms, add-on, prerequisites courses
 * Text Domain: learnpress-prerequisites-courses
 * Domain Path: /languages/
 * Require_LP_Version: 4.3.2.7
 *
 * @package learnpress-prerequisites
 */

/**
 * Prevent loading this file directly
 */

use LearnPress\Prerequisite\PrerequisiteHook;

defined( 'ABSPATH' ) || exit();

const LP_ADDON_PREREQUISITES_COURSES_FILE = __FILE__;
const LP_ADDON_PREREQUISITES_COURSES_PATH = __DIR__;

/**
 * Class LP_Addon_Prerequisites_Courses_Preload
 */
class LP_Addon_Prerequisites_Courses_Preload {
	/**
	 * @var array
	 */
	public static $addon_info = array();
	/**
	 * @var LP_Addon_Prerequisites_Courses $addon
	 */
	public static $addon;

	/**
	 * Singleton.
	 *
	 * @return LP_Addon_Course_Review_Preload|mixed
	 */
	public static function instance() {
		static $instance;
		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * LP_Addon_Prerequisites_Courses_Preload constructor.
	 */
	public function __construct() {
		// Set Base name plugin.
		define( 'LP_ADDON_PREREQUISITES_COURSES_BASENAME', plugin_basename( LP_ADDON_PREREQUISITES_COURSES_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_PREREQUISITES_COURSES_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_PREREQUISITES_COURSES_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_PREREQUISITES_COURSES_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );

			deactivate_plugins( LP_ADDON_PREREQUISITES_COURSES_BASENAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return;
		}

		// Sure LP loaded.
		add_action( 'learn-press/ready', array( $this, 'load' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		include_once LP_ADDON_PREREQUISITES_COURSES_PATH . '/vendor/autoload.php';
		include_once LP_ADDON_PREREQUISITES_COURSES_PATH . '/inc/load.php';
		self::$addon = LP_Addon_Prerequisites_Courses::instance();
		PrerequisiteHook::get_instance();
	}

	/**
	 * Show note errors require lp version.
	 */
	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_PREREQUISITES_COURSES_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

LP_Addon_Prerequisites_Courses_Preload::instance();
