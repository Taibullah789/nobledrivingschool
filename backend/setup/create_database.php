<?php
/**
 * Database Creation Script
 * Creates the MySQL database if it doesn't exist
 */

// Database configuration (update these with your MySQL credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database_name = 'noble_driving_academy';

echo "<h2>Creating MySQL Database</h2>";

try {
    // Connect to MySQL server (without specifying database)
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Connected to MySQL server successfully</p>";
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS `$database_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "<p style='color: green;'>✓ Database '$database_name' created successfully</p>";
    
    // Test connection to the new database
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Successfully connected to '$database_name' database</p>";
    
    echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #155724; margin-top: 0;'>✅ Database Setup Complete!</h4>";
    echo "<p style='color: #155724; margin-bottom: 0;'>Your database '$database_name' has been created successfully.</p>";
    echo "</div>";
    
    echo "<h4>Next Steps:</h4>";
    echo "<ol>";
    echo "<li>Update your database credentials in <code>config/database.php</code> if needed</li>";
    echo "<li>Run the main installation script: <a href='install.php'>install.php</a></li>";
    echo "<li>This will create all the necessary tables and sample data</li>";
    echo "</ol>";
    
} catch (PDOException $e) {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #721c24; margin-top: 0;'>❌ Database Creation Failed</h4>";
    echo "<p style='color: #721c24; margin-bottom: 0;'>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
    
    echo "<h4>Troubleshooting:</h4>";
    echo "<ol>";
    echo "<li><strong>Check MySQL is running:</strong> Make sure MySQL service is started</li>";
    echo "<li><strong>Check credentials:</strong> Verify username and password are correct</li>";
    echo "<li><strong>Check permissions:</strong> Ensure the user has CREATE DATABASE privileges</li>";
    echo "<li><strong>Check connection:</strong> Verify the host and port are correct</li>";
    echo "</ol>";
    
    echo "<h4>Common Solutions:</h4>";
    echo "<ul>";
    echo "<li><strong>XAMPP:</strong> Start Apache and MySQL from XAMPP Control Panel</li>";
    echo "<li><strong>WAMP:</strong> Start all services from WAMP menu</li>";
    echo "<li><strong>MAMP:</strong> Start servers from MAMP application</li>";
    echo "<li><strong>Manual MySQL:</strong> Start MySQL service from Services (Windows) or systemctl (Linux)</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><small>Database Creation Script - " . date('Y-m-d H:i:s') . "</small></p>";
?>
