<?php
/**
 * Email Model
 * Handles email storage and notifications
 */

require_once __DIR__ . '/../config/database.php';

class Email {
    private $conn;
    private $table_name = "emails";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (to_email, from_email, subject, message, type, status, sent_at) 
                  VALUES (:to_email, :from_email, :subject, :message, :type, :status, NOW())";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':to_email', $data['to_email']);
        $stmt->bindParam(':from_email', $data['from_email']);
        $stmt->bindParam(':subject', $data['subject']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':status', $data['status']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY sent_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByType($type) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE type = :type ORDER BY sent_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
