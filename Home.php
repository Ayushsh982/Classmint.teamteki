<?php
/**
 * ClassMint LMS API
 * Upload this file to Hostinger, typically:
 *   public_html/backend.php
 * or
 *   public_html/wp-content/themes/YOUR-THEME/backend.php
 *
 * The Home Page JS calls:  GET/POST {this file}?action=...
 * WordPress login cookies must be sent (same domain).
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store, no-cache, must-revalidate');

// ---------------------------------------------------------------------------
// 1. Boot WordPress
// ---------------------------------------------------------------------------
$wp_load_candidates = [
    __DIR__ . '/wp-load.php',
    dirname(__DIR__) . '/wp-load.php',
    dirname(__DIR__, 2) . '/wp-load.php',
    dirname(__DIR__, 3) . '/wp-load.php',
    $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php',
];

$wp_loaded = false;
foreach ($wp_load_candidates as $candidate) {
    if (is_string($candidate) && file_exists($candidate)) {
        require_once $candidate;
        $wp_loaded = true;
        break;
    }
}

if (!$wp_loaded) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'WordPress not found. Place backend.php in the WordPress root (next to wp-load.php) or update the path list.',
    ]);
    exit;
}

// Same-origin only. If you ever host the API on a subdomain, whitelist it here.
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$home   = home_url();
if ($origin !== '' && rtrim($origin, '/') === rtrim($home, '/')) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Content-Type, X-WP-Nonce');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ---------------------------------------------------------------------------
// 2. Constants — exams, categories, levels
// ---------------------------------------------------------------------------
const CM_CATEGORY_EXAMS = [
    'engineering' => ['jee_main', 'jee_advanced'],
    'medical'     => ['neet', 'aiims'],
    'masters'     => ['cat'],
];

const CM_EXAMS = [
    'jee_main'     => ['name' => 'JEE Main',     'blurb' => 'Full syllabus timed papers',           'category' => 'engineering', 'url' => '/jee-main/'],
    'jee_advanced' => ['name' => 'JEE Advanced', 'blurb' => 'High-rigour problem solving',          'category' => 'engineering', 'url' => '/jee-advanced/'],
    'neet'         => ['name' => 'NEET',         'blurb' => 'Biology-weighted medical entrance',    'category' => 'medical',     'url' => '/neet/'],
    'aiims'        => ['name' => 'AIIMS',        'blurb' => 'Clinical reasoning & assertion papers', 'category' => 'medical',     'url' => '/aiims/'],
    'cat'          => ['name' => 'CAT',          'blurb' => 'VARC · DILR · Quantitative Aptitude',  'category' => 'masters',     'url' => '/cat/'],
];

const CM_CATEGORY_SUBJECTS = [
    'engineering' => ['Physics', 'Chemistry', 'Mathematics'],
    'medical'     => ['Physics', 'Chemistry', 'Biology'],
    'masters'     => ['VARC', 'DILR', 'Quantitative Aptitude'],
];

const CM_CATEGORY_LABELS = [
    'engineering' => 'Engineering',
    'medical'     => 'Medical',
    'masters'     => 'Master\'s / Management',
];

const CM_LEVELS = [
    0 => ['title' => 'Newcomer',     'xp' => 0],
    1 => ['title' => 'Beginner',     'xp' => 400],
    2 => ['title' => 'Foundation',   'xp' => 1200],
    3 => ['title' => 'Intermediate', 'xp' => 3000],
    4 => ['title' => 'Advanced',     'xp' => 6500],
    5 => ['title' => 'Expert',       'xp' => 12000],
];

const CM_DIFFICULTY_XP = [
    'easy'     => 8,
    'medium'   => 16,
    'hard'     => 28,
    'advanced' => 40,
];

const CM_MODE_WEIGHT = [
    'practice'     => 0.40,
    'chapter_test' => 0.80,
    'mock'         => 1.20,
    'full_exam'    => 1.50,
];

const CM_DAILY_CAP_PRACTICE = 250;
const CM_DAILY_CAP_EXAM     = 600;
const CM_PROMOTION_PASS     = 60.0;

const CM_BADGE_CATALOG = [
    'first_blood'   => 'First Blood',
    'accuracy_80'   => 'Sharpshooter',
    'week_streak'   => 'Week Streak',
    'mock_pass'     => 'Mock Pass',
    'subject_balance' => 'Subject Balance',
    'no_farm'       => 'Honest Scholar',
    'century'       => 'Century',
    'promotion'     => 'Promoted',
];

// ---------------------------------------------------------------------------
// 3. Schema
// ---------------------------------------------------------------------------
function cm_table(string $suffix): string
{
    global $wpdb;
    return $wpdb->prefix . 'cm_' . $suffix;
}

function cm_ensure_tables(): void
{
    global $wpdb;
    $table = cm_table('attempts');
    if ($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table)) !== $table) {
        cm_install_tables();
    }
}

function cm_install_tables(): void
{
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $charset = $wpdb->get_charset_collate();

    $attempts = cm_table('attempts');
    $credits  = cm_table('question_credits');
    $daily    = cm_table('daily_xp');
    $badges   = cm_table('user_badges');

    dbDelta("CREATE TABLE {$attempts} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT UNSIGNED NOT NULL,
        exam_code VARCHAR(32) NOT NULL,
        subject VARCHAR(64) NOT NULL DEFAULT '',
        mode VARCHAR(24) NOT NULL DEFAULT 'practice',
        score_percent DECIMAL(5,2) NOT NULL DEFAULT 0,
        correct INT NOT NULL DEFAULT 0,
        attempted INT NOT NULL DEFAULT 0,
        duration_sec INT NOT NULL DEFAULT 0,
        xp_awarded INT NOT NULL DEFAULT 0,
        is_promotion TINYINT(1) NOT NULL DEFAULT 0,
        passed TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY user_created (user_id, created_at),
        KEY user_exam (user_id, exam_code)
    ) {$charset};");

    dbDelta("CREATE TABLE {$credits} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT UNSIGNED NOT NULL,
        question_id BIGINT UNSIGNED NOT NULL,
        times_credited INT NOT NULL DEFAULT 0,
        last_xp INT NOT NULL DEFAULT 0,
        last_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY user_question (user_id, question_id)
    ) {$charset};");

    dbDelta("CREATE TABLE {$daily} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT UNSIGNED NOT NULL,
        day_date DATE NOT NULL,
        practice_xp INT NOT NULL DEFAULT 0,
        exam_xp INT NOT NULL DEFAULT 0,
        PRIMARY KEY (id),
        UNIQUE KEY user_day (user_id, day_date)
    ) {$charset};");

    dbDelta("CREATE TABLE {$badges} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT UNSIGNED NOT NULL,
        badge_code VARCHAR(40) NOT NULL,
        earned_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY user_badge (user_id, badge_code)
    ) {$charset};");
}

// ---------------------------------------------------------------------------
// 4. Auth + category helpers
// ---------------------------------------------------------------------------
function cm_require_login(): int
{
    $uid = get_current_user_id();
    if ($uid <= 0) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Please log in to view your dashboard.']);
        exit;
    }
    return $uid;
}

function cm_require_admin(): int
{
    $uid = cm_require_login();
    if (!current_user_can('manage_options')) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Admin only.']);
        exit;
    }
    return $uid;
}

function cm_normalize_category(?string $raw): ?string
{
    $raw = strtolower(trim((string) $raw));
    $map = [
        'engineering' => 'engineering',
        'engg'        => 'engineering',
        'jee'         => 'engineering',
        'medical'     => 'medical',
        'neet'        => 'medical',
        'masters'     => 'masters',
        'master'      => 'masters',
        'management'  => 'masters',
        'cat'         => 'masters',
        'mba'         => 'masters',
    ];
    return $map[$raw] ?? null;
}

function cm_user_category(int $user_id): string
{
    $stored = get_user_meta($user_id, 'cm_category', true);
    $cat    = cm_normalize_category(is_string($stored) ? $stored : '');
    return $cat ?? 'engineering';
}

function cm_allowed_exams(string $category): array
{
    return CM_CATEGORY_EXAMS[$category] ?? [];
}

function cm_exam_allowed_for_user(int $user_id, string $exam_code): bool
{
    $category = cm_user_category($user_id);
    return in_array($exam_code, cm_allowed_exams($category), true);
}

function cm_guard_exam(int $user_id, string $exam_code): void
{
    if (!isset(CM_EXAMS[$exam_code]) || !cm_exam_allowed_for_user($user_id, $exam_code)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'error'   => 'This exam is not available on your track.',
        ]);
        exit;
    }
}

function cm_json_input(): array
{
    $raw = file_get_contents('php://input');
    if (!$raw) {
        return $_POST;
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $_POST;
}

function cm_verify_nonce(?string $nonce): void
{
    if (!$nonce || !wp_verify_nonce($nonce, 'wp_rest')) {
        // Also accept a dedicated LMS nonce if the theme localizes one later.
        if (!$nonce || !wp_verify_nonce($nonce, 'cm_lms')) {
            http_response_code(403);
            echo json_encode(['success' => false, 'error' => 'Invalid security token. Refresh the page and try again.']);
            exit;
        }
    }
}

// ---------------------------------------------------------------------------
// 5. Level + XP engine
// ---------------------------------------------------------------------------
function cm_level_from_xp(int $xp): int
{
    $level = 0;
    foreach (CM_LEVELS as $n => $row) {
        if ($xp >= (int) $row['xp']) {
            $level = $n;
        }
    }
    return $level;
}

function cm_level_floor(int $level): int
{
    return (int) (CM_LEVELS[$level]['xp'] ?? 0);
}

function cm_next_level(int $level): int
{
    return min(5, $level + 1);
}

function cm_accuracy_multiplier(float $accuracy): float
{
    if ($accuracy < 40) {
        return 0.55;
    }
    if ($accuracy < 70) {
        return 1.00;
    }
    if ($accuracy < 85) {
        return 1.15;
    }
    return 1.30;
}

/**
 * First unique credit = 100%, second = 20%, further repeats = 0%.
 * This is the main anti-farm rule.
 */
