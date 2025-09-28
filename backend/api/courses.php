<?php
/**
 * Courses API Endpoint
 * Handles course data operations
 */

require_once '../config/cors.php';
require_once '../config/config.php';
require_once '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        handleGetCourses();
        break;
    case 'POST':
        handleCreateCourse();
        break;
    case 'PUT':
        handleUpdateCourse();
        break;
    case 'DELETE':
        handleDeleteCourse();
        break;
    default:
        sendError('Method not allowed', 405);
}

function handleGetCourses() {
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "SELECT * FROM courses WHERE is_active = 1 ORDER BY name";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $courses = $stmt->fetchAll();
        
        sendResponse([
            'success' => true,
            'data' => $courses
        ]);

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleCreateCourse() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Invalid JSON input');
        }

        $required_fields = ['name', 'description', 'price'];
        foreach ($required_fields as $field) {
            if (empty($input[$field])) {
                sendError("Field '$field' is required");
            }
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "INSERT INTO courses (name, description, price, duration_hours) 
                  VALUES (:name, :description, :price, :duration_hours)";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $input['name']);
        $stmt->bindParam(':description', $input['description']);
        $stmt->bindParam(':price', $input['price']);
        $stmt->bindParam(':duration_hours', $input['duration_hours'] ?? null);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Course created successfully',
                'id' => $conn->lastInsertId()
            ], 201);
        } else {
            sendError('Failed to create course');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleUpdateCourse() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['id'])) {
            sendError('Invalid input or missing ID');
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        $query = "UPDATE courses SET 
                  name = :name, 
                  description = :description, 
                  price = :price, 
                  duration_hours = :duration_hours,
                  is_active = :is_active,
                  updated_at = CURRENT_TIMESTAMP 
                  WHERE id = :id";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $input['id']);
        $stmt->bindParam(':name', $input['name']);
        $stmt->bindParam(':description', $input['description']);
        $stmt->bindParam(':price', $input['price']);
        $stmt->bindParam(':duration_hours', $input['duration_hours']);
        $stmt->bindParam(':is_active', $input['is_active'] ?? 1);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Course updated successfully'
            ]);
        } else {
            sendError('Failed to update course');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}

function handleDeleteCourse() {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['id'])) {
            sendError('Invalid input or missing ID');
        }

        $database = new Database();
        $conn = $database->getConnection();
        
        // Soft delete by setting is_active to 0
        $query = "UPDATE courses SET is_active = 0, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $input['id']);
        
        if ($stmt->execute()) {
            sendResponse([
                'success' => true,
                'message' => 'Course deleted successfully'
            ]);
        } else {
            sendError('Failed to delete course');
        }

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
}
?>
