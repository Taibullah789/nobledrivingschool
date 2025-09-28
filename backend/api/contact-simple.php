<?php
/**
 * Simple Contact Form API
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
        logSecurityEvent('suspicious_contact_form', json_encode($input));
        throw new Exception('Invalid input detected');
    }
    
    // Sanitize input
    $input = sanitizeInput($input);

    // Validate required fields
    $required_fields = ['firstName', 'lastName', 'email', 'message'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            throw new Exception("Field '$field' is required");
        }
    }

    // Validate email
    if (!validateEmail($input['email'])) {
        throw new Exception('Invalid email format');
    }

    // Save to database
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../models/Contact.php';
    
    $contact_data = [
        'first_name' => $input['firstName'],
        'last_name' => $input['lastName'],
        'email' => $input['email'],
        'subject' => $input['subject'] ?? '',
        'course_id' => null, // No course selection in simple contact form
        'message' => $input['message']
    ];
    
    $contact = new Contact();
    $result = $contact->create($contact_data);
    
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
            'subject' => 'New Contact Form: ' . ($input['subject'] ?? 'No Subject'),
            'message' => "Name: {$input['firstName']} {$input['lastName']}\nEmail: {$input['email']}\nSubject: " . ($input['subject'] ?? 'No Subject') . "\nMessage: {$input['message']}",
            'type' => 'contact',
            'status' => 'sent'
        ];
        
        $email->create($email_data);
        
        // Send notification email to admin
        $contact_data = [
            'first_name' => $input['firstName'],
            'last_name' => $input['lastName'],
            'email' => $input['email'],
            'subject' => $input['subject'] ?? 'No Subject',
            'message' => $input['message']
        ];
        
        $emailService->sendContactNotification($contact_data);
        
        // Send confirmation email to user
        $emailService->sendConfirmationEmail($input['email'], 'contact', $contact_data);
        
        echo json_encode([
            'success' => true,
            'message' => 'Contact form submitted successfully',
            'id' => $result
        ]);
    } else {
        throw new Exception('Failed to save contact to database');
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
