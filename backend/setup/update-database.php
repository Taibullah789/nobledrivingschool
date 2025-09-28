<?php
/**
 * Database Update Script
 * Adds email table to existing database
 */

require_once '../config/database.php';

echo "<h2>🔄 Updating Database</h2>";

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    if (!$conn) {
        throw new Exception("Could not connect to database");
    }
    
    echo "<p style='color: green;'>✓ Connected to database successfully</p>";
    
    // Create emails table
    $sql = "CREATE TABLE IF NOT EXISTS emails (
        id INT AUTO_INCREMENT PRIMARY KEY,
        to_email VARCHAR(100) NOT NULL,
        from_email VARCHAR(100) NOT NULL,
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        type ENUM('contact', 'registration', 'notification', 'newsletter') DEFAULT 'contact',
        status ENUM('sent', 'failed', 'pending') DEFAULT 'pending',
        sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "<p style='color: green;'>✓ Emails table created successfully</p>";
    
    echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #155724; margin-top: 0;'>✅ Database Updated Successfully!</h4>";
    echo "<p style='color: #155724; margin-bottom: 0;'>Your database now includes email storage functionality.</p>";
    echo "</div>";
    
    echo "<h4>Next Steps:</h4>";
    echo "<ol>";
    echo "<li>Test your forms - they will now store email logs</li>";
    echo "<li>Access admin panel: <a href='../admin-simple.php'>admin-simple.php</a></li>";
    echo "<li>Check the Email Logs section in the admin panel</li>";
    echo "</ol>";
    
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #721c24; margin-top: 0;'>❌ Database Update Failed</h4>";
    echo "<p style='color: #721c24; margin-bottom: 0;'>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
}

echo "<hr>";
echo "<p><small>Database Update Script - " . date('Y-m-d H:i:s') . "</small></p>";
?>
