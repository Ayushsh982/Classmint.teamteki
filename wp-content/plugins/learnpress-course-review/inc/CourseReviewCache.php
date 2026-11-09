<?php

namespace LearnPress\CourseReview;

use Exception;
use LearnPress\Cache\LPCache;
use LearnPress\Models\CourseModel;
use LP_Addon_Course_Review;
use LP_Addon_Course_Review_Preload;
use LP_Debug;
use Throwable;

defined( 'ABSPATH' ) || exit();

/**
 * Class CourseReviewCache
 *
 * @author tungnx
 * @since 4.2.2
 * @version 1.0.3
 */
class CourseReviewCache extends LPCache {
	/**
	 * @var string Key group child(external)
	 */
	protected $key_group_child = 'course-rating';

	public function __construct( $has_thim_cache = false ) {
		parent::__construct( $has_thim_cache );
	}

	/**
	 * Set rating.
	 *
	 * @param $course_id
	 * @param $rating
	 *
	 * @return void
	 */
	public function set_rating( $course_id, $rating ) {
		$this->set_cache( $course_id, $rating );
	}

	/**
	 * Get rating.
	 *
	 * @param $course_id
	 *
	 * @return array|false|mixed|string
	 */
	public function get_rating( $course_id ) {
		return $this->get_cache( $course_id, 'array' );
	}

	/**
	 * Clean cache rating
	 * And calculate average rating for course
	 *
	 * @param int $course_id
	 *
	 * @return void
	 */
	public function clean_rating( int $course_id ) {
		$this->clear( $course_id );

        try {
            // Set average rating for course
            $rating = LP_Addon_Course_Review_Preload::$addon->get_rating_of_course( $course_id );
            LP_Addon_Course_Review::set_course_rating_average( $course_id, $rating['rated'] ?? 0 );
            $courseModel = CourseModel::find( $course_id, true );
            if ( $courseModel instanceof CourseModel ) {
                $courseModel->meta_data->{LP_Addon_Course_Review::META_KEY_RATING_AVERAGE} = $rating['rated'] ?? 0;
                $courseModel->save( true );
            }
        } catch ( Throwable $e ) {
            LP_Debug::error_log( $e );
        }
	}
}
