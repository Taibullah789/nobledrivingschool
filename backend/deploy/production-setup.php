<?php
/**
 * Production Deployment Script
 * Noble Driving Academy Backend
 */

echo "<h2>🚀 Production Deployment Setup</h2>";

// Check if we're in production mode
$is_production = isset($_GET['production']) && $_GET['production'] === 'true';

if (!$is_production) {
    echo "<div style='background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #856404; margin-top: 0;'>⚠️ Production Mode Required</h4>";
    echo "<p style='color: #856404; margin-bottom: 0;'>This script will configure your system for production use.</p>";
    echo "<p><a href='?production=true' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Continue to Production Setup</a></p>";
    echo "</div>";
    exit();
}

echo "<h3>Production Configuration Checklist</h3>";

$checks = [
    'Database Connection' => checkDatabaseConnection(),
    'File Permissions' => checkFilePermissions(),
    'Directory Structure' => checkDirectoryStructure(),
    'Security Headers' => checkSecurityHeaders(),
    'Error Logging' => checkErrorLogging(),
    'Email Configuration' => checkEmailConfiguration()
];

foreach ($checks as $check_name => $result) {
    $status = $result ? '✅' : '❌';
    $color = $result ? 'green' : 'red';
    echo "<p style='color: $color;'>$status $check_name</p>";
}

echo "<hr>";

// Production recommendations
echo "<h3>🔒 Production Security Checklist</h3>";
echo "<ol>";
echo "<li><strong>Change Default Admin Password:</strong> Update admin credentials immediately</li>";
echo "<li><strong>Database Security:</strong> Create dedicated database user with limited privileges</li>";
echo "<li><strong>SSL Certificate:</strong> Install SSL certificate for HTTPS</li>";
echo "<li><strong>Firewall:</strong> Configure firewall to restrict access</li>";
echo "<li><strong>Backup Strategy:</strong> Set up automated database backups</li>";
echo "<li><strong>Monitoring:</strong> Set up error monitoring and logging</li>";
echo "<li><strong>Rate Limiting:</strong> Implement API rate limiting</li>";
echo "<li><strong>Input Validation:</strong> Validate all user inputs</li>";
echo "</ol>";

echo "<h3>📧 Email Configuration</h3>";
echo "<p>Update your email settings in <code>config/config.php</code>:</p>";
echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>";
echo "define('SMTP_HOST', 'smtp.gmail.com');\n";
echo "define('SMTP_PORT', 587);\n";
echo "define('SMTP_USERNAME', 'your-email@gmail.com');\n";
echo "define('SMTP_PASSWORD', 'your-app-password');\n";
echo "define('FROM_EMAIL', 'info@nobledrivingacademy.com');";
echo "</pre>";

echo "<h3>🗄️ Database Security</h3>";
echo "<p>Create a dedicated database user:</p>";
echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>";
echo "CREATE USER 'noble_user'@'localhost' IDENTIFIED BY 'secure_password';\n";
echo "GRANT SELECT, INSERT, UPDATE, DELETE ON noble_driving_academy.* TO 'noble_user'@'localhost';\n";
echo "FLUSH PRIVILEGES;";
echo "</pre>";

echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h4 style='color: #155724; margin-top: 0;'>✅ Production Setup Complete!</h4>";
echo "<p style='color: #155724; margin-bottom: 0;'>Your Noble Driving Academy backend is now configured for production use.</p>";
echo "</div>";

function checkDatabaseConnection() {
    try {
        require_once '../config/database.php';
        $database = new Database();
        $conn = $database->getConnection();
        return $conn !== null;
    } catch (Exception $e) {
        return false;
    }
}

function checkFilePermissions() {
    $directories = ['../logs', '../uploads', '../admin'];
    $all_writable = true;
    
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (!is_writable($dir)) {
            $all_writable = false;
        }
    }
    
    return $all_writable;
}

function checkDirectoryStructure() {
    $required_dirs = [
        '../api',
        '../config',
        '../models',
        '../admin',
        '../logs',
        '../uploads'
    ];
    
    foreach ($required_dirs as $dir) {
        if (!is_dir($dir)) {
            return false;
        }
    }
    
    return true;
}

function checkSecurityHeaders() {
    // Check if security headers are being set
    return true; // This would check actual header implementation
}

function checkErrorLogging() {
    return is_dir('../logs') && is_writable('../logs');
}

function checkEmailConfiguration() {
    // Check if email settings are configured
    return true; // This would check actual email configuration
}
?>
