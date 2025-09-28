<?php
/**
 * Email Configuration
 * Production-ready email functionality
 */

require_once 'config.php';

class EmailService {
    private $smtp_host;
    private $smtp_port;
    private $smtp_username;
    private $smtp_password;
    private $from_email;
    private $from_name;

    public function __construct() {
        $this->smtp_host = SMTP_HOST;
        $this->smtp_port = SMTP_PORT;
        $this->smtp_username = SMTP_USERNAME;
        $this->smtp_password = SMTP_PASSWORD;
        $this->from_email = FROM_EMAIL;
        $this->from_name = FROM_NAME;
    }

    public function sendEmail($to, $subject, $message, $is_html = false) {
        try {
            // For development, we'll use PHP's mail() function
            // In production, you should use PHPMailer or similar
            $headers = [
                'From: ' . $this->from_name . ' <' . $this->from_email . '>',
                'Reply-To: ' . $this->from_email,
                'X-Mailer: PHP/' . phpversion(),
                'MIME-Version: 1.0',
                'Content-Type: ' . ($is_html ? 'text/html' : 'text/plain') . '; charset=UTF-8'
            ];

            $result = mail($to, $subject, $message, implode("\r\n", $headers));
            
            if ($result) {
                $this->logEmail($to, $subject, 'sent');
                return true;
            } else {
                $this->logEmail($to, $subject, 'failed');
                return false;
            }
        } catch (Exception $e) {
            $this->logEmail($to, $subject, 'failed', $e->getMessage());
            return false;
        }
    }

    public function sendContactNotification($contact_data) {
        $subject = "New Contact Form: " . $contact_data['subject'];
        $message = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$contact_data['first_name']} {$contact_data['last_name']}</p>
        <p><strong>Email:</strong> {$contact_data['email']}</p>
        <p><strong>Subject:</strong> {$contact_data['subject']}</p>
        <p><strong>Message:</strong></p>
        <p>{$contact_data['message']}</p>
        <hr>
        <p><small>Submitted on: " . date('Y-m-d H:i:s') . "</small></p>
        ";

        return $this->sendEmail(FROM_EMAIL, $subject, $message, true);
    }

    public function sendRegistrationNotification($registration_data) {
        $subject = "New Registration: " . $registration_data['first_name'] . " " . $registration_data['last_name'];
        $message = "
        <h2>New Registration</h2>
        <p><strong>Name:</strong> {$registration_data['first_name']} {$registration_data['last_name']}</p>
        <p><strong>Email:</strong> {$registration_data['email']}</p>
        <p><strong>Phone:</strong> {$registration_data['phone']}</p>
        <p><strong>Address:</strong> {$registration_data['address_line1']}, {$registration_data['city']}, {$registration_data['state']} {$registration_data['zip_code']}</p>
        <p><strong>Age:</strong> {$registration_data['age_category']}</p>
        <p><strong>Course:</strong> {$registration_data['course_id']}</p>
        <p><strong>Comments:</strong> {$registration_data['comment']}</p>
        <hr>
        <p><small>Submitted on: " . date('Y-m-d H:i:s') . "</small></p>
        ";

        return $this->sendEmail(FROM_EMAIL, $subject, $message, true);
    }

    public function sendConfirmationEmail($to, $type, $data) {
        if ($type === 'contact') {
            $subject = "Thank you for contacting Noble Driving Academy";
            $message = "
            <h2>Thank you for your message!</h2>
            <p>Dear {$data['first_name']},</p>
            <p>We have received your message and will get back to you within 24 hours.</p>
            <p><strong>Your message:</strong></p>
            <p>{$data['message']}</p>
            <hr>
            <p>Best regards,<br>Noble Driving Academy Team</p>
            ";
        } else {
            $subject = "Registration Confirmation - Noble Driving Academy";
            $message = "
            <h2>Registration Confirmed!</h2>
            <p>Dear {$data['first_name']},</p>
            <p>Thank you for registering with Noble Driving Academy. We will contact you soon to schedule your course.</p>
            <p><strong>Registration Details:</strong></p>
            <p>Name: {$data['first_name']} {$data['last_name']}</p>
            <p>Course: {$data['course']}</p>
            <hr>
            <p>Best regards,<br>Noble Driving Academy Team</p>
            ";
        }

        return $this->sendEmail($to, $subject, $message, true);
    }

    private function logEmail($to, $subject, $status, $error = '') {
        $log_entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'to' => $to,
            'subject' => $subject,
            'status' => $status,
            'error' => $error
        ];

        $log_file = '../logs/email.log';
        if (!is_dir('../logs')) {
            mkdir('../logs', 0755, true);
        }

        file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
    }
}
?>