function cm_repeat_multiplier(int $times_already_credited): float
{
    if ($times_already_credited <= 0) {
        return 1.00;
    }
    if ($times_already_credited === 1) {
        return 0.20;
    }
    return 0.00;
}

function cm_suspicious_speed(string $difficulty, int $seconds): bool
{
    $floor = [
        'easy'     => 4,
        'medium'   => 8,
        'hard'     => 15,
        'advanced' => 25,
    ];
    return $seconds > 0 && $seconds < ($floor[$difficulty] ?? 8);
}

function cm_get_or_create_progress(int $user_id): array
{
    $xp    = (int) get_user_meta($user_id, 'cm_xp', true);
    $level = (int) get_user_meta($user_id, 'cm_level', true);
    $promo = (int) get_user_meta($user_id, 'cm_highest_promoted_level', true);

    if (get_user_meta($user_id, 'cm_xp', true) === '') {
        update_user_meta($user_id, 'cm_xp', 0);
        update_user_meta($user_id, 'cm_level', 0);
        update_user_meta($user_id, 'cm_highest_promoted_level', 0);
        $xp    = 0;
        $level = 0;
        $promo = 0;
    }

    return [
        'xp'               => $xp,
        'level'            => $level,
        'promoted_level'   => $promo,
    ];
}

