<?php
/**
 * Simple PHP Server for Testing
 * Run this to start a PHP server on port 8080
 */

echo "Starting PHP server on http://localhost:8080\n";
echo "Press Ctrl+C to stop\n\n";

// Start the server
$command = "php -S localhost:8080 -t .";
system($command);
?>
