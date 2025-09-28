<?php
/**
 * Registration Model
 * Handles registration form data operations
 */

require_once __DIR__ . '/../config/database.php';

class Registration {
    private $conn;
    private $table_name = "registrations";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (first_name, middle_name, last_name, address_line1, city, state, zip_code, 
                   age_category, school_name, phone, email, course_id, comment, status) 
                  VALUES (:first_name, :middle_name, :last_name, :address_line1, :city, :state, 
                          :zip_code, :age_category, :school_name, :phone, :email, :course_id, :comment, 'pending')";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':middle_name', $data['middle_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':address_line1', $data['address_line1']);
        $stmt->bindParam(':city', $data['city']);
        $stmt->bindParam(':state', $data['state']);
        $stmt->bindParam(':zip_code', $data['zip_code']);
        $stmt->bindParam(':age_category', $data['age_category']);
        $stmt->bindParam(':school_name', $data['school_name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':course_id', $data['course_id']);
        $stmt->bindParam(':comment', $data['comment']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT r.*, c.name as course_name 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN courses c ON r.course_id = c.id 
                  ORDER BY r.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT r.*, c.name as course_name 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN courses c ON r.course_id = c.id 
                  WHERE r.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function update($id, $data) {
        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if ($key !== 'id' && $value !== null) {
                $fields[] = "$key = :$key";
                $params[$key] = $value;
            }
        }

        if (empty($fields)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " 
                  SET " . implode(', ', $fields) . ", updated_at = CURRENT_TIMESTAMP 
                  WHERE id = :id";

        $params['id'] = $id;
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " 
                  SET status = :status, updated_at = CURRENT_TIMESTAMP 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function getStats() {
        $query = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_count,
                    SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved_count,
                    SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected_count,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_count
                  FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getByStatus($status) {
        $query = "SELECT r.*, c.name as course_name 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN courses c ON r.course_id = c.id 
                  WHERE r.status = :status 
                  ORDER BY r.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>