function cm_daily_remaining(int $user_id, string $mode): array
{
    global $wpdb;
    $table = cm_table('daily_xp');
    $today = current_time('Y-m-d');
    $row   = $wpdb->get_row(
        $wpdb->prepare("SELECT practice_xp, exam_xp FROM {$table} WHERE user_id = %d AND day_date = %s", $user_id, $today),
        ARRAY_A
    );

    $practice = (int) ($row['practice_xp'] ?? 0);
    $exam     = (int) ($row['exam_xp'] ?? 0);
    $is_practice = ($mode === 'practice');

    return [
        'practice_xp' => $practice,
        'exam_xp'     => $exam,
        'cap'         => $is_practice ? CM_DAILY_CAP_PRACTICE : CM_DAILY_CAP_EXAM,
        'used'        => $is_practice ? $practice : $exam,
        'remaining'   => max(0, ($is_practice ? CM_DAILY_CAP_PRACTICE : CM_DAILY_CAP_EXAM) - ($is_practice ? $practice : $exam)),
        'is_practice' => $is_practice,
        'today'       => $today,
    ];
}

function cm_add_daily_xp(int $user_id, string $mode, int $xp): void
{
    global $wpdb;
    $table = cm_table('daily_xp');
    $today = current_time('Y-m-d');
    $col   = ($mode === 'practice') ? 'practice_xp' : 'exam_xp';

    $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO {$table} (user_id, day_date, practice_xp, exam_xp)
             VALUES (%d, %s, %d, %d)
             ON DUPLICATE KEY UPDATE {$col} = {$col} + VALUES({$col})",
            $user_id,
            $today,
            $mode === 'practice' ? $xp : 0,
            $mode === 'practice' ? 0 : $xp
        )
    );
}

function cm_credit_question(int $user_id, int $question_id): int
{
    global $wpdb;
    $table = cm_table('question_credits');
    $times = (int) $wpdb->get_var(
        $wpdb->prepare("SELECT times_credited FROM {$table} WHERE user_id = %d AND question_id = %d", $user_id, $question_id)
    );
    return $times;
}

function cm_mark_question_credited(int $user_id, int $question_id, int $xp): void
{
    global $wpdb;
    $table = cm_table('question_credits');
    $now   = current_time('mysql');
    $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO {$table} (user_id, question_id, times_credited, last_xp, last_at)
             VALUES (%d, %d, 1, %d, %s)
             ON DUPLICATE KEY UPDATE times_credited = times_credited + 1, last_xp = VALUES(last_xp), last_at = VALUES(last_at)",
            $user_id,
            $question_id,
            $xp,
            $now
        )
    );
}

/**
 * Award XP for one answered question.
 * Returns awarded XP (already capped / anti-farmed).
 */
function cm_score_question(int $user_id, array $q): int
{
    $correct    = !empty($q['correct']);
    $difficulty = strtolower((string) ($q['difficulty'] ?? 'medium'));
    $mode       = strtolower((string) ($q['mode'] ?? 'practice'));
    $seconds    = (int) ($q['seconds'] ?? 0);
    $qid        = (int) ($q['question_id'] ?? 0);
    $accuracy   = (float) ($q['session_accuracy'] ?? 70);

    if (!$correct || $qid <= 0) {
        return 0;
    }
    if (!isset(CM_DIFFICULTY_XP[$difficulty])) {
        $difficulty = 'medium';
    }
    if (!isset(CM_MODE_WEIGHT[$mode])) {
        $mode = 'practice';
    }

    $base   = CM_DIFFICULTY_XP[$difficulty];
    $repeat = cm_repeat_multiplier(cm_credit_question($user_id, $qid));
    if ($repeat <= 0) {
        cm_mark_question_credited($user_id, $qid, 0);
        return 0;
    }

    $xp = $base * $repeat * CM_MODE_WEIGHT[$mode] * cm_accuracy_multiplier($accuracy);

    if (cm_suspicious_speed($difficulty, $seconds)) {
        $xp *= 0.25;
    }

    $xp = (int) round($xp);
    $cap = cm_daily_remaining($user_id, $mode);
    $xp  = min($xp, $cap['remaining']);

    if ($xp > 0) {
        cm_mark_question_credited($user_id, $qid, $xp);
        cm_add_daily_xp($user_id, $mode, $xp);
        $new_xp = (int) get_user_meta($user_id, 'cm_xp', true) + $xp;
        update_user_meta($user_id, 'cm_xp', $new_xp);
        cm_sync_level_from_xp($user_id);
    } else {
        cm_mark_question_credited($user_id, $qid, 0);
    }

    return $xp;
}

