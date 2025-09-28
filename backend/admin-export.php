<?php
/**
 * Admin Export Functionality
 * Export data to CSV/Excel formats
 */

session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin-simple.php');
    exit();
}

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Contact.php';
require_once __DIR__ . '/models/Registration.php';
require_once __DIR__ . '/models/Email.php';

$contact = new Contact();
$registration = new Registration();
$email = new Email();

$type = $_GET['type'] ?? 'all';
$format = $_GET['format'] ?? 'csv';

// Get data based on type
switch ($type) {
    case 'contacts':
        $data = $contact->getAll();
        $filename = 'contacts_' . date('Y-m-d_H-i-s');
        break;
    case 'registrations':
        $data = $registration->getAll();
        $filename = 'registrations_' . date('Y-m-d_H-i-s');
        break;
    case 'emails':
        $data = $email->getAll();
        $filename = 'emails_' . date('Y-m-d_H-i-s');
        break;
    default:
        // Export all data
        $contacts = $contact->getAll();
        $registrations = $registration->getAll();
        $emails = $email->getAll();
        $data = [
            'contacts' => $contacts,
            'registrations' => $registrations,
            'emails' => $emails
        ];
        $filename = 'all_data_' . date('Y-m-d_H-i-s');
        break;
}

if ($format === 'csv') {
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    if ($type === 'all') {
        // Export all data in separate sections
        fputcsv($output, ['CONTACTS']);
        fputcsv($output, ['ID', 'First Name', 'Last Name', 'Email', 'Subject', 'Status', 'Created At']);
        foreach ($data['contacts'] as $row) {
            fputcsv($output, [
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['subject'],
                $row['status'],
                $row['created_at']
            ]);
        }
        
        fputcsv($output, []); // Empty row
        fputcsv($output, ['REGISTRATIONS']);
        fputcsv($output, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'City', 'State', 'Course ID', 'Status', 'Created At']);
        foreach ($data['registrations'] as $row) {
            fputcsv($output, [
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone'],
                $row['city'],
                $row['state'],
                $row['course_id'],
                $row['status'],
                $row['created_at']
            ]);
        }
        
        fputcsv($output, []); // Empty row
        fputcsv($output, ['EMAILS']);
        fputcsv($output, ['ID', 'To Email', 'From Email', 'Subject', 'Type', 'Status', 'Sent At']);
        foreach ($data['emails'] as $row) {
            fputcsv($output, [
                $row['id'],
                $row['to_email'],
                $row['from_email'],
                $row['subject'],
                $row['type'],
                $row['status'],
                $row['sent_at']
            ]);
        }
    } else {
        // Export specific type
        if (!empty($data)) {
            $headers = array_keys($data[0]);
            fputcsv($output, $headers);
            
            foreach ($data as $row) {
                fputcsv($output, array_values($row));
            }
        }
    }
    
    fclose($output);
} else {
    // JSON export
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="' . $filename . '.json"');
    echo json_encode($data, JSON_PRETTY_PRINT);
}
?>
