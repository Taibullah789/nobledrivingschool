<?php
/**
 * Simple Registration Form API
 * Simplified version without complex dependencies
 */

// Security and CORS headers
require_once __DIR__ . '/../config/security.php';

// Rate limiting
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!RateLimiter::checkLimit($client_ip)) {
    http_response_code(429);
    echo json_encode(['error' => 'Too many requests. Please try again later.']);
    exit();
}

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

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        throw new Exception('Invalid JSON input');
    }

    // Check for suspicious activity
    if (checkSuspiciousActivity($input)) {
        logSecurityEvent('suspicious_registration_form', json_encode($input));
        throw new Exception('Invalid input detected');
    }
    
    // Sanitize input
    $input = sanitizeInput($input);

    // Validate required fields
    $required_fields = ['firstName', 'lastName', 'email', 'addressLine1', 'city', 'state', 'zipCode', 'age', 'course'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            throw new Exception("Field '$field' is required");
        }
    }

    // Validate email
    if (!validateEmail($input['email'])) {
        throw new Exception('Invalid email format');
    }
    
    // Validate phone if provided
    if (!empty($input['phone']) && !validatePhone($input['phone'])) {
        throw new Exception('Invalid phone number format');
    }

    // Save to database
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../models/Registration.php';
    
    // Map course value to course ID
    $course_mapping = [
        'teen-behind-wheel' => 1,
        'adult-behind-wheel' => 1,
        'driver-education' => 2,
        're-examination' => 4,
        'private-lesson' => 3,
        '5-point-class' => 4
    ];
    
    $registration_data = [
        'first_name' => $input['firstName'],
        'middle_name' => $input['middleName'] ?? '',
        'last_name' => $input['lastName'],
        'address_line1' => $input['addressLine1'],
        'city' => $input['city'],
        'state' => $input['state'],
        'zip_code' => $input['zipCode'],
        'age_category' => $input['age'],
        'school_name' => $input['schoolName'] ?? '',
        'phone' => $input['phone'] ?? '',
        'email' => $input['email'],
        'course_id' => $course_mapping[$input['course']] ?? 1,
        'comment' => $input['comment'] ?? ''
    ];
    
    $registration = new Registration();
    $result = $registration->create($registration_data);
    
    if ($result) {
        // Store email notification
        require_once __DIR__ . '/../models/Email.php';
        require_once __DIR__ . '/../config/email.php';
        
        $email = new Email();
        $emailService = new EmailService();
        
        // Store email log
        $email_data = [
            'to_email' => FROM_EMAIL,
            'from_email' => $input['email'],
            'subject' => 'New Registration: ' . $input['firstName'] . ' ' . $input['lastName'],
            'message' => "New Registration:\nName: {$input['firstName']} {$input['lastName']}\nEmail: {$input['email']}\nPhone: " . ($input['phone'] ?? 'Not provided') . "\nAddress: {$input['addressLine1']}, {$input['city']}, {$input['state']} {$input['zipCode']}\nAge: {$input['age']}\nCourse: {$input['course']}\nComments: " . ($input['comment'] ?? 'None'),
            'type' => 'registration',
            'status' => 'sent'
        ];
        
        $email->create($email_data);
        
        // Send notification email to admin
        $registration_data = [
            'first_name' => $input['firstName'],
            'last_name' => $input['lastName'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? '',
            'address_line1' => $input['addressLine1'],
            'city' => $input['city'],
            'state' => $input['state'],
            'zip_code' => $input['zipCode'],
            'age_category' => $input['age'],
            'course_id' => $course_mapping[$input['course']] ?? 1,
            'comment' => $input['comment'] ?? ''
        ];
        
        $emailService->sendRegistrationNotification($registration_data);
        
        // Send confirmation email to user
        $emailService->sendConfirmationEmail($input['email'], 'registration', [
            'first_name' => $input['firstName'],
            'course' => $input['course']
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Registration submitted successfully',
            'id' => $result
        ]);
    } else {
        throw new Exception('Failed to save registration to database');
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