/**
 * Official level only rises when XP threshold is met AND a promotion mock is passed.
 * XP-only can make a student "eligible"; the displayed level stays gated.
 */
function cm_sync_level_from_xp(int $user_id): void
{
    $xp            = (int) get_user_meta($user_id, 'cm_xp', true);
    $xp_level      = cm_level_from_xp($xp);
    $promoted      = (int) get_user_meta($user_id, 'cm_highest_promoted_level', true);
    $display_level = min($xp_level, max(0, $promoted));

    // Level 0 → 1 does not require a promotion exam. First 400 XP is the onboarding climb.
    if ($xp_level >= 1 && $promoted < 1) {
        $display_level = 1;
        update_user_meta($user_id, 'cm_highest_promoted_level', 1);
    }

    update_user_meta($user_id, 'cm_level', $display_level);
}

function cm_try_promote(int $user_id, string $exam_code, float $score, string $mode): bool
{
    if (!in_array($mode, ['mock', 'full_exam'], true) || $score < CM_PROMOTION_PASS) {
        return false;
    }
    if (!cm_exam_allowed_for_user($user_id, $exam_code)) {
        return false;
    }

    $xp            = (int) get_user_meta($user_id, 'cm_xp', true);
    $xp_level      = cm_level_from_xp($xp);
    $promoted      = (int) get_user_meta($user_id, 'cm_highest_promoted_level', true);
    $target        = min($xp_level, $promoted + 1);

    if ($target > $promoted && $target >= 2) {
        update_user_meta($user_id, 'cm_highest_promoted_level', $target);
        update_user_meta($user_id, 'cm_level', $target);
        cm_award_badge($user_id, 'promotion');
        cm_award_badge($user_id, 'mock_pass');
        return true;
    }

    if ($score >= CM_PROMOTION_PASS) {
        cm_award_badge($user_id, 'mock_pass');
    }

    return false;
}

function cm_award_badge(int $user_id, string $code): void
{
    if (!isset(CM_BADGE_CATALOG[$code])) {
        return;
    }
    global $wpdb;
    $table = cm_table('user_badges');
    $wpdb->query(
        $wpdb->prepare(
            "INSERT IGNORE INTO {$table} (user_id, badge_code, earned_at) VALUES (%d, %s, %s)",
            $user_id,
            $code,
            current_time('mysql')
        )
    );
}

function cm_refresh_badges(int $user_id): void
{
    global $wpdb;
    $attempts = cm_table('attempts');
    $credits  = cm_table('question_credits');

    $credited = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$credits} WHERE user_id = %d AND times_credited > 0", $user_id));
    if ($credited >= 1) {
        cm_award_badge($user_id, 'first_blood');
    }
    if ($credited >= 100) {
        cm_award_badge($user_id, 'century');
    }

    $stats = $wpdb->get_row(
        $wpdb->prepare("SELECT SUM(correct) AS c, SUM(attempted) AS a FROM {$attempts} WHERE user_id = %d", $user_id),
        ARRAY_A
    );
    $attempted = (int) ($stats['a'] ?? 0);
    $correct   = (int) ($stats['c'] ?? 0);
    if ($attempted >= 40 && $correct / max(1, $attempted) >= 0.80) {
        cm_award_badge($user_id, 'accuracy_80');
    }

    $streak = cm_streak_days($user_id);
    if ($streak >= 7) {
        cm_award_badge($user_id, 'week_streak');
    }

    $subjects = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT DISTINCT subject FROM {$attempts} WHERE user_id = %d AND created_at >= %s AND subject <> ''",
            $user_id,
            gmdate('Y-m-d H:i:s', current_time('timestamp') - 7 * DAY_IN_SECONDS)
        )
    );
    if (is_array($subjects) && count($subjects) >= 3) {
        cm_award_badge($user_id, 'subject_balance');
    }

    $repeats = (int) $wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM {$credits} WHERE user_id = %d AND times_credited > 2", $user_id)
    );
    $unique  = max(1, $credited);
    if ($credited >= 30 && ($repeats / $unique) < 0.15) {
        cm_award_badge($user_id, 'no_farm');
    }
}

function cm_streak_days(int $user_id): int
{
    global $wpdb;
    $table = cm_table('attempts');
    $days  = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT DISTINCT DATE(created_at) FROM {$table} WHERE user_id = %d ORDER BY DATE(created_at) DESC LIMIT 60",
            $user_id
        )
    );
    if (!$days) {
        return 0;
    }

    $streak = 0;
    $cursor = new DateTimeImmutable(current_time('Y-m-d'));
    foreach ($days as $day) {
        if ($day === $cursor->format('Y-m-d')) {
            $streak++;
            $cursor = $cursor->modify('-1 day');
            continue;
        }
        break;
    }
    return $streak;
}

