<?php
/**
 * Test API Endpoint
 * Simple endpoint to test CORS and connectivity
 */

require_once '../config/cors.php';
require_once '../config/config.php';

// Simple test response
sendResponse([
    'success' => true,
    'message' => 'API is working correctly',
    'timestamp' => date('Y-m-d H:i:s'),
    'origin' => $_SERVER['HTTP_ORIGIN'] ?? 'unknown',
    'method' => $_SERVER['REQUEST_METHOD']
]);
?>
