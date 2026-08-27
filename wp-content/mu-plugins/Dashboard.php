<?php
/**
 * Candidate Performance Dashboard — Backend Data Layer
 *
 * Registers a set of authenticated REST API endpoints under the
 * `candidate-dashboard/v1` namespace. Every endpoint resolves the
 * currently logged-in WordPress user from the request itself
 * (via the REST cookie + nonce auth WordPress already provides),
 * so a user can never request or receive another user's data.
 *
 * DROP-IN LOCATION
 * -----------------
 * Place this file in your theme (e.g. wp-content/themes/your-theme/inc/Dashboard.php)
 * or as a small standalone plugin, and load it once, e.g. from functions.php:
 *
 *     require_once get_stylesheet_directory() . '/inc/Dashboard.php';
 *
 * It does nothing on its own beyond registering routes — see
 * functions-snippet.php for enqueueing the front-end assets and
 * exposing the shortcode [candidate_dashboard].
 *
 * EXPECTED DATABASE SCHEMA
 * -------------------------
 * This class assumes three custom tables (prefixed with $wpdb->prefix).
 * Adjust the table/column names in the constants below to match your
 * existing exam engine if the names differ — the rest of the class
 * does not need to change.
 *
 *   {prefix}exam_results
 *     id                BIGINT UNSIGNED PK
 *     user_id           BIGINT UNSIGNED       -- FK to wp_users.ID
 *     exam_id           BIGINT UNSIGNED
 *     exam_name         VARCHAR(191)
 *     exam_category     VARCHAR(50)           -- JEE, NEET, CAT, GATE, SSC, BANKING, ...
 *     total_marks       DECIMAL(8,2)
 *     score             DECIMAL(8,2)
 *     percentile        DECIMAL(5,2) NULL
 *     rank              INT UNSIGNED NULL
 *     total_candidates  INT UNSIGNED NULL
 *     total_questions   INT UNSIGNED
 *     correct_count     INT UNSIGNED
 *     incorrect_count   INT UNSIGNED
 *     skipped_count     INT UNSIGNED
 *     time_taken_sec    INT UNSIGNED
 *     status            VARCHAR(20)           -- pass, fail, pending
 *     attempted_at      DATETIME
 *
 *   {prefix}exam_topic_performance
 *     id                BIGINT UNSIGNED PK
 *     result_id         BIGINT UNSIGNED       -- FK to exam_results.id
 *     subject           VARCHAR(100)          -- Physics, Chemistry, Biology, Quant, ...
 *     topic             VARCHAR(150)          -- Thermodynamics, Organic Chemistry, ...
 *     total_questions   INT UNSIGNED
 *     correct_count     INT UNSIGNED
 *
 * A candidate's exam category is read from user meta key
 * `exam_category` (falls back to the category of their most recent
 * attempt if the meta key is absent).
 *
 * @package CandidateDashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

class Candidate_Dashboard_API {

	/** REST namespace / version. */
	const NAMESPACE = 'candidate-dashboard/v1';

	/** Table name overrides — change here if your schema differs. */
	const TABLE_RESULTS = 'exam_results';
	const TABLE_TOPICS  = 'exam_topic_performance';

	/** Minimum questions attempted in a topic before it is judged strong/weak. */
	const MIN_TOPIC_SAMPLE = 3;

	/** Accuracy thresholds for strength/weakness classification. */
	const STRONG_THRESHOLD = 75.0;
	const WEAK_THRESHOLD   = 50.0;

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/* ---------------------------------------------------------------------
	 * ROUTE REGISTRATION
	 * ------------------------------------------------------------------- */

	public function register_routes() {

		register_rest_route(
			self::NAMESPACE,
			'/overview',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_overview' ),
				'permission_callback' => array( $this, 'require_login' ),
			)
		);

		register_rest_route(
			self::NAMESPACE,
			'/topics',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_topic_analysis' ),
				'permission_callback' => array( $this, 'require_login' ),
			)
		);

		register_rest_route(
			self::NAMESPACE,
			'/history',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_exam_history' ),
				'permission_callback' => array( $this, 'require_login' ),
				'args'                => array(
					'page'     => array(
						'default'           => 1,
						'sanitize_callback' => 'absint',
					),
					'per_page' => array(
						'default'           => 10,
						'sanitize_callback' => 'absint',
					),
				),
			)
		);

		register_rest_route(
			self::NAMESPACE,
			'/trends',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_performance_trends' ),
				'permission_callback' => array( $this, 'require_login' ),
				'args'                => array(
					'range' => array(
						'default'           => 'monthly',
						'sanitize_callback' => 'sanitize_text_field',
					),
				),
			)
		);

		// Convenience endpoint: everything the first dashboard paint needs
		// in a single round trip, to minimise waterfall requests on load.
		register_rest_route(
			self::NAMESPACE,
			'/all',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_full_dashboard' ),
				'permission_callback' => array( $this, 'require_login' ),
			)
		);
	}

	/**
	 * Permission callback shared by every route: the user must simply be
	 * logged in. We never trust a user_id from the request — it is always
	 * derived server-side from get_current_user_id().
	 */
	public function require_login() {
		return is_user_logged_in();
	}

	/* ---------------------------------------------------------------------
	 * ENDPOINT CALLBACKS
	 * ------------------------------------------------------------------- */