function cm_relative_time(string $mysql): string
{
    $ts = strtotime($mysql);
    if (!$ts) {
        return '';
    }
    $diff = max(0, current_time('timestamp') - $ts);
    if ($diff < 60) {
        return 'just now';
    }
    if ($diff < 3600) {
        return (int) floor($diff / 60) . 'm ago';
    }
    if ($diff < 86400) {
        return (int) floor($diff / 3600) . 'h ago';
    }
    return (int) floor($diff / 86400) . 'd ago';
}

// ---------------------------------------------------------------------------
// 6. Dashboard payload
// ---------------------------------------------------------------------------
function cm_public_name(\WP_User $user): string
{
    $first = trim((string) $user->first_name);
    if ($first !== '') {
        return $first;
    }
    $display = trim((string) $user->display_name);
    if ($display !== '') {
        $parts = preg_split('/\s+/', $display);
        return $parts[0] ?: $display;
    }
    $nick = trim((string) $user->nickname);
    if ($nick !== '') {
        return $nick;
    }
    return (string) $user->user_login;
}

function cm_dashboard(int $user_id): array
{
    global $wpdb;

    $user     = get_userdata($user_id);
    $category = cm_user_category($user_id);
    $progress = cm_get_or_create_progress($user_id);
    cm_refresh_badges($user_id);

    $xp            = (int) $progress['xp'];
    $level         = (int) get_user_meta($user_id, 'cm_level', true);
    $promoted      = (int) get_user_meta($user_id, 'cm_highest_promoted_level', true);
    $xp_level      = cm_level_from_xp($xp);
    $next          = cm_next_level($level);
    $floor         = cm_level_floor($level);
    $next_floor    = cm_level_floor($next);
    $span          = max(1, $next_floor - $floor);
    $into          = max(0, min($span, $xp - $floor));
    $to_next       = $level >= 5 ? 0 : max(0, $next_floor - $xp);
    $promo_ready   = ($xp_level > $level) || ($xp_level >= $next && $next > $level);
    $promo_needed  = $level >= 1 && $level < 5 && $next > $promoted;

    $attempts_t = cm_table('attempts');
    $credits_t  = cm_table('question_credits');
    $badges_t   = cm_table('user_badges');

    $agg = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT COALESCE(SUM(correct),0) AS c, COALESCE(SUM(attempted),0) AS a,
                    COALESCE(SUM(passed),0) AS p
             FROM {$attempts_t} WHERE user_id = %d",
            $user_id
        ),
        ARRAY_A
    );

    $attempted = (int) ($agg['a'] ?? 0);
    $correct   = (int) ($agg['c'] ?? 0);
    $accuracy  = $attempted > 0 ? round(($correct / $attempted) * 100, 1) : 0.0;
    $credited  = (int) $wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM {$credits_t} WHERE user_id = %d AND last_xp > 0", $user_id)
    );

    $week_start = gmdate('Y-m-d', current_time('timestamp') - 6 * DAY_IN_SECONDS);
    $active_days = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT DISTINCT DATE(created_at) FROM {$attempts_t}
             WHERE user_id = %d AND created_at >= %s",
            $user_id,
            $week_start . ' 00:00:00'
        )
    );
    $consistency = [];
    for ($i = 6; $i >= 0; $i--) {
        $d = gmdate('Y-m-d', current_time('timestamp') - $i * DAY_IN_SECONDS);
        $consistency[] = in_array($d, $active_days ?: [], true) ? 1 : 0;
    }

    $exams = [];
    foreach (cm_allowed_exams($category) as $code) {
        $meta = CM_EXAMS[$code];
        $last = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT score_percent FROM {$attempts_t}
                 WHERE user_id = %d AND exam_code = %s
                 ORDER BY created_at DESC LIMIT 1",
                $user_id,
                $code
            ),
            ARRAY_A
        );
        $avg = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT AVG(score_percent) FROM {$attempts_t}
                 WHERE user_id = %d AND exam_code = %s AND attempted > 0",
                $user_id,
                $code
            )
        );
        $exams[] = [
            'code'       => $code,
            'name'       => $meta['name'],
            'blurb'      => $meta['blurb'],
            'readiness'  => $avg !== null ? (int) round((float) $avg) : 0,
            'last_score' => $last ? (int) round((float) $last['score_percent']) : null,
            'url'        => $meta['url'],
        ];
    }

    $subjects = [];
    foreach (CM_CATEGORY_SUBJECTS[$category] as $subject) {
        $s = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT COALESCE(SUM(correct),0) AS c, COALESCE(SUM(attempted),0) AS a,
                        AVG(score_percent) AS avg_score
                 FROM {$attempts_t} WHERE user_id = %d AND subject = %s",
                $user_id,
                $subject
            ),
            ARRAY_A
        );
        $recent = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT AVG(score_percent) FROM {$attempts_t}
                 WHERE user_id = %d AND subject = %s AND created_at >= %s",
                $user_id,
                $subject,
                gmdate('Y-m-d H:i:s', current_time('timestamp') - 7 * DAY_IN_SECONDS)
            )
        );
        $older = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT AVG(score_percent) FROM {$attempts_t}
                 WHERE user_id = %d AND subject = %s
                   AND created_at < %s AND created_at >= %s",
                $user_id,
                $subject,
                gmdate('Y-m-d H:i:s', current_time('timestamp') - 7 * DAY_IN_SECONDS),
                gmdate('Y-m-d H:i:s', current_time('timestamp') - 14 * DAY_IN_SECONDS)
            )
        );
        $trend = 'Steady';
        if ($recent !== null && $older !== null) {
            $delta = (float) $recent - (float) $older;
            if ($delta >= 4) {
                $trend = 'Rising';
            } elseif ($delta <= -4) {
                $trend = 'Cooling';
            }
        } elseif ($recent !== null && $older === null) {
            $trend = 'Rising';
        }

        $att = (int) ($s['a'] ?? 0);
        $cor = (int) ($s['c'] ?? 0);
        $subjects[] = [
            'name'     => $subject,
            'mastery'  => $s['avg_score'] !== null ? (int) round((float) $s['avg_score']) : 0,
            'accuracy' => $att > 0 ? (int) round(($cor / $att) * 100) : 0,
            'trend'    => $trend,
        ];
    }

    $earned = $wpdb->get_col($wpdb->prepare("SELECT badge_code FROM {$badges_t} WHERE user_id = %d", $user_id));
    $earned = is_array($earned) ? $earned : [];
    $badges = [];
    foreach (CM_BADGE_CATALOG as $code => $name) {
        $badges[] = [
            'code'   => $code,
            'name'   => $name,
            'earned' => in_array($code, $earned, true),
        ];
    }

    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT exam_code, mode, score_percent, xp_awarded, created_at
             FROM {$attempts_t} WHERE user_id = %d
             ORDER BY created_at DESC LIMIT 5",
            $user_id
        ),
        ARRAY_A
    );
    $activity = [];
    foreach ($rows ?: [] as $row) {
        $exam_name = CM_EXAMS[$row['exam_code']]['name'] ?? $row['exam_code'];
        $mode_label = str_replace('_', ' ', (string) $row['mode']);
        $activity[] = [
            'label'  => $exam_name . ' · ' . ucfirst($mode_label),
            'score'  => (int) round((float) $row['score_percent']),
            'xp'     => (int) $row['xp_awarded'],
            'credit' => ((int) $row['xp_awarded'] > 0 ? 'first' : 'repeat'),
            'when'   => cm_relative_time((string) $row['created_at']),
        ];
    }

    $weak = null;
    foreach ($subjects as $sub) {
        if ($weak === null || $sub['mastery'] < $weak['mastery']) {
            $weak = $sub;
        }
    }
    $primary_exam = $exams[0] ?? null;
    $next_step    = cm_next_step($level, $promo_ready, $promo_needed, $next, $to_next, $primary_exam, $weak);

    $first = $user instanceof WP_User ? cm_public_name($user) : 'Scholar';
    $last_active = $wpdb->get_var(
        $wpdb->prepare("SELECT created_at FROM {$attempts_t} WHERE user_id = %d ORDER BY created_at DESC LIMIT 1", $user_id)
    );

    return [
        'success' => true,
        'nonce'   => wp_create_nonce('cm_lms'),
        'user'    => [
            'first_name'         => $first,
            'category'           => $category,
            'category_label'     => CM_CATEGORY_LABELS[$category] ?? ucfirst($category),
            'level'              => $level,
            'level_title'        => CM_LEVELS[$level]['title'],
            'xp'                 => $xp,
            'xp_into_level'      => $into,
            'xp_for_next'        => $span,
            'xp_to_next'         => $to_next,
            'next_level'         => $next,
            'next_level_title'   => CM_LEVELS[$next]['title'],
            'promotion_ready'    => $promo_ready && $promo_needed,
            'promotion_required' => $promo_needed,
            'streak_days'        => cm_streak_days($user_id),
            'last_active'        => $last_active ?: current_time('mysql'),
        ],
        'stats' => [
            'accuracy'            => $accuracy,
            'questions_credited'  => $credited,
            'questions_attempted' => $attempted,
            'exams_passed'        => (int) ($agg['p'] ?? 0),
            'study_days_7'        => array_sum($consistency),
        ],
        'next_step'   => $next_step,
        'exams'       => $exams,
        'subjects'    => $subjects,
        'badges'      => $badges,
        'activity'    => $activity,
        'consistency' => $consistency,
    ];
}

