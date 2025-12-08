-- ============================================
-- TMG (The Management Gurus) - Complete Database Schema
-- Single consolidated file for shared hosting
-- No USE database statements - run this in your selected database
-- ============================================

-- ============================================
-- 1. CORE TABLES
-- ============================================

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    father_name VARCHAR(255),
    father_phone VARCHAR(20),
    location VARCHAR(255) NOT NULL,
    current_education VARCHAR(255),
    resume_path VARCHAR(500),
    email_notifications BOOLEAN DEFAULT TRUE,
    sms_notifications BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    INDEX idx_email (email),
    INDEX idx_phone (phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    role ENUM('super_admin', 'admin', 'moderator') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 2. SCHOLARSHIP QUIZ SYSTEM
-- ============================================

-- Quiz Questions Table
CREATE TABLE IF NOT EXISTS quiz_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option_a VARCHAR(500) NOT NULL,
    option_b VARCHAR(500) NOT NULL,
    option_c VARCHAR(500) NOT NULL,
    option_d VARCHAR(500) NOT NULL,
    correct_answer ENUM('A', 'B', 'C', 'D') NOT NULL,
    cat_year INT NOT NULL,
    difficulty ENUM('Easy', 'Medium', 'Hard') DEFAULT 'Medium',
    topic VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cat_year (cat_year),
    INDEX idx_difficulty (difficulty),
    INDEX idx_topic (topic)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Quiz Attempts Table
CREATE TABLE IF NOT EXISTS quiz_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_time TIMESTAMP NULL,
    score INT DEFAULT 0,
    total_questions INT DEFAULT 20,
    time_taken INT,
    status ENUM('in_progress', 'completed', 'abandoned') DEFAULT 'in_progress',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Quiz Answers Table
CREATE TABLE IF NOT EXISTS quiz_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    question_id INT NOT NULL,
    user_answer ENUM('A', 'B', 'C', 'D'),
    is_correct BOOLEAN,
    time_spent INT,
    FOREIGN KEY (attempt_id) REFERENCES quiz_attempts(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES quiz_questions(id) ON DELETE CASCADE,
    INDEX idx_attempt_id (attempt_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 3. LUCKY DRAW SYSTEM
-- ============================================

-- Lucky Draw Quiz Questions Table
CREATE TABLE IF NOT EXISTS lucky_draw_quiz_questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_answer ENUM('A', 'B', 'C', 'D') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Lucky Draw Quiz Attempts Table
CREATE TABLE IF NOT EXISTS lucky_draw_quiz_attempts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    score INT NOT NULL,
    total_questions INT DEFAULT 5,
    passed BOOLEAN DEFAULT FALSE,
    attempt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_passed (passed)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Lucky Draw Entries Table
CREATE TABLE IF NOT EXISTS lucky_draw_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    week_number INT NOT NULL,
    year INT NOT NULL,
    entry_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_winner BOOLEAN DEFAULT FALSE,
    prize_claimed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_week (user_id, week_number, year),
    INDEX idx_week (week_number, year),
    INDEX idx_winner (is_winner)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 4. SERVICE BOOKING SYSTEM
-- ============================================

-- Service Bookings Table
CREATE TABLE IF NOT EXISTS service_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_type ENUM('mock_interview', 'career_counselling', 'placement_support') NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    preferred_date DATE,
    preferred_time TIME,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 5. EMAIL & COMMUNICATION SYSTEM
-- ============================================

-- Contact Form Submissions Table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(100),
    father_name VARCHAR(100),
    father_phone VARCHAR(20),
    query TEXT NOT NULL,
    status ENUM('new', 'contacted', 'resolved') DEFAULT 'new',
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_submitted (submitted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Email Logs Table
CREATE TABLE IF NOT EXISTS email_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipient_email VARCHAR(100) NOT NULL,
    recipient_name VARCHAR(100),
    subject VARCHAR(255) NOT NULL,
    email_type ENUM('welcome', 'quiz_result', 'lucky_draw', 'booking', 'contact', 'other') NOT NULL,
    status ENUM('sent', 'failed', 'pending') DEFAULT 'pending',
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    error_message TEXT,
    INDEX idx_recipient (recipient_email),
    INDEX idx_type (email_type),
    INDEX idx_status (status),
    INDEX idx_sent (sent_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Notifications Table
CREATE TABLE IF NOT EXISTS notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'error') DEFAULT 'info',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_read (is_read),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Email Templates Table
CREATE TABLE IF NOT EXISTS email_templates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    template_name VARCHAR(100) UNIQUE NOT NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    variables TEXT COMMENT 'JSON array of available variables',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_name (template_name),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- 6. INSERT DEFAULT DATA
-- ============================================

-- Insert default admin (password: password - CHANGE THIS!)
INSERT INTO admin_users (username, password, email, role) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@tmg.com', 'super_admin')
ON DUPLICATE KEY UPDATE username=username;

-- Insert default email templates
INSERT INTO email_templates (template_name, subject, body, variables) VALUES
('welcome', 'Welcome to The Management Gurus!', 
'<h2>Welcome, {{name}}!</h2><p>Thank you for registering with The Management Gurus.</p>', 
'["name", "email"]'),
('quiz_result', 'Your Scholarship Quiz Results',
'<h2>Quiz Results</h2><p>Score: {{score}}/{{total}} ({{percentage}}%)</p>',
'["name", "score", "total", "percentage"]'),
('lucky_draw_entry', 'Lucky Draw Entry Confirmed',
'<h2>Entry Confirmed!</h2><p>Entry Number: {{entry_number}}</p><p>Week: {{week_number}}</p>',
'["name", "entry_number", "week_number"]'),
('booking_confirmation', 'Service Booking Confirmed',
'<h2>Booking Confirmed!</h2><p>Service: {{service_type}}</p><p>Date: {{date}}</p><p>Time: {{time}}</p>',
'["name", "service_type", "date", "time"]')
ON DUPLICATE KEY UPDATE template_name=template_name;

-- Insert 5 TMG Brand Story Questions for Lucky Draw
INSERT INTO lucky_draw_quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, is_active) VALUES
('What is the core belief on which TMG was built?', 
 'Great leaders are born with talent', 
 'Great leaders are shaped, guided, and empowered', 
 'Great leaders need only education', 
 'Great leaders are self-made',
 'B', TRUE),
('What does "T" in TMG represent?',
 'Training', 
 'The Foundation - boldness, firmness, and permanence', 
 'Technology', 
 'Talent',
 'B', TRUE),
('What does "M" in TMG symbolize?',
 'Money and success', 
 'Marketing strategies', 
 'Management - future students and managers', 
 'Mentorship only',
 'C', TRUE),
('What does "G" in TMG stand for?',
 'Growth', 
 'Guidance', 
 'Gurus - top performers whose success stories inspire others', 
 'Goals',
 'C', TRUE),
('What is TMG\'s promise?',
 'To provide only education', 
 'To transform knowledge into action and action into success', 
 'To guarantee job placements', 
 'To offer the cheapest courses',
 'B', TRUE)
ON DUPLICATE KEY UPDATE question_text=question_text;

-- ============================================
-- 7. SAMPLE CAT QUESTIONS (2019-2023)
-- ============================================

-- Quantitative Aptitude Questions
INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, cat_year, difficulty, topic) VALUES
('If log₂(x) + log₂(y) = 5 and log₂(x) - log₂(y) = 1, what is the value of xy?', '32', '64', '128', '256', 'A', 2023, 'Medium', 'Quantitative'),
('In a class of 60 students, 30 play cricket, 25 play football, and 10 play both. How many play neither?', '5', '10', '15', '20', 'C', 2023, 'Easy', 'Quantitative'),
('The ratio of ages of A and B is 3:4. After 5 years, the ratio becomes 4:5. What is A''s current age?', '15', '20', '25', '30', 'A', 2022, 'Medium', 'Quantitative'),
('If a train travels 360 km in 4 hours, what is its speed in m/s?', '20', '25', '30', '35', 'B', 2022, 'Easy', 'Quantitative'),
('The average of 5 numbers is 27. If one number is excluded, the average becomes 25. What is the excluded number?', '32', '35', '37', '40', 'B', 2021, 'Medium', 'Quantitative'),
('A shopkeeper marks his goods 40% above cost price and gives a discount of 20%. What is his profit percentage?', '10%', '12%', '15%', '20%', 'B', 2021, 'Medium', 'Quantitative'),
('If 2x + 3y = 12 and 3x + 2y = 13, what is x + y?', '4', '5', '6', '7', 'B', 2020, 'Easy', 'Quantitative'),
('The compound interest on Rs. 10,000 at 10% per annum for 2 years is:', 'Rs. 2000', 'Rs. 2100', 'Rs. 2200', 'Rs. 2500', 'B', 2020, 'Medium', 'Quantitative'),
('In how many ways can 5 people be seated in a row?', '60', '100', '120', '150', 'C', 2019, 'Easy', 'Quantitative'),
('If the sum of first n natural numbers is 210, what is n?', '18', '19', '20', '21', 'C', 2019, 'Medium', 'Quantitative'),
('A can complete a work in 12 days and B in 18 days. In how many days can they complete it together?', '6.5 days', '7.2 days', '8 days', '9 days', 'B', 2023, 'Medium', 'Quantitative'),
('The HCF of two numbers is 12 and their LCM is 180. If one number is 36, find the other.', '48', '60', '72', '84', 'B', 2022, 'Medium', 'Quantitative'),
('A sum of money doubles itself in 8 years at simple interest. In how many years will it triple?', '12', '14', '16', '18', 'C', 2021, 'Medium', 'Quantitative'),
('The area of a circle is 154 sq cm. What is its circumference?', '38 cm', '44 cm', '48 cm', '52 cm', 'B', 2020, 'Easy', 'Quantitative'),
('If 40% of a number is 80, what is 60% of that number?', '100', '120', '140', '160', 'B', 2019, 'Easy', 'Quantitative'),
('The average of 10 numbers is 40. If 5 is added to each number, what is the new average?', '40', '42', '45', '50', 'C', 2023, 'Easy', 'Quantitative'),
('A man buys an article for Rs. 80 and sells it for Rs. 100. What is his profit percentage?', '20%', '25%', '30%', '35%', 'B', 2022, 'Easy', 'Quantitative'),
('If x:y = 2:3 and y:z = 4:5, what is x:z?', '8:15', '2:5', '3:5', '4:5', 'A', 2021, 'Medium', 'Quantitative'),
('The sum of three consecutive odd numbers is 63. What is the largest number?', '19', '21', '23', '25', 'C', 2020, 'Easy', 'Quantitative'),
('A train 100m long passes a pole in 10 seconds. What is its speed in km/h?', '30', '36', '40', '45', 'B', 2019, 'Medium', 'Quantitative')
ON DUPLICATE KEY UPDATE question_text=question_text;

-- ============================================
-- INSTALLATION COMPLETE
-- ============================================
-- All tables and default data have been created.
-- Next steps:
-- 1. Change the default admin password immediately
-- 2. Configure email settings in php/email_config.php
-- 3. Test the system with sample data
-- ============================================
