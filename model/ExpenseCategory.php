<?php
require_once 'dbmodel.php';

class ExpenseCategory {
    private $db;
    private $table = 'expense_categories';
   
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function createCategory($userId, $name, $monthlyLimit, $spent) {
        try {
            if (!$this->db) {
                error_log("Database connection failed");
                return [false, "Database connection failed", null];
            }
            
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table} (user_id, name, monthly_limit, spent) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$userId, trim($name), floatval($monthlyLimit), $spent]);
            return [true, "Category created successfully", $this->db->lastInsertId()];
        } catch (PDOException $e) {
            error_log("Failed to create category: " . $e->getMessage());
            return [false, "Failed to create category: " . $e->getMessage(), null];
        }
    }
    public function getCategoriesByUser($userId) {
        try {
            $stmt = $this->db->prepare("SELECT id, name, monthly_limit, spent FROM {$this->table} WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Failed to fetch categories: " . $e->getMessage());
            return false;
        }
    }
    
}