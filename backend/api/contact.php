<?php
/**
 * Contact Form API Endpoint
 * Handles contact form submissions
 */

// Set CORS headers directly
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Contact.php';

// Response helper functions are now in config.php

// Log activity
function logActivity($action, $details = '') {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'action' => $action,
        'details' => $details
    ];
    
    $log_file = '../logs/activity.log';
    file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
}

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'POST':
        handleContactSubmission();
        break;
    case 'GET':
        handleGetContacts();
        break;
    default:
        sendError('Method not allowed', 405);
}

function handleContactSubmission() {
    try {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Invalid JSON input');
        }

        // Validate required fields
        $required_fields = ['firstName', 'lastName', 'email', 'message'];
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                sendError("Field '$field' is required");
            }
        }

        // Validate email
        if (!validateEmail($input['email'])) {
            sendError('Invalid email format');
        }

        // Sanitize input data
        $contact_data = [
            'first_name' => sanitizeInput($input['firstName']),
            'last_name' => sanitizeInput($input['lastName']),
            'email' => sanitizeInput($input['email']),
            'subject' => sanitizeInput($input['subject'] ?? ''),
            'course_id' => !empty($input['course']) ? getCourseIdByName($input['course']) : null,
            'message' => sanitizeInput($input['message'])
        ];

        // Create contact record
        $contact = new Contact();
        $result = $contact->create($contact_data);

        if ($result) {
            // Log the submission
            logActivity('contact_submission', json_encode($contact_data));
            
            // Send email notification
            sendContactEmail($contact_data);
            
            sendResponse([
                'success' => true,
                'message' => 'Contact form submitted successfully',
                'id' => $result
            ], 201);
        } else {
            logActivity('contact_submission_failed', json_encode($contact_data));
            sendError('Failed to submit contact form');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleGetContacts() {
    try {
        // Check for admin authentication (implement JWT or session auth)
        $contact = new Contact();
        $contacts = $contact->getAll();
        
        sendResponse([
            'success' => true,
            'data' => $contacts
        ]);

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function getCourseIdByName($course_name) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $query = "SELECT id FROM courses WHERE name = :name";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $course_name);
    $stmt->execute();
    
    $result = $stmt->fetch();
    return $result ? $result['id'] : null;
}

function sendContactEmail($contact_data) {
    $to = FROM_EMAIL;
    $subject = "New Contact Form Submission - " . $contact_data['subject'];
    
    $message = "
    <html>
    <head>
        <title>New Contact Form Submission</title>
    </head>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$contact_data['first_name']} {$contact_data['last_name']}</p>
        <p><strong>Email:</strong> {$contact_data['email']}</p>
        <p><strong>Subject:</strong> {$contact_data['subject']}</p>
        <p><strong>Message:</strong></p>
        <p>{$contact_data['message']}</p>
        <hr>
        <p><em>Submitted on: " . date('Y-m-d H:i:s') . "</em></p>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_EMAIL . "\r\n";
    
    mail($to, $subject, $message, $headers);
}
?>