function cm_next_step(
    int $level,
    bool $promo_ready,
    bool $promo_needed,
    int $next,
    int $to_next,
    ?array $exam,
    ?array $weak
): array {
    $exam_name = $exam['name'] ?? 'your paper';
    $exam_url  = $exam['url'] ?? '/';
    $weak_name = $weak['name'] ?? 'your weakest subject';

    if ($level === 0) {
        return [
            'title'           => 'Take your placement diagnostic',
            'reason'          => 'A short mixed paper sets your starting rank and unlocks a study path.',
            'cta_label'       => 'Start diagnostic',
            'cta_url'         => $exam_url,
            'secondary_label' => 'Browse syllabus',
            'secondary_url'   => $exam_url,
        ];
    }

    if ($promo_ready && $promo_needed) {
        return [
            'title'           => 'Sit your ' . CM_LEVELS[$next]['title'] . ' mock — ' . $exam_name,
            'reason'          => 'You have the XP. Pass a timed mock at 60% to officially reach Level ' . $next . '.',
            'cta_label'       => 'Start mock',
            'cta_url'         => $exam_url,
            'secondary_label' => 'Review mistakes',
            'secondary_url'   => '/review/',
        ];
    }

    if ($promo_needed && $to_next > 0) {
        return [
            'title'           => 'Close the gap in ' . $weak_name,
            'reason'          => 'You need ' . number_format($to_next) . ' more XP and a passing mock to reach ' . CM_LEVELS[$next]['title'] . '.',
            'cta_label'       => 'Practice ' . $weak_name,
            'cta_url'         => $exam_url,
            'secondary_label' => 'Open syllabus',
            'secondary_url'   => $exam_url,
        ];
    }

    return [
        'title'           => 'Keep your ' . $exam_name . ' rhythm',
        'reason'          => 'A mixed timed set today protects your streak and subject balance.',
        'cta_label'       => 'Continue',
        'cta_url'         => $exam_url,
        'secondary_label' => 'Review mistakes',
        'secondary_url'   => '/review/',
    ];
}

