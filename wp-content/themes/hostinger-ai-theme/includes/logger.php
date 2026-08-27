<?php
// logger.php — simple file logger

function quiz_log(string $message, string $level = 'INFO'): void {
    $log_dir = __DIR__ . '/logs';
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }

    $file = $log_dir . '/quiz-' . date('Y-m-d') . '.log';
    $user_id = function_exists('get_current_user_id') ? get_current_user_id() : 0;
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $line = sprintf(
        "[%s] [%s] user=%s ip=%s %s\n",
        date('Y-m-d H:i:s'),
        $level,
        $user_id,
        $ip,
        $message
    );

    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}