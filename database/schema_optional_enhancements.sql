-- ========================================
-- OPTIONAL SCHEMA ENHANCEMENTS
-- The Management Gurus - Future Features
-- ========================================
-- Only run these if you want to make content dynamic/manageable from admin panel

USE u112004868_gurus;

-- ========================================
-- SERVICES TABLE (Optional)
-- Manage services dynamically
-- ========================================
CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    icon_name VARCHAR(50),
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_display_order (display_order),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert current services
INSERT INTO services (title, description, icon_name, display_order) VALUES
('CAT & Competitive Exam Prep', 'Understand the relevance of CAT scores, preparation strategies, and how these exams shape your management career trajectory.', 'book', 1),
('Career Counselling', 'Personalized guidance on college selection, fee structures, career prospects after MBA/PGDM, and choosing the right specialization.', 'users', 2),
('Mock Interview Sessions', 'Industry-standard mock interviews with real-time feedback to build confidence and improve your performance.', 'clock', 3),
('Internship Guidance', 'Navigate internship queries, selection process, and secure opportunities that align with your career goals.', 'briefcase', 4),
('College Selection Support', 'Honest insights about colleges, placement cells reality, fee structures, and making informed decisions about your education.', 'layers', 5),
('AI & Modern Methodologies', 'Stay ahead with insights on AI''s dominance in industries, digital transformation, and contemporary management practices.', 'image', 6);


-- ========================================
-- FAQ TABLE (Optional)
-- Manage FAQs dynamically
-- ========================================
CREATE TABLE IF NOT EXISTS faqs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL,
    category_icon VARCHAR(50),
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_category (category),
    INDEX idx_display_order (display_order),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert current FAQs
INSERT INTO faqs (category, category_icon, question, answer, display_order) VALUES
-- College & Admissions
('College & Admissions', '🎓', 'How do I choose the right management college?', 'Consider factors like placement records, faculty expertise, industry connections, specializations offered, fee structure vs ROI, location, and alumni network. We provide personalized counseling to help you make informed decisions based on your career goals and financial situation.', 1),
('College & Admissions', '🎓', 'What about college fees and ROI?', 'We help you understand the complete fee structure, hidden costs, and expected returns. Our counseling includes realistic salary expectations, loan options, and whether the investment aligns with your career prospects.', 2),
('College & Admissions', '🎓', 'How important are CAT scores really?', 'CAT scores open doors to premier B-schools, but they''re not the only path. We explain the relevance of CAT and other competitive exams (XAT, SNAP, NMAT) and help you strategize based on your target colleges and career goals.', 3),

-- Internships & Career
('Internships & Career', '💼', 'How do I secure a good internship?', 'Start early, build relevant skills, network actively, and prepare thoroughly. We guide you through internship selection, application strategies, and interview preparation to secure opportunities that align with your career path.', 4),
('Internships & Career', '💼', 'What are career prospects after MBA/PGDM?', 'Career prospects vary by specialization, college tier, and individual preparation. We provide realistic insights into different domains (consulting, finance, marketing, operations), salary ranges, growth trajectories, and how to maximize your opportunities.', 5),
('Internships & Career', '💼', 'What''s the reality of college placement cells?', 'Placement cells vary significantly across colleges. We give you honest insights about what to expect, how to leverage placement support, and importantly, how to prepare independently to not rely solely on college placements.', 6),

-- Skills & Preparation
('Skills & Preparation', '🚀', 'How is AI impacting management careers?', 'AI is transforming every industry - from automation to data-driven decision making. We help you understand which skills remain valuable, how to adapt, and how to leverage AI tools in your management career rather than being replaced by them.', 7),
('Skills & Preparation', '🚀', 'What modern management methodologies should I know?', 'Agile, Design Thinking, Lean Six Sigma, OKRs, Data Analytics, Digital Marketing, and Change Management are crucial. We provide awareness and training on contemporary practices that employers actually value.', 8),
('Skills & Preparation', '🚀', 'How do mock interviews help?', 'Mock interviews build confidence, expose weaknesses, and provide real-time feedback. Our sessions simulate actual company interviews, helping you refine your communication, handle pressure, and present yourself effectively.', 9);


-- ========================================
-- RESOURCES/CONTENT TABLE (Optional)
-- Manage podcasts, blogs, videos
-- ========================================
CREATE TABLE IF NOT EXISTS resources (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type ENUM('podcast', 'blog', 'video', 'guide') NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    content_url VARCHAR(500),
    thumbnail_url VARCHAR(500),
    tags VARCHAR(500), -- Comma-separated tags
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_type (type),
    INDEX idx_is_featured (is_featured),
    INDEX idx_is_active (is_active),
    INDEX idx_published_at (published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert placeholder for podcast series
INSERT INTO resources (type, title, description, tags, is_featured) VALUES
('podcast', 'Roadmap to High LPA Packages', 'Join us as we break down the journey from management student to landing 6, 8, 10+ LPA packages. Real stories, practical strategies, and insider insights from industry experts and successful alumni.', 'Career Planning,Interview Strategies,Salary Negotiation,Industry Insights', TRUE);


-- ========================================
-- INQUIRY TYPES TABLE (Optional)
-- Track which service/section inquiry came from
-- ========================================
CREATE TABLE IF NOT EXISTS inquiry_types (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    
    INDEX idx_type_name (type_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert inquiry types
INSERT INTO inquiry_types (type_name, description) VALUES
('General Inquiry', 'General questions and information requests'),
('CAT Preparation', 'CAT and competitive exam preparation inquiries'),
('Career Counselling', 'Career guidance and counselling requests'),
('Mock Interview', 'Mock interview session bookings'),
('Internship Guidance', 'Internship-related queries'),
('College Selection', 'College selection and admission guidance'),
('Podcast Subscription', 'Podcast series subscription requests'),
('Partnership', 'College/company partnership inquiries');

-- Add inquiry_type_id to inquiries table
ALTER TABLE inquiries 
ADD COLUMN inquiry_type_id INT UNSIGNED NULL AFTER message,
ADD FOREIGN KEY (inquiry_type_id) REFERENCES inquiry_types(id) ON DELETE SET NULL;


-- ========================================
-- NEWSLETTER SUBSCRIBERS (Optional)
-- For podcast/resource updates
-- ========================================
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    full_name VARCHAR(100),
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    unsubscribed_at TIMESTAMP NULL,
    
    INDEX idx_email (email),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================
-- SUCCESS MESSAGE
-- ========================================
SELECT 'Optional schema enhancements created successfully!' AS message;
SELECT 'These tables are for future dynamic content management.' AS note;
