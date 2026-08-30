<?php
// Load WordPress environment
require_once( __DIR__ . '/wp-load.php' );

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');

if (!session_id()) {
    session_start();
}

// --- UPDATE THESE CREDENTIALS ---
$db_host = 'localhost';

$db_user = 'u400773773_l22bd';

$db_pass = '1iaRlX5haX'; 

$db_name = 'u400773773_iVLZB'; 

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    echo json_encode(['ok' => false, 'error' => 'Database connection error']);
    exit;
}

$raw_input = file_get_contents('php://input');
$data = json_decode($raw_input, true) ?? [];
$action = $_GET['action'] ?? ($data['action'] ?? '');
$has_wp_mail = function_exists('wp_mail');

// 1. SEND OTP (For New Accounts)
if ($action === 'send_otp') {
    $email = trim($data['email'] ?? '');
    $password = trim($data['password'] ?? '');
    $name = trim($data['googleName'] ?? '');

    $otp = sprintf("%06d", mt_rand(100000, 999999));
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $safe_email = $conn->real_escape_string($email);
    $safe_name = $conn->real_escape_string($name);

    $query = "INSERT INTO users (email, password, name, otp, otp_expiry) 
              VALUES ('$safe_email', '$hashed_pass', '$safe_name', '$otp', DATE_ADD(NOW(), INTERVAL 10 MINUTE))
              ON DUPLICATE KEY UPDATE 
              password = '$hashed_pass', 
              name = IF('$safe_name' != '', '$safe_name', name),
              otp = '$otp', 
              otp_expiry = DATE_ADD(NOW(), INTERVAL 10 MINUTE)";
    
    $conn->query($query);

    $subject = 'ClassMint OTP';
    $message = "Your 6-digit verification code is: " . $otp;
    
    if ($has_wp_mail) {
        wp_mail($email, $subject, $message, array('From: ClassMint <freelancing982@gmail.com>'));
    } else {
        mail($email, $subject, $message, "From: ClassMint <freelancing982@gmail.com>\r\n");
    }
    
    echo json_encode(['ok' => true]);
    exit;
}

// 2. VERIFY OTP (For New Accounts)
if ($action === 'verify_otp') {
    $email = trim($data['email'] ?? '');
    $otp = trim($data['otp'] ?? '');
    $safe_email = $conn->real_escape_string($email);
    $safe_otp = $conn->real_escape_string($otp);

    $res = $conn->query("SELECT id FROM users WHERE email = '$safe_email' AND otp = '$safe_otp' AND otp_expiry >= NOW()");
    if ($res && $res->num_rows > 0) {
        $conn->query("UPDATE users SET otp = NULL, otp_expiry = NULL WHERE email = '$safe_email'");
        $_SESSION['user_email'] = $email; // Set session for onboarding
        echo json_encode(['ok' => true]);
    } else {
        echo json_encode(['ok' => false, 'error' => 'Invalid or expired OTP.']);
    }
    exit;
}

// 3. DIRECT LOGIN (Bypass OTP for Existing Accounts)
if ($action === 'login') {
    $email = trim($data['email'] ?? '');
    $password = trim($data['password'] ?? '');
    $safe_email = $conn->real_escape_string($email);

    $res = $conn->query("SELECT password, name, stream FROM users WHERE email = '$safe_email'");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        // User exists, check password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_email'] = $email;
            echo json_encode(['ok' => true, 'exists' => true, 'user' => ['name' => $row['name'], 'stream' => $row['stream']]]);
            exit;
        } else {
            echo json_encode(['ok' => false, 'exists' => true, 'error' => 'Incorrect password for this account.']);
            exit;
        }
    }
    // User does not exist in DB yet
    echo json_encode(['ok' => false, 'exists' => false, 'error' => 'New user.']);
    exit;
}

// 4. SAVE ONBOARDING DETAILS
if ($action === 'save_onboarding') {
    $email = trim($data['email'] ?? ($_SESSION['user_email'] ?? ''));
    if(empty($email)) { echo json_encode(['ok' => false, 'error' => 'Not logged in']); exit; }

    $safe_email = $conn->real_escape_string($email);
    $updates = [];

    if (isset($data['preparingFor'])) $updates[] = "stream = '" . $conn->real_escape_string($data['preparingFor']) . "'";
    if (isset($data['classLevel'])) $updates[] = "class_level = '" . $conn->real_escape_string($data['classLevel']) . "'";
    if (isset($data['examYear'])) $updates[] = "exam_year = '" . $conn->real_escape_string($data['examYear']) . "'";
    if (isset($data['name']) && !empty($data['name'])) $updates[] = "name = '" . $conn->real_escape_string($data['name']) . "'";

    if (!empty($updates)) {
        $conn->query("UPDATE users SET " . implode(', ', $updates) . " WHERE email = '$safe_email'");
    }
    echo json_encode(['ok' => true]);
    exit;
}

// 5. GET USER DATA
if ($action === 'get_user') {
    $email = trim($data['email'] ?? ($_GET['email'] ?? ''));
    $safe_email = $conn->real_escape_string($email);
    $res = $conn->query("SELECT name, stream FROM users WHERE email = '$safe_email'");
    if ($res && $row = $res->fetch_assoc()) {
        echo json_encode(['ok' => true, 'data' => $row]);
        exit;
    }
    echo json_encode(['ok' => false, 'error' => 'User not found']);
    exit;
}

echo json_encode(['ok' => false, 'error' => 'Invalid action']);
?>