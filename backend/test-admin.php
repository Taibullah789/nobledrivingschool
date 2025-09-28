<?php
/**
 * Test Admin Panel Functionality
 */

echo "<h2>🧪 Testing Admin Panel Functionality</h2>";

// Test 1: Database Connection
echo "<h3>1. Database Connection Test</h3>";
try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Database connection successful</p>";
    } else {
        echo "<p style='color: red;'>❌ Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

// Test 2: Contact Model
echo "<h3>2. Contact Model Test</h3>";
try {
    require_once __DIR__ . '/models/Contact.php';
    $contact = new Contact();
    $contacts = $contact->getAll();
    echo "<p style='color: green;'>✅ Contact model working - Found " . count($contacts) . " contacts</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Contact model error: " . $e->getMessage() . "</p>";
}

// Test 3: Registration Model
echo "<h3>3. Registration Model Test</h3>";
try {
    require_once __DIR__ . '/models/Registration.php';
    $registration = new Registration();
    $registrations = $registration->getAll();
    echo "<p style='color: green;'>✅ Registration model working - Found " . count($registrations) . " registrations</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Registration model error: " . $e->getMessage() . "</p>";
}

// Test 4: Email Model
echo "<h3>4. Email Model Test</h3>";
try {
    require_once __DIR__ . '/models/Email.php';
    $email = new Email();
    $emails = $email->getAll();
    echo "<p style='color: green;'>✅ Email model working - Found " . count($emails) . " emails</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Email model error: " . $e->getMessage() . "</p>";
}

// Test 5: API Endpoints
echo "<h3>5. API Endpoints Test</h3>";
$endpoints = [
    'contact-simple.php' => 'Contact API',
    'registration-simple.php' => 'Registration API',
    'cors-test.php' => 'CORS Test'
];

foreach ($endpoints as $endpoint => $name) {
    $url = "http://localhost:8080/api/$endpoint";
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 5
        ]
    ]);
    
    $result = @file_get_contents($url, false, $context);
    if ($result !== false) {
        echo "<p style='color: green;'>✅ $name endpoint working</p>";
    } else {
        echo "<p style='color: red;'>❌ $name endpoint failed</p>";
    }
}

// Test 6: Admin Panel Access
echo "<h3>6. Admin Panel Access Test</h3>";
$admin_url = "http://localhost:8080/admin-simple.php";
$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'timeout' => 5
    ]
]);

$result = @file_get_contents($admin_url, false, $context);
if ($result !== false && strpos($result, 'Admin Login') !== false) {
    echo "<p style='color: green;'>✅ Admin panel accessible</p>";
} else {
    echo "<p style='color: red;'>❌ Admin panel not accessible</p>";
}

echo "<hr>";
echo "<h3>🎯 Summary</h3>";
echo "<p>If all tests show ✅, your admin panel should be fully functional!</p>";
echo "<p><strong>Admin Panel URL:</strong> <a href='admin-simple.php'>admin-simple.php</a></p>";
echo "<p><strong>Login:</strong> admin / admin123</p>";
?>
