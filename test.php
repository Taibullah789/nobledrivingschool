<?php
/**
 * Simple test script to verify PHP and database connection
 */

echo "<h2>Noble Driving Academy - System Test</h2>";

// Test 1: PHP Version
echo "<h3>1. PHP Version</h3>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";

// Test 2: PDO Extension
echo "<h3>2. PDO Extension</h3>";
if (extension_loaded('pdo')) {
    echo "<p style='color: green;'>✓ PDO extension is loaded</p>";
} else {
    echo "<p style='color: red;'>✗ PDO extension is not loaded</p>";
}

// Test 3: PDO MySQL
echo "<h3>3. PDO MySQL Driver</h3>";
if (extension_loaded('pdo_mysql')) {
    echo "<p style='color: green;'>✓ PDO MySQL driver is available</p>";
} else {
    echo "<p style='color: red;'>✗ PDO MySQL driver is not available</p>";
}

// Test 4: Database Connection
echo "<h3>4. Database Connection Test</h3>";
try {
    require_once 'backend/config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'>✓ Database connection successful</p>";
        
        // Test 5: Check if database exists and has tables
        echo "<h3>5. Database Tables</h3>";
        $query = "SHOW TABLES";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "<p style='color: green;'>✓ Database has " . count($tables) . " tables:</p>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>$table</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠ Database exists but has no tables. Run the installation script.</p>";
            echo "<p><a href='backend/setup/install.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Run Installation</a></p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Database connection failed</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}

// Test 6: File Permissions
echo "<h3>6. File System</h3>";
if (is_writable('backend/')) {
    echo "<p style='color: green;'>✓ Backend directory is writable</p>";
} else {
    echo "<p style='color: orange;'>⚠ Backend directory may not be writable</p>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>If all tests pass, <a href='backend/setup/install.php'>run the installation script</a></li>";
echo "<li>If database connection fails, check your MySQL credentials in <code>backend/config/database.php</code></li>";
echo "<li>If PDO is missing, install PHP with PDO support</li>";
echo "<li>After installation, access the <a href='backend/admin/'>admin panel</a></li>";
echo "</ol>";

echo "<p><small>Test completed at: " . date('Y-m-d H:i:s') . "</small></p>";
?>