// ---------------------------------------------------------------------------
// 7. Write endpoints
// ---------------------------------------------------------------------------
function cm_handle_set_category(int $user_id, array $input): array
{
    // Students may set this once. Admins may change it any time.
    $category = cm_normalize_category($input['category'] ?? '');
    if (!$category) {
        http_response_code(400);
        return ['success' => false, 'error' => 'Category must be engineering, medical, or masters.'];
    }

    $existing = get_user_meta($user_id, 'cm_category', true);
    if ($existing && !current_user_can('manage_options')) {
        http_response_code(409);
        return ['success' => false, 'error' => 'Your track is locked. Ask an admin if you chose the wrong one.'];
    }

    update_user_meta($user_id, 'cm_category', $category);

    return [
        'success'  => true,
        'category' => $category,
        'exams'    => cm_allowed_exams($category),
    ];
}

function cm_handle_attempt(int $user_id, array $input): array
{
    $exam = sanitize_key((string) ($input['exam_code'] ?? ''));
    cm_guard_exam($user_id, $exam);

    $mode    = sanitize_key((string) ($input['mode'] ?? 'practice'));
    $subject = sanitize_text_field((string) ($input['subject'] ?? ''));
    if (!isset(CM_MODE_WEIGHT[$mode])) {
        $mode = 'practice';
    }

    $questions = $input['questions'] ?? [];
    if (!is_array($questions) || $questions === []) {
        http_response_code(400);
        return ['success' => false, 'error' => 'No questions submitted.'];
    }

    $correct = 0;
    $xp_sum  = 0;
    $seconds = 0;
    $n       = 0;

    foreach ($questions as $q) {
        if (!is_array($q)) {
            continue;
        }
        $n++;
        $is_correct = !empty($q['correct']);
        if ($is_correct) {
            $correct++;
        }
        $seconds += (int) ($q['seconds'] ?? 0);
        $q['mode'] = $mode;
        $q['session_accuracy'] = $n > 0 ? ($correct / $n) * 100 : 0;
        $xp_sum += cm_score_question($user_id, $q);
    }

    $score  = $n > 0 ? round(($correct / $n) * 100, 2) : 0.0;
    $passed = $score >= CM_PROMOTION_PASS && in_array($mode, ['chapter_test', 'mock', 'full_exam'], true);
    $is_promo = !empty($input['is_promotion']);

    if ($is_promo || in_array($mode, ['mock', 'full_exam'], true)) {
        cm_try_promote($user_id, $exam, (float) $score, $mode);
    }

    global $wpdb;
    $wpdb->insert(cm_table('attempts'), [
        'user_id'       => $user_id,
        'exam_code'     => $exam,
        'subject'       => $subject,
        'mode'          => $mode,
        'score_percent' => $score,
        'correct'       => $correct,
        'attempted'     => $n,
        'duration_sec'  => $seconds,
        'xp_awarded'    => $xp_sum,
        'is_promotion'  => $is_promo ? 1 : 0,
        'passed'        => $passed ? 1 : 0,
        'created_at'    => current_time('mysql'),
    ], ['%d', '%s', '%s', '%s', '%f', '%d', '%d', '%d', '%d', '%d', '%d', '%s']);

    cm_refresh_badges($user_id);

    return [
        'success'        => true,
        'xp_awarded'     => $xp_sum,
        'score_percent'  => $score,
        'passed'         => $passed,
        'level'          => (int) get_user_meta($user_id, 'cm_level', true),
        'xp'             => (int) get_user_meta($user_id, 'cm_xp', true),
    ];
}

