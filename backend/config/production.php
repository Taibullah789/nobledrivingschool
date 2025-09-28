<?php
/**
 * Production Configuration
 * Production-ready settings and optimizations
 */

// Production environment settings
define('ENVIRONMENT', 'production');
define('DEBUG', false);

// Security settings
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../logs/php_errors.log');

// Session security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

// Database connection pooling (if supported)
define('DB_PERSISTENT', true);

// Email settings for production
define('SMTP_HOST', 'smtp.gmail.com'); // Change to your SMTP server
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com'); // Change to your email
define('SMTP_PASSWORD', 'your-app-password'); // Use app-specific password
define('SMTP_ENCRYPTION', 'tls');

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']);

// Rate limiting (more strict for production)
define('RATE_LIMIT_REQUESTS', 5); // Max requests per minute
define('RATE_LIMIT_WINDOW', 60); // Time window in seconds

// Logging
define('LOG_LEVEL', 'INFO');
define('LOG_FILE', '../logs/application.log');

// Backup settings
define('BACKUP_ENABLED', true);
define('BACKUP_FREQUENCY', 'daily'); // daily, weekly, monthly
define('BACKUP_RETENTION', 30); // days

// Cache settings
define('CACHE_ENABLED', true);
define('CACHE_TTL', 3600); // 1 hour

// Performance monitoring
define('PERFORMANCE_MONITORING', true);
define('SLOW_QUERY_THRESHOLD', 1.0); // seconds

// Security headers
function setSecurityHeaders() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    header('Content-Security-Policy: default-src \'self\'; script-src \'self\' \'unsafe-inline\'; style-src \'self\' \'unsafe-inline\';');
}

// Error handling
function handleProductionError($errno, $errstr, $errfile, $errline) {
    $error_message = "Error: [$errno] $errstr - $errfile:$errline";
    error_log($error_message);
    
    // Don't display errors to users in production
    if (!DEBUG) {
        echo json_encode(['error' => 'An error occurred. Please try again later.']);
    }
}

// Set error handler
set_error_handler('handleProductionError');

// Logging function
function logMessage($level, $message, $context = []) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'level' => $level,
        'message' => $message,
        'context' => $context,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ];
    
    $log_file = LOG_FILE;
    if (!is_dir('../logs')) {
        mkdir('../logs', 0755, true);
    }
    
    file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
}

// Performance monitoring
function startTimer() {
    return microtime(true);
}

function endTimer($start_time, $operation = 'unknown') {
    $duration = microtime(true) - $start_time;
    
    if ($duration > SLOW_QUERY_THRESHOLD) {
        logMessage('WARNING', "Slow operation detected: $operation", ['duration' => $duration]);
    }
    
    return $duration;
}

// Database backup function
function createDatabaseBackup() {
    if (!BACKUP_ENABLED) return false;
    
    $backup_dir = '../backups/';
    if (!is_dir($backup_dir)) {
        mkdir($backup_dir, 0755, true);
    }
    
    $backup_file = $backup_dir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';
    
    // Create mysqldump command
    $command = "mysqldump -u " . DB_USERNAME . " -p" . DB_PASSWORD . " " . DB_NAME . " > " . $backup_file;
    
    exec($command, $output, $return_code);
    
    if ($return_code === 0) {
        logMessage('INFO', 'Database backup created successfully', ['file' => $backup_file]);
        return $backup_file;
    } else {
        logMessage('ERROR', 'Database backup failed', ['return_code' => $return_code]);
        return false;
    }
}

// Cleanup old backups
function cleanupOldBackups() {
    $backup_dir = '../backups/';
    if (!is_dir($backup_dir)) return;
    
    $files = glob($backup_dir . 'backup_*.sql');
    $cutoff_time = time() - (BACKUP_RETENTION * 24 * 60 * 60);
    
    foreach ($files as $file) {
        if (filemtime($file) < $cutoff_time) {
            unlink($file);
            logMessage('INFO', 'Old backup file deleted', ['file' => $file]);
        }
    }
}

// Set security headers
setSecurityHeaders();

// Log application start
logMessage('INFO', 'Application started', ['environment' => ENVIRONMENT]);
?>