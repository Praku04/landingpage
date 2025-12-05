<?php
/**
 * Database Setup Script - The Management Gurus
 * Run this script once to create the database tables
 * 
 * Usage: php database/setup.php
 * Or access via browser: http://yoursite.com/database/setup.php
 */

// Prevent direct browser access in production
// Uncomment the line below in production
// if (php_sapi_name() !== 'cli') { die('CLI access only'); }

require_once __DIR__ . '/../php/config.php';

echo "===========================================\n";
echo "The Management Gurus - Database Setup\n";
echo "===========================================\n\n";

try {
    // Connect without database first
    $dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✓ Connected to MySQL server\n";
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` 
                CHARACTER SET utf8mb4 
                COLLATE utf8mb4_unicode_ci");
    echo "✓ Database '" . DB_NAME . "' created/verified\n";
    
    // Select database
    $pdo->exec("USE `" . DB_NAME . "`");
    echo "✓ Selected database\n\n";
    
    // Create inquiries table
    echo "Creating tables...\n";
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS inquiries (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            message TEXT,
            submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ip_address VARCHAR(45),
            user_agent VARCHAR(500),
            source_page VARCHAR(255) DEFAULT 'landing_page',
            status ENUM('new', 'contacted', 'follow_up', 'converted', 'closed', 'spam') DEFAULT 'new',
            assigned_to VARCHAR(100),
            notes TEXT,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            contacted_at TIMESTAMP NULL,
            INDEX idx_email (email),
            INDEX idx_phone (phone),
            INDEX idx_status (status),
            INDEX idx_submitted_at (submitted_at),
            INDEX idx_ip_address (ip_address)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "  ✓ inquiries table created\n";
    
    // Create subscribers table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS subscribers (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(150) NOT NULL UNIQUE,
            full_name VARCHAR(100),
            subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            is_active BOOLEAN DEFAULT TRUE,
            unsubscribed_at TIMESTAMP NULL,
            source VARCHAR(50) DEFAULT 'website',
            INDEX idx_email (email),
            INDEX idx_is_active (is_active)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "  ✓ subscribers table created\n";
    
    // Create rate_limits table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS rate_limits (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ip_address VARCHAR(45) NOT NULL,
            action_type VARCHAR(50) DEFAULT 'form_submit',
            attempt_count INT UNSIGNED DEFAULT 1,
            first_attempt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_attempt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_ip_action (ip_address, action_type),
            INDEX idx_ip_address (ip_address),
            INDEX idx_last_attempt (last_attempt)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "  ✓ rate_limits table created\n";
    
    // Create contact_logs table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contact_logs (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            inquiry_id INT UNSIGNED NOT NULL,
            contact_type ENUM('email', 'phone', 'whatsapp', 'meeting', 'other') NOT NULL,
            contact_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            contacted_by VARCHAR(100),
            notes TEXT,
            outcome ENUM('no_answer', 'callback_requested', 'interested', 'not_interested', 'converted') DEFAULT 'no_answer',
            INDEX idx_inquiry_id (inquiry_id),
            INDEX idx_contact_date (contact_date)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "  ✓ contact_logs table created\n";
    
    echo "\n===========================================\n";
    echo "✓ Database setup completed successfully!\n";
    echo "===========================================\n\n";
    
    echo "Next steps:\n";
    echo "1. Update php/config.php with your database credentials\n";
    echo "2. Test the form submission on your website\n";
    echo "3. Delete this setup.php file for security\n\n";
    
} catch (PDOException $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n";
    echo "\nPlease check:\n";
    echo "1. MySQL server is running\n";
    echo "2. Database credentials in php/config.php are correct\n";
    echo "3. User has CREATE DATABASE privileges\n";
    exit(1);
}