public function get_full_dashboard( WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$category = $this->get_user_category( $user_id );
		$current_user = wp_get_current_user(); // Get the logged-in user's details

		return new WP_REST_Response(
			array(
				'candidate_name' => $current_user->display_name, // Send name to frontend
				'category' => $category,
				'overview' => $this->build_overview( $user_id, $category ),
				'topics'   => $this->build_topic_analysis( $user_id, $category ),
				'history'  => $this->build_exam_history( $user_id, $category, 1, 10 ),
				'trends'   => $this->build_trends( $user_id, $category, 'monthly' ),
			),
			200
		);
	}
	public function get_overview( WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$category = $this->get_user_category( $user_id );
		return new WP_REST_Response( $this->build_overview( $user_id, $category ), 200 );
	}

	public function get_topic_analysis( WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$category = $this->get_user_category( $user_id );
		return new WP_REST_Response( $this->build_topic_analysis( $user_id, $category ), 200 );
	}

	public function get_exam_history( WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$category = $this->get_user_category( $user_id );
		$page     = max( 1, (int) $request->get_param( 'page' ) );
		$per_page = min( 50, max( 1, (int) $request->get_param( 'per_page' ) ) );

		return new WP_REST_Response( $this->build_exam_history( $user_id, $category, $page, $per_page ), 200 );
	}

	public function get_performance_trends( WP_REST_Request $request ) {
		$user_id  = get_current_user_id();
		$category = $this->get_user_category( $user_id );
		$range    = in_array( $request->get_param( 'range' ), array( 'weekly', 'monthly' ), true )
			? $request->get_param( 'range' )
			: 'monthly';

		return new WP_REST_Response( $this->build_trends( $user_id, $category, $range ), 200 );
	}

	/* ---------------------------------------------------------------------
	 * DATA BUILDERS
	 * ------------------------------------------------------------------- */

	/**
	 * Resolve the exam category the candidate belongs to.
	 * Prefers explicit user meta; falls back to the category of the
	 * candidate's most recent attempt so the dashboard still filters
	 * correctly even if the meta hasn't been set.
	 */
	private function get_user_category( $user_id ) {
		$meta_category = get_user_meta( $user_id, 'exam_category', true );
		if ( ! empty( $meta_category ) ) {
			return sanitize_text_field( $meta_category );
		}

		global $wpdb;
		$table    = $wpdb->prefix . self::TABLE_RESULTS;
		$category = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT exam_category FROM {$table} WHERE user_id = %d ORDER BY attempted_at DESC LIMIT 1",
				$user_id
			)
		);

		return $category ? $category : '';
	}

	private function build_overview( $user_id, $category ) {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLE_RESULTS;

		$latest = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table}
				 WHERE user_id = %d AND exam_category = %s
				 ORDER BY attempted_at DESC LIMIT 1",
				$user_id,
				$category
			),
			ARRAY_A
		);

		$aggregate = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT
					COUNT(*)                AS exams_attempted,
					AVG(score)               AS avg_score,
					AVG(percentile)          AS avg_percentile,
					SUM(total_questions)     AS total_questions,
					SUM(correct_count)       AS total_correct,
					SUM(incorrect_count)     AS total_incorrect,
					SUM(skipped_count)       AS total_skipped,
					SUM(time_taken_sec)      AS total_time_sec
				 FROM {$table}
				 WHERE user_id = %d AND exam_category = %s",
				$user_id,
				$category
			),
			ARRAY_A
		);

		$total_attempted = (int) ( $aggregate['total_questions'] ?? 0 );
		$total_correct   = (int) ( $aggregate['total_correct'] ?? 0 );
		$accuracy        = $total_attempted > 0 ? round( ( $total_correct / $total_attempted ) * 100, 2 ) : 0.0;

		return array(
			'has_data'         => (bool) $latest,
			'latest_exam_name' => $latest['exam_name'] ?? null,
			'latest_score'     => isset( $latest['score'] ) ? (float) $latest['score'] : null,
			'latest_total'     => isset( $latest['total_marks'] ) ? (float) $latest['total_marks'] : null,
			'percentile'       => isset( $latest['percentile'] ) ? (float) $latest['percentile'] : null,
			'rank'             => isset( $latest['rank'] ) ? (int) $latest['rank'] : null,
			'total_candidates' => isset( $latest['total_candidates'] ) ? (int) $latest['total_candidates'] : null,
			'accuracy_percent' => $accuracy,
			'questions_total'  => $total_attempted,
			'questions_correct'   => $total_correct,
			'questions_incorrect' => (int) ( $aggregate['total_incorrect'] ?? 0 ),
			'questions_skipped'   => (int) ( $aggregate['total_skipped'] ?? 0 ),
			'time_spent_sec'      => isset( $latest['time_taken_sec'] ) ? (int) $latest['time_taken_sec'] : null,
			'exams_attempted'     => (int) ( $aggregate['exams_attempted'] ?? 0 ),
			'average_score'       => isset( $aggregate['avg_score'] ) ? round( (float) $aggregate['avg_score'], 2 ) : null,
			'average_percentile'  => isset( $aggregate['avg_percentile'] ) ? round( (float) $aggregate['avg_percentile'], 2 ) : null,
		);
	}

	private function build_topic_analysis( $user_id, $category ) {
		global $wpdb;
		$results_table = $wpdb->prefix . self::TABLE_RESULTS;
		$topics_table  = $wpdb->prefix . self::TABLE_TOPICS;

		$rows = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT
					t.subject,
					t.topic,
					SUM(t.total_questions) AS total_questions,
					SUM(t.correct_count)   AS correct_count
				 FROM {$topics_table} t
				 INNER JOIN {$results_table} r ON r.id = t.result_id
				 WHERE r.user_id = %d AND r.exam_category = %s
				 GROUP BY t.subject, t.topic
				 ORDER BY t.subject ASC",
				$user_id,
				$category
			),
			ARRAY_A
		);

		$topics       = array();
		$subject_map  = array(); // subject => [correct, total]
		$strong       = array();
		$weak         = array();

		foreach ( $rows as $row ) {
			$total    = (int) $row['total_questions'];
			$correct  = (int) $row['correct_count'];
			$accuracy = $total > 0 ? round( ( $correct / $total ) * 100, 2 ) : 0.0;

			$topics[] = array(
				'subject'  => $row['subject'],
				'topic'    => $row['topic'],
				'attempted' => $total,
				'correct'  => $correct,
				'accuracy' => $accuracy,
			);

			if ( ! isset( $subject_map[ $row['subject'] ] ) ) {
				$subject_map[ $row['subject'] ] = array( 'correct' => 0, 'total' => 0 );
			}
			$subject_map[ $row['subject'] ]['correct'] += $correct;
			$subject_map[ $row['subject'] ]['total']   += $total;

			if ( $total >= self::MIN_TOPIC_SAMPLE ) {
				if ( $accuracy >= self::STRONG_THRESHOLD ) {
					$strong[] = array( 'topic' => $row['topic'], 'subject' => $row['subject'], 'accuracy' => $accuracy );
				} elseif ( $accuracy < self::WEAK_THRESHOLD ) {
					$weak[] = array( 'topic' => $row['topic'], 'subject' => $row['subject'], 'accuracy' => $accuracy );
				}
			}
		}

		// Sort: strongest first, weakest first.
		usort( $strong, fn( $a, $b ) => $b['accuracy'] <=> $a['accuracy'] );
		usort( $weak, fn( $a, $b ) => $a['accuracy'] <=> $b['accuracy'] );

		$subjects = array();
		foreach ( $subject_map as $subject => $counts ) {
			$subjects[] = array(
				'subject'  => $subject,
				'attempted' => $counts['total'],
				'correct'  => $counts['correct'],
				'accuracy' => $counts['total'] > 0 ? round( ( $counts['correct'] / $counts['total'] ) * 100, 2 ) : 0.0,
			);
		}

		return array(
			'topics'        => $topics,
			'subjects'      => $subjects,
			'strong_topics' => array_slice( $strong, 0, 5 ),
			'weak_topics'   => array_slice( $weak, 0, 5 ),
			'insights'      => $this->build_insights( $strong, $weak ),
		);
	}

	/**
	 * Lightweight rule-based recommendation generator. This intentionally
	 * does not call any external AI service — it produces deterministic,
	 * explainable "insight" strings from the same data already computed
	 * above. Swap the body of this method if you want to pipe the same
	 * inputs into a real model instead.
	 */
	private function build_insights( $strong, $weak ) {
		$insights = array();

		if ( ! empty( $weak ) ) {
			$top_weak = $weak[0];
			$insights[] = sprintf(
				'Focus your next study block on %s (%s) — accuracy is currently %s%%.',
				$top_weak['topic'],
				$top_weak['subject'],
				$top_weak['accuracy']
			);
		}

		if ( ! empty( $strong ) ) {
			$top_strong = $strong[0];
			$insights[] = sprintf(
				'%s (%s) is a strength at %s%% accuracy — use it to bank marks quickly in future attempts.',
				$top_strong['topic'],
				$top_strong['subject'],
				$top_strong['accuracy']
			);
		}

		if ( count( $weak ) >= 3 ) {
			$insights[] = 'Several topics are below 50% accuracy — consider a focused revision cycle before your next attempt rather than spreading time evenly.';
		}

		return $insights;
	}

	private function build_exam_history( $user_id, $category, $page, $per_page ) {
		global $wpdb;
		$table  = $wpdb->prefix . self::TABLE_RESULTS;
		$offset = ( $page - 1 ) * $per_page;

		$total = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$table} WHERE user_id = %d AND exam_category = %s",
				$user_id,
				$category
			)
		);

		$rows = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT id, exam_name, exam_category, score, total_marks, percentile, rank,
				        total_questions, correct_count, incorrect_count, skipped_count,
				        time_taken_sec, status, attempted_at
				 FROM {$table}
				 WHERE user_id = %d AND exam_category = %s
				 ORDER BY attempted_at DESC
				 LIMIT %d OFFSET %d",
				$user_id,
				$category,
				$per_page,
				$offset
			),
			ARRAY_A
		);

		$items = array_map(
			function ( $row ) {
				return array(
					'id'             => (int) $row['id'],
					'exam_name'      => $row['exam_name'],
					'category'       => $row['exam_category'],
					'score'          => (float) $row['score'],
					'total_marks'    => (float) $row['total_marks'],
					'percentile'     => isset( $row['percentile'] ) ? (float) $row['percentile'] : null,
					'rank'           => isset( $row['rank'] ) ? (int) $row['rank'] : null,
					'total_questions'=> (int) $row['total_questions'],
					'correct'        => (int) $row['correct_count'],
					'incorrect'      => (int) $row['incorrect_count'],
					'skipped'        => (int) $row['skipped_count'],
					'time_taken_sec' => (int) $row['time_taken_sec'],
					'status'         => $row['status'],
					'attempted_at'   => mysql_to_rfc3339( $row['attempted_at'] ),
					'report_url'     => esc_url_raw( add_query_arg( 'exam_result_id', (int) $row['id'], home_url( '/exam-report/' ) ) ),
				);
			},
			$rows
		);

		return array(
			'items'       => $items,
			'page'        => $page,
			'per_page'    => $per_page,
			'total_items' => $total,
			'total_pages' => (int) ceil( $total / $per_page ),
		);
	}

	private function build_trends( $user_id, $category, $range ) {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLE_RESULTS;

		$date_format = 'weekly' === $range ? '%x-W%v' : '%Y-%m';

		$rows = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT
					DATE_FORMAT(attempted_at, %s) AS period,
					AVG(score)                     AS avg_score,
					AVG(percentile)                AS avg_percentile,
					AVG( (correct_count / NULLIF(total_questions,0)) * 100 ) AS avg_accuracy,
					MIN(attempted_at)              AS period_start
				 FROM {$table}
				 WHERE user_id = %d AND exam_category = %s
				 GROUP BY period
				 ORDER BY period_start ASC",
				$date_format,
				$user_id,
				$category
			),
			ARRAY_A
		);

		return array(
			'range' => $range,
			'points' => array_map(
				function ( $row ) {
					return array(
						'period'     => $row['period'],
						'score'      => round( (float) $row['avg_score'], 2 ),
						'percentile' => null !== $row['avg_percentile'] ? round( (float) $row['avg_percentile'], 2 ) : null,
						'accuracy'   => round( (float) $row['avg_accuracy'], 2 ),
					);
				},
				$rows
			),
		);
	}
}
// Register a shortcode to output the secure dashboard script
add_shortcode('candidate_dashboard_script', function() {
    // Don't output anything if the user isn't logged in
    if ( ! is_user_logged_in() ) {
        return '<p>Please log in to view your dashboard.</p>';
    }

    ob_start();
    ?>
    <script>
        // 1. Generate the security token (Nonce)
        var wpApiSettings = {
            root: "<?php echo esc_url_raw( rest_url() ); ?>",
            nonce: "<?php echo wp_create_nonce( 'wp_rest' ); ?>"
        };

        // 2. Fetch the data using the secure route
        fetch(wpApiSettings.root + 'candidate-dashboard/v1/all', {
            method: 'GET',
            headers: {
                'X-WP-Nonce': wpApiSettings.nonce,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            console.log("Success! Data received:", data);
            
            // --- YOUR DATA MAPPING LOGIC WILL GO HERE ---
            // Example: document.getElementById('latest-score').innerText = data.overview.latest_score;
            
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
    </script>
    <?php
    return ob_get_clean();
});
new Candidate_Dashboard_API();