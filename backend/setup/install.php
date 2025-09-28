<?php
/**
 * Database Installation Script
 * Noble Driving Academy Backend Setup
 */

require_once '../config/database.php';

echo "<h2>Noble Driving Academy - Database Setup</h2>";

try {
    // Read and execute the schema file
    $schema_file = '../database/schema.sql';
    
    if (!file_exists($schema_file)) {
        throw new Exception("Schema file not found: $schema_file");
    }
    
    $sql = file_get_contents($schema_file);
    
    if (!$sql) {
        throw new Exception("Could not read schema file");
    }
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    $database = new Database();
    $conn = $database->getConnection();
    
    if (!$conn) {
        throw new Exception("Could not connect to database");
    }
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($statements as $statement) {
        if (empty($statement)) continue;
        
        try {
            $conn->exec($statement);
            $success_count++;
            echo "<p style='color: green;'>✓ Executed: " . substr($statement, 0, 50) . "...</p>";
        } catch (PDOException $e) {
            $error_count++;
            echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
        }
    }
    
    echo "<hr>";
    echo "<h3>Setup Summary</h3>";
    echo "<p><strong>Successful statements:</strong> $success_count</p>";
    echo "<p><strong>Failed statements:</strong> $error_count</p>";
    
    if ($error_count == 0) {
        echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h4 style='color: #155724; margin-top: 0;'>✅ Database Setup Complete!</h4>";
        echo "<p style='color: #155724; margin-bottom: 0;'>Your Noble Driving Academy database has been successfully created with all necessary tables and sample data.</p>";
        echo "</div>";
        
        echo "<h4>Next Steps:</h4>";
        echo "<ol>";
        echo "<li>Update your database configuration in <code>config/database.php</code> if needed</li>";
        echo "<li>Configure email settings in <code>config/config.php</code></li>";
        echo "<li>Test the API endpoints</li>";
        echo "<li>Access the admin panel at <code>admin/index.php</code></li>";
        echo "</ol>";
        
        echo "<h4>Default Admin Login:</h4>";
        echo "<p><strong>Username:</strong> admin</p>";
        echo "<p><strong>Password:</strong> admin123</p>";
        echo "<p><em>Please change these credentials immediately after first login!</em></p>";
        
    } else {
        echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h4 style='color: #721c24; margin-top: 0;'>❌ Setup Incomplete</h4>";
        echo "<p style='color: #721c24; margin-bottom: 0;'>Some database operations failed. Please check the errors above and try again.</p>";
        echo "</div>";
    }
    
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4 style='color: #721c24; margin-top: 0;'>❌ Setup Failed</h4>";
    echo "<p style='color: #721c24; margin-bottom: 0;'>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
    
    echo "<h4>Troubleshooting:</h4>";
    echo "<ol>";
    echo "<li>Make sure MySQL/MariaDB is running</li>";
    echo "<li>Check your database credentials in <code>config/database.php</code></li>";
    echo "<li>Ensure the database user has CREATE privileges</li>";
    echo "<li>Verify the database server is accessible</li>";
    echo "</ol>";
}

echo "<hr>";
echo "<p><small>Noble Driving Academy Backend Setup - " . date('Y-m-d H:i:s') . "</small></p>";
?>
