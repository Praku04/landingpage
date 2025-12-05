-- ========================================
-- Quick Fix for The Management Gurus Database
-- ========================================
-- Run this file to create only the essential table

USE u112004868_gurus;

-- Drop existing inquiries table if it exists (to start fresh)
DROP TABLE IF EXISTS inquiries;

-- Create inquiries table (ESSENTIAL - this is what the form needs)
CREATE TABLE inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    status ENUM('new', 'contacted', 'follow_up', 'converted', 'closed', 'spam') DEFAULT 'new',
    
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_submitted_at (submitted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Test insert to verify it works
-- DELETE FROM inquiries WHERE email = 'test@example.com';

SELECT 'Database setup complete! Your form is ready to use.' AS message;
