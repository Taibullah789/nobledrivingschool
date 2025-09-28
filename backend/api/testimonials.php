<?php
/**
 * Testimonials API Endpoint
 * Handles testimonial data operations
 */

require_once '../config/cors.php';
require_once '../config/config.php';
require_once '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        handleGetTestimonials();
        break;
    case 'POST':
        handleCreateTestimonial();
        break;
    case 'PUT':
        handleUpdateTestimonial();
        break;
    case 'DELETE':
        handleDeleteTestimonial();
        break;
    default:
        sendError('Method not allowed', 405);
}

function handleGetTestimonials() {
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Get approved testimonials for public display
        $query = "SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $testimonials = $stmt->fetchAll();
        
        sendResponse([
            'success' => true,
            'data' => $testimonials
        ]);

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleCreateTestimonial() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Invalid JSON input');
        }

        $required_fields = ['student_name', 'testimonial'];
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                sendError("Field '$field' is required");
            }
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO testimonials (student_name, course_name, rating, testimonial, is_approved) 
                  VALUES (:student_name, :course_name, :rating, :testimonial, :is_approved)";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_name', $input['student_name']);
        $stmt->bindParam(':course_name', $input['course_name'] ?? '');
        $stmt->bindParam(':rating', $input['rating'] ?? 5);
        $stmt->bindParam(':testimonial', $input['testimonial']);
        $stmt->bindParam(':is_approved', $input['is_approved'] ?? 0);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Testimonial submitted successfully',
                'id' => $conn->lastInsertId()
            ], 201);
        } else {
            sendError('Failed to submit testimonial');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleUpdateTestimonial() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['id'])) {
            sendError('Invalid input or missing ID');
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE testimonials SET 
                  student_name = :student_name, 
                  course_name = :course_name, 
                  rating = :rating, 
                  testimonial = :testimonial,
                  is_approved = :is_approved,
                  updated_at = CURRENT_TIMESTAMP 
                  WHERE id = :id";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $input['id']);
        $stmt->bindParam(':student_name', $input['student_name']);
        $stmt->bindParam(':course_name', $input['course_name']);
        $stmt->bindParam(':rating', $input['rating']);
        $stmt->bindParam(':testimonial', $input['testimonial']);
        $stmt->bindParam(':is_approved', $input['is_approved']);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Testimonial updated successfully'
            ]);
        } else {
            sendError('Failed to update testimonial');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleDeleteTestimonial() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['id'])) {
            sendError('Invalid input or missing ID');
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "DELETE FROM testimonials WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $input['id']);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Testimonial deleted successfully'
            ]);
        } else {
            sendError('Failed to delete testimonial');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}
?>
