<?php
/**
 * Simple API Test
 * Test the API endpoints directly
 */

// Set error reporting to show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🧪 API Endpoint Test</h2>";

// Test Contact API
echo "<h3>1. Testing Contact API</h3>";

$contact_data = [
    'firstName' => 'Test',
    'lastName' => 'User',
    'email' => 'test@example.com',
    'subject' => 'Test Subject',
    'message' => 'This is a test message.'
];

$url = 'http://localhost:8080/api/contact-simple.php';

// Create context for POST request
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($contact_data)
    ]
]);

echo "<p><strong>Request:</strong></p>";
echo "<pre>" . json_encode($contact_data, JSON_PRETTY_PRINT) . "</pre>";

$result = @file_get_contents($url, false, $context);

echo "<p><strong>Response:</strong></p>";
if ($result !== false) {
    echo "<p style='color: green;'>✅ API Response received</p>";
    echo "<pre>" . htmlspecialchars($result) . "</pre>";
    
    // Try to decode JSON
    $json_result = json_decode($result, true);
    if ($json_result !== null) {
        echo "<p style='color: green;'>✅ Valid JSON response</p>";
        echo "<pre>" . json_encode($json_result, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "<p style='color: red;'>❌ Invalid JSON response</p>";
    }
} else {
    echo "<p style='color: red;'>❌ API request failed</p>";
    $error = error_get_last();
    if ($error) {
        echo "<p>Error: " . $error['message'] . "</p>";
    }
}

echo "<hr>";

// Test Registration API
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

echo "<p><strong>Request:</strong></p>";
echo "<pre>" . json_encode($registration_data, JSON_PRETTY_PRINT) . "</pre>";

$result = @file_get_contents($url, false, $context);

echo "<p><strong>Response:</strong></p>";
if ($result !== false) {
    echo "<p style='color: green;'>✅ API Response received</p>";
    echo "<pre>" . htmlspecialchars($result) . "</pre>";
    
    // Try to decode JSON
    $json_result = json_decode($result, true);
    if ($json_result !== null) {
        echo "<p style='color: green;'>✅ Valid JSON response</p>";
        echo "<pre>" . json_encode($json_result, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "<p style='color: red;'>❌ Invalid JSON response</p>";
    }
} else {
    echo "<p style='color: red;'>❌ API request failed</p>";
    $error = error_get_last();
    if ($error) {
        echo "<p>Error: " . $error['message'] . "</p>";
    }
}

echo "<hr>";
echo "<p><strong>Test Complete!</strong></p>";
echo "<p><a href='admin-simple.php'>Check Admin Panel</a> | <a href='test-forms.html'>Test Forms</a></p>";
?>
