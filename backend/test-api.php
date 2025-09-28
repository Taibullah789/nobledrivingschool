<?php
/**
 * Test API Endpoints
 */

echo "<h2>🧪 Testing API Endpoints</h2>";

// Test 1: Contact API
echo "<h3>1. Testing Contact API</h3>";
$contact_data = [
    'firstName' => 'Test',
    'lastName' => 'User',
    'email' => 'test@example.com',
    'message' => 'Test message'
];

$url = 'http://localhost:8080/api/contact-simple.php';
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($contact_data)
    ]
]);

$result = @file_get_contents($url, false, $context);
if ($result !== false) {
    echo "<p style='color: green;'>✅ Contact API working</p>";
    echo "<pre>" . htmlspecialchars($result) . "</pre>";
} else {
    echo "<p style='color: red;'>❌ Contact API failed</p>";
    echo "<p>Error: " . error_get_last()['message'] . "</p>";
}

// Test 2: Registration API
echo "<h3>2. Testing Registration API</h3>";
$registration_data = [
    'firstName' => 'Test',
    'lastName' => 'User',
    'email' => 'test@example.com',
    'addressLine1' => '123 Test St',
    'city' => 'Test City',
    'state' => 'TS',
    'zipCode' => '12345',
    'age' => '18-25',
    'course' => 'teen-behind-wheel'
];

$url = 'http://localhost:8080/api/registration-simple.php';
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($registration_data)
    ]
]);

$result = @file_get_contents($url, false, $context);
if ($result !== false) {
    echo "<p style='color: green;'>✅ Registration API working</p>";
    echo "<pre>" . htmlspecialchars($result) . "</pre>";
} else {
    echo "<p style='color: red;'>❌ Registration API failed</p>";
    echo "<p>Error: " . error_get_last()['message'] . "</p>";
}

echo "<hr>";
echo "<p><strong>API Test Complete!</strong></p>";
?>
