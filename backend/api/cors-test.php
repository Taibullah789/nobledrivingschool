<?php
/**
 * CORS Test Endpoint
 * Simple endpoint to test CORS headers
 */

require_once '../config/cors.php';

// Simple test response
echo json_encode([
    'success' => true,
    'message' => 'CORS test successful',
    'timestamp' => date('Y-m-d H:i:s'),
    'origin' => $_SERVER['HTTP_ORIGIN'] ?? 'unknown',
    'method' => $_SERVER['REQUEST_METHOD'],
    'headers' => getallheaders()
]);
?>