function cm_handle_can_access(int $user_id, array $input): array
{
    $exam = sanitize_key((string) ($input['exam_code'] ?? ($_GET['exam_code'] ?? '')));
    $ok   = $exam !== '' && cm_exam_allowed_for_user($user_id, $exam);
    if (!$ok) {
        http_response_code(403);
    }
    return [
        'success'   => $ok,
        'allowed'   => $ok,
        'exam_code' => $exam,
        'category'  => cm_user_category($user_id),
    ];
}

/**
 * Public landing payload. No login required.
 * If a WordPress session exists, the homepage can switch CTAs to "Open dashboard".
 */
function cm_public_home(): array
{
    $uid       = function_exists('get_current_user_id') ? (int) get_current_user_id() : 0;
    $logged_in = $uid > 0;
    $session   = null;

    if ($logged_in) {
        $user = get_userdata($uid);
        $session = [
            'first_name'     => $user instanceof WP_User ? cm_public_name($user) : 'Scholar',
            'category'       => cm_user_category($uid),
            'category_label' => CM_CATEGORY_LABELS[cm_user_category($uid)] ?? '',
            'level'          => (int) get_user_meta($uid, 'cm_level', true),
        ];
    }

    $tracks = [];
    foreach (CM_CATEGORY_EXAMS as $cat => $codes) {
        $exams = [];
        foreach ($codes as $code) {
            $meta   = CM_EXAMS[$code];
            $exams[] = [
                'code'  => $code,
                'name'  => $meta['name'],
                'blurb' => $meta['blurb'],
                'url'   => $meta['url'],
            ];
        }
        $tracks[] = [
            'code'     => $cat,
            'label'    => CM_CATEGORY_LABELS[$cat],
            'subjects' => CM_CATEGORY_SUBJECTS[$cat],
            'exams'    => $exams,
        ];
    }

    $levels = [];
    foreach (CM_LEVELS as $n => $row) {
        $levels[] = [
            'level' => $n,
            'title' => $row['title'],
            'xp'    => $row['xp'],
        ];
    }

    return [
        'success'   => true,
        'logged_in' => $logged_in,
        'session'   => $session,
        'tracks'    => $tracks,
        'features'  => [
            [
                'code'  => 'assessment',
                'name'  => 'Assessment',
                'blurb' => 'Timed chapter tests and mocks. Scores feed your official rank.',
                'url'   => '/assessment/',
            ],
            [
                'code'  => 'practice',
                'name'  => 'Practice',
                'blurb' => 'Daily question sets. Practice XP is capped so it cannot inflate rank.',
                'url'   => '/practice/',
            ],
            [
                'code'  => 'pyq',
                'name'  => 'PYQ',
                'blurb' => 'Previous-year style papers, organised by chapter for your track.',
                'url'   => '/pyq/',
            ],
            [
                'code'  => 'progress',
                'name'  => 'Ranked progress',
                'blurb' => 'Levels 0–5. From Foundation up, a passing mock is required to promote.',
                'url'   => '#how',
            ],
        ],
        'facts' => [
            ['label' => 'Career tracks', 'value' => (string) count(CM_CATEGORY_EXAMS)],
            ['label' => 'Exam papers', 'value' => (string) count(CM_EXAMS)],
            ['label' => 'Official ranks', 'value' => (string) count(CM_LEVELS)],
        ],
        'levels' => $levels,
        'links'  => [
            'login'      => function_exists('wp_login_url') ? wp_login_url(home_url('/')) : '/wp-login.php',
            'register'   => function_exists('wp_registration_url') ? wp_registration_url() : '/wp-login.php?action=register',
            'dashboard'  => function_exists('home_url') ? home_url('/') : '/',
            'assessment' => '/assessment/',
            'practice'   => '/practice/',
            'pyq'        => '/pyq/',
        ],
    ];
}

// ---------------------------------------------------------------------------
// 8. Router
// ---------------------------------------------------------------------------
$action = sanitize_key((string) ($_GET['action'] ?? $_POST['action'] ?? ''));

try {
    switch ($action) {
        case 'install':
            cm_require_admin();
            cm_install_tables();
            echo json_encode(['success' => true, 'message' => 'ClassMint tables are ready.']);
            break;

        case 'dashboard':
            $uid = cm_require_login();
            cm_ensure_tables();
            echo json_encode(cm_dashboard($uid));
            break;

        case 'set_category':
            $uid = cm_require_login();
            cm_verify_nonce($_SERVER['HTTP_X_WP_NONCE'] ?? (cm_json_input()['nonce'] ?? ''));
            echo json_encode(cm_handle_set_category($uid, cm_json_input()));
            break;

        case 'submit_attempt':
            $uid = cm_require_login();
            cm_ensure_tables();
            cm_verify_nonce($_SERVER['HTTP_X_WP_NONCE'] ?? (cm_json_input()['nonce'] ?? ''));
            echo json_encode(cm_handle_attempt($uid, cm_json_input()));
            break;

        case 'can_access':
            $uid = cm_require_login();
            echo json_encode(cm_handle_can_access($uid, cm_json_input()));
            break;

        case 'public_home':
        case 'home':
            echo json_encode(cm_public_home());
            break;

        default:
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error'   => 'Unknown action. Use public_home, dashboard, submit_attempt, set_category, can_access, or install.',
            ]);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Server error.',
    ]);
}
