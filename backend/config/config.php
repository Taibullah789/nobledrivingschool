<?php
/**
 * Application Configuration
 * Noble Driving Academy Backend
 */

// CORS is handled in cors.php to avoid conflicts

// Set content type to JSON
header('Content-Type: application/json');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('America/New_York');

// Application constants
define('APP_NAME', 'Noble Driving Academy');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost/nobledriving/backend/');

// Email configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('FROM_EMAIL', 'info@nobledrivingacademy.com');
define('FROM_NAME', 'Noble Driving Academy');

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('UPLOAD_PATH', '../uploads/');

// JWT Secret (change this in production)
define('JWT_SECRET', 'your-secret-key-here');

// Response helper functions (only declare if not already declared)
if (!function_exists('sendResponse')) {
    function sendResponse($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
        exit();
    }
}

if (!function_exists('sendError')) {
    function sendError($message, $status = 400) {
        http_response_code($status);
        echo json_encode(['error' => $message]);
        exit();
    }
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>
