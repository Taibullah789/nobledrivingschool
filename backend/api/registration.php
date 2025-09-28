<?php
/**
 * Registration Form API Endpoint
 * Handles registration form submissions
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
require_once __DIR__ . '/../models/Registration.php';

// Response helper functions are now in config.php

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'POST':
        handleRegistrationSubmission();
        break;
    case 'GET':
        handleGetRegistrations();
        break;
    case 'PUT':
        handleUpdateRegistration();
        break;
    default:
        sendError('Method not allowed', 405);
}

function handleRegistrationSubmission() {
    try {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Invalid JSON input');
        }

        // Validate required fields
        $required_fields = ['firstName', 'lastName', 'addressLine1', 'city', 'state', 'zipCode', 'age', 'email', 'course'];
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
        $registration_data = [
            'first_name' => sanitizeInput($input['firstName']),
            'middle_name' => sanitizeInput($input['middleName'] ?? ''),
            'last_name' => sanitizeInput($input['lastName']),
            'address_line1' => sanitizeInput($input['addressLine1']),
            'city' => sanitizeInput($input['city']),
            'state' => sanitizeInput($input['state']),
            'zip_code' => sanitizeInput($input['zipCode']),
            'age_category' => sanitizeInput($input['age']),
            'school_name' => sanitizeInput($input['schoolName'] ?? ''),
            'phone' => sanitizeInput($input['phone'] ?? ''),
            'email' => sanitizeInput($input['email']),
            'course_id' => getCourseIdByValue($input['course']),
            'comment' => sanitizeInput($input['comment'] ?? '')
        ];

        // Create registration record
        $registration = new Registration();
        $result = $registration->create($registration_data);

        if ($result) {
            // Send email notification
            sendRegistrationEmail($registration_data);
            
            sendResponse([
                'success' => true,
                'message' => 'Registration submitted successfully',
                'id' => $result
            ], 201);
        } else {
            sendError('Failed to submit registration');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleGetRegistrations() {
    try {
        // Check for admin authentication
        $registration = new Registration();
        $registrations = $registration->getAll();
        
        sendResponse([
            'success' => true,
            'data' => $registrations
        ]);

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleUpdateRegistration() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['id'])) {
            sendError('Invalid input or missing ID');
        }

        $registration = new Registration();
        $result = $registration->update($input['id'], $input);
        
        if ($result) {
            sendResponse([
                'success' => true,
                'message' => 'Registration updated successfully'
            ]);
        } else {
            sendError('Failed to update registration');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function getCourseIdByValue($course_value) {
    $course_mapping = [
        'teen-behind-wheel' => 1,
        'adult-behind-wheel' => 1,
        'driver-education' => 2,
        're-examination' => 4,
        'private-lesson' => 3,
        '5-point-class' => 4
    ];
    
    return $course_mapping[$course_value] ?? 1;
}

function sendRegistrationEmail($registration_data) {
    $to = FROM_EMAIL;
    $subject = "New Registration Submission - " . $registration_data['first_name'] . " " . $registration_data['last_name'];
    
    $message = "
    <html>
    <head>
        <title>New Registration Submission</title>
    </head>
    <body>
        <h2>New Registration Submission</h2>
        <p><strong>Name:</strong> {$registration_data['first_name']} {$registration_data['middle_name']} {$registration_data['last_name']}</p>
        <p><strong>Email:</strong> {$registration_data['email']}</p>
        <p><strong>Phone:</strong> {$registration_data['phone']}</p>
        <p><strong>Address:</strong> {$registration_data['address_line1']}, {$registration_data['city']}, {$registration_data['state']} {$registration_data['zip_code']}</p>
        <p><strong>Age Category:</strong> {$registration_data['age_category']}</p>
        <p><strong>School:</strong> {$registration_data['school_name']}</p>
        <p><strong>Course:</strong> {$registration_data['course_id']}</p>
        <p><strong>Comments:</strong> {$registration_data['comment']}</p>
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
