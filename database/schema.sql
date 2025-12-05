-- ========================================
-- The Management Gurus - Database Schema
-- ========================================
-- Run this SQL file to create the database and tables
-- MySQL 5.7+ / MariaDB 10.2+

-- Create Database (if needed)
CREATE DATABASE IF NOT EXISTS u112004868_gurus
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE u112004868_gurus;

-- ========================================
-- INQUIRIES TABLE (ESSENTIAL)
-- Stores all form submissions from the website
-- ========================================
CREATE TABLE IF NOT EXISTS inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Contact Information
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    message TEXT,
    
    -- Metadata
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    
    -- Status Tracking
    status ENUM('new', 'contacted', 'follow_up', 'converted', 'closed', 'spam') DEFAULT 'new',
    
    -- Indexes for faster queries
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_submitted_at (submitted_at),
    INDEX idx_ip_address (ip_address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================
-- OPTIONAL TABLES (for future features)
-- ========================================

-- COLLEGES TABLE
-- Partner colleges/institutions
CREATE TABLE IF NOT EXISTS colleges (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(100),
    ranking INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_name (name),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default colleges (fixed - removed short_name column)
INSERT INTO colleges (name, location, ranking) VALUES
('IIM Ahmedabad', 'Ahmedabad, Gujarat', 1),
('IIM Bangalore', 'Bangalore, Karnataka', 2),
('IIM Calcutta', 'Kolkata, West Bengal', 3),
('XLRI Jamshedpur', 'Jamshedpur, Jharkhand', 4),
('ISB Hyderabad', 'Hyderabad, Telangana', 5),
('FMS Delhi', 'New Delhi', 6),
('SP Jain Mumbai', 'Mumbai, Maharashtra', 7),
('MDI Gurgaon', 'Gurgaon, Haryana', 8);


-- TESTIMONIALS TABLE
-- Student testimonials
CREATE TABLE IF NOT EXISTS testimonials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    college_name VARCHAR(150),
    company_placed VARCHAR(150),
    testimonial_text TEXT NOT NULL,
    rating TINYINT UNSIGNED DEFAULT 5,
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_is_featured (is_featured),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default testimonials
INSERT INTO testimonials (student_name, college_name, company_placed, testimonial_text, rating, is_featured) VALUES
('Rahul Sharma', 'IIM Ahmedabad', 'McKinsey', 'The Management Gurus completely transformed my interview skills. The mock interviews were incredibly realistic, and the feedback helped me land my dream job at a top consulting firm.', 5, TRUE),
('Priya Gupta', 'XLRI Jamshedpur', 'Amazon', 'From internship guidance to final placement, they were with me every step. The personalized attention and industry insights made all the difference in my career journey.', 5, TRUE),
('Amit Kumar', 'ISB Hyderabad', 'Google', 'The structured approach to interview preparation was exactly what I needed. The mentors understood the industry requirements and prepared me accordingly. Highly recommended!', 5, TRUE);


-- ========================================
-- SUCCESS MESSAGE
-- ========================================
SELECT 'Database schema created successfully! Your form is ready to use.' AS message;
