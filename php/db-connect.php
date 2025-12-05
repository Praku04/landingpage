<?php
/**
 * Database Connection - The Management Gurus
 * PDO connection with error handling
 */

require_once __DIR__ . '/config.php';

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    // Prevent cloning
    private function __clone() {}

    // Prevent unserialization
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

/**
 * SQL Schema for inquiries table
 * Run this SQL to create the table:
 * 
 * CREATE TABLE inquiries (
 *     id INT AUTO_INCREMENT PRIMARY KEY,
 *     full_name VARCHAR(100) NOT NULL,
 *     email VARCHAR(150) NOT NULL,
 *     phone VARCHAR(20) NOT NULL,
 *     message TEXT,
 *     submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 *     ip_address VARCHAR(45),
 *     status ENUM('new', 'contacted', 'converted', 'closed') DEFAULT 'new',
 *     INDEX idx_email (email),
 *     INDEX idx_status (status),
 *     INDEX idx_submitted_at (submitted_at)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 */
