<?php
/**
 * Plugin Name: LearnPress - Course Review
 * Plugin URI: https://thimpress.com/product/learnpress-course-review/
 * Description: Adding review for course.
 * Author: ThimPress
 * Version: 4.2.3
 * Author URI: http://thimpress.com
 * Tags: learnpress
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: learnpress-course-review
 * Domain Path: /languages/
 * Require_LP_Version: 4.4.11
 * Requires Plugins: learnpress
 *
 * @package learnpress-course-review
 */

use LearnPress\CourseReview\CourseReviewShortCode;
use LearnPress\CourseReview\TemplateHooks\CourseRatingTemplate;
use LearnPress\CourseReview\TemplateHooks\FilterCourseRatingTemplate;
use LearnPress\CourseReview\TemplateHooks\TemplateHooks;
use LearnPress\Helpers\Template;

defined( 'ABSPATH' ) || exit;

const LP_ADDON_COURSE_REVIEW_FILE = __FILE__;
const LP_ADDON_COURSE_REVIEW_PATH = __DIR__;

/**
 * Class LP_Addon_Course_Review_Preload
 *
 * Mirrors the learnpress-paddle-payment preload pattern:
 * verify PHP + LearnPress are compatible, then defer addon boot
 * to the `learn-press/ready` hook.
 */
class LP_Addon_Course_Review_Preload {
	/**
	 * Parsed plugin header fields.
	 *
	 * @var array<string, string>
	 */
	public static $addon_info = array();

	/**
	 * Booted addon instance (populated after `learn-press/ready`).
	 *
	 * @var LP_Addon_Course_Review|null
	 */
	public static $addon = null;

	public $require_error = '';

	/**
	 * Singleton accessor.
	 *
	 * @return LP_Addon_Course_Review_Preload
	 */
	public static function instance(): self {
		static $instance = null;
		if ( null === $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * LP_Addon_Course_Review_Preload constructor.
	 */
	protected function __construct() {
		if ( ! defined( 'LP_ADDON_COURSE_REVIEW_BASENAME' ) ) {
			define( 'LP_ADDON_COURSE_REVIEW_BASENAME', plugin_basename( LP_ADDON_COURSE_REVIEW_FILE ) );
		}

		// Ensure WordPress plugin helpers (is_plugin_active, deactivate_plugins).
		if ( ! function_exists( 'is_plugin_active' ) && defined( 'ABSPATH' ) && is_readable( ABSPATH . 'wp-admin/includes/plugin.php' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		// Set version addon for LP check .
		self::$addon_info = (array) get_file_data(
			LP_ADDON_COURSE_REVIEW_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Version'            => 'Version',
				'RequiresPHP'        => 'Requires PHP',
				'Require_LP_Version' => 'Require_LP_Version',
			)
		);

		define( 'LP_ADDON_COURSE_REVIEW_VER', (string) ( self::$addon_info['Version'] ?? '1.0.0' ) );
		define( 'LP_ADDON_COURSE_REVIEW_REQUIRE_VER', (string) ( self::$addon_info['Require_LP_Version'] ?? '4.0.0' ) );

		if ( ! $this->check_requirements() ) {
			return;
		}

		$autoload = LP_ADDON_COURSE_REVIEW_PATH . '/vendor/autoload.php';
		if ( is_readable( $autoload ) ) {
			require_once $autoload;
		}

		// Sure LP loaded.
		add_action( 'learn-press/ready', array( $this, 'load' ) );
	}

	/**
	 * Verify PHP + LearnPress version constraints.
	 */
	protected function check_requirements(): bool {
		try {
			if ( ! is_plugin_active( 'learnpress/learnpress.php' )
                || version_compare(
                    get_option( 'learnpress_version', '3.0.0' ),
                    LP_ADDON_COURSE_REVIEW_REQUIRE_VER,
                    '<'
                ) ) {
				$this->require_error = 'require_lp';
				throw new Exception();
			}

			return true;
		} catch ( Throwable $e ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors' ) );
			return false;
		}
	}

	/**
	 * Load and instantiate the main addon services on `learn-press/ready`.
	 */
	public function load(): void {
		include_once LP_ADDON_COURSE_REVIEW_PATH . '/inc/load.php';
		if ( class_exists( 'LP_Addon_Course_Review' ) ) {
			self::$addon = LP_Addon_Course_Review::instance();

			FilterCourseRatingTemplate::instance();
			CourseRatingTemplate::instance();
			TemplateHooks::instance();
			CourseReviewShortCode::instance();
		}
	}

	public function show_note_errors() {
		$message = '';
		switch ( $this->require_error ) {
			case 'require_lp':
				$message = sprintf(
					esc_html__( 'Addon Course Review require install LearnPress version %s or later', 'learnpress-course-review' ),
					LP_ADDON_COURSE_REVIEW_REQUIRE_VER
				);
				break;
			default:
				break;
		}

		if ( class_exists( Template::class ) ) {
			Template::print_message(
				$message,
				'error'
			);
		} else {
			printf(
				'<div class="notice notice-error"><p>%s</p></div>',
				esc_html( $message )
			);
		}
	}
}

LP_Addon_Course_Review_Preload::instance();
