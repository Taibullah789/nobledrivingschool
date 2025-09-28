<?php
/**
 * Security Configuration
 * Production-ready security measures
 */

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Rate limiting
class RateLimiter {
    private static $requests = [];
    private static $max_requests = 10; // Max requests per minute
    private static $time_window = 60; // 1 minute

    public static function checkLimit($ip) {
        $now = time();
        $key = $ip;
        
        if (!isset(self::$requests[$key])) {
            self::$requests[$key] = [];
        }
        
        // Remove old requests
        self::$requests[$key] = array_filter(
            self::$requests[$key], 
            function($timestamp) use ($now) {
                return ($now - $timestamp) < self::$time_window;
            }
        );
        
        // Check if limit exceeded
        if (count(self::$requests[$key]) >= self::$max_requests) {
            return false;
        }
        
        // Add current request
        self::$requests[$key][] = $now;
        return true;
    }
}

// Input sanitization
if (!function_exists('sanitizeInput')) {
    function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map('sanitizeInput', $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}

// Validate email
if (!function_exists('validateEmail')) {
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

// Validate phone number
function validatePhone($phone) {
    $phone = preg_replace('/[^0-9+\-\(\)\s]/', '', $phone);
    return strlen($phone) >= 10;
}

// CSRF protection
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Log security events
function logSecurityEvent($event, $details = '') {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'event' => $event,
        'details' => $details
    ];
    
    $log_file = '../logs/security.log';
    if (!is_dir('../logs')) {
        mkdir('../logs', 0755, true);
    }
    
    file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
}

// Check for suspicious activity
function checkSuspiciousActivity($data) {
    $suspicious_patterns = [
        '/<script/i',
        '/javascript:/i',
        '/on\w+\s*=/i',
        '/eval\s*\(/i',
        '/expression\s*\(/i'
    ];
    
    $data_string = is_array($data) ? json_encode($data) : $data;
    
    foreach ($suspicious_patterns as $pattern) {
        if (preg_match($pattern, $data_string)) {
            logSecurityEvent('suspicious_input', $data_string);
            return true;
        }
    }
    
    return false;
}
?>
