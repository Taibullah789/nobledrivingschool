<?php
/**
 * CORS Server for Development
 * Run this to start a server with proper CORS headers
 */

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Route requests to the appropriate API
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

if (strpos($path, '/contact.php') !== false) {
    include 'api/contact.php';
} elseif (strpos($path, '/registration.php') !== false) {
    include 'api/registration.php';
} else {
    echo json_encode(['error' => 'API endpoint not found']);
}
?>
