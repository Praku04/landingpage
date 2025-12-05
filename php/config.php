<?php
/**
 * ========================================
 * Database Configuration - The Management Gurus
 * ========================================
 * 
 * SETUP INSTRUCTIONS:
 * 1. Update the database credentials below
 * 2. Run: php database/setup.php (or access via browser)
 * 3. Or manually import: database/schema.sql
 * 
 * For production, ensure:
 * - Use strong passwords
 * - Restrict database user permissions
 * - Set display_errors to 0
 */

// ========================================
// DATABASE SETTINGS
// ========================================
define('DB_HOST', 'localhost');          // Database host (usually localhost)
define('DB_NAME', 'management_gurus');   // Database name
define('DB_USER', 'root');               // Database username
define('DB_PASS', '');                   // Database password
define('DB_CHARSET', 'utf8mb4');         // Character set

// ========================================
// EMAIL SETTINGS
// ========================================
define('ADMIN_EMAIL', 'info@themanagementgurus.com');  // Receives form submissions
define('SITE_NAME', 'The Management Gurus');
define('FROM_EMAIL', 'noreply@themanagementgurus.com');
define('FROM_NAME', 'The Management Gurus');

// ========================================
// SECURITY SETTINGS
// ========================================
define('RATE_LIMIT', 5);                 // Max submissions per IP per hour
define('RATE_LIMIT_WINDOW', 3600);       // Rate limit window in seconds (1 hour)

// ========================================
// ENVIRONMENT SETTINGS
// ========================================
// Set to 'production' in live environment
define('ENVIRONMENT', 'development');

// Error reporting based on environment
if (ENVIRONMENT === 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../logs/error.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// ========================================
// OPTIONAL: SMTP SETTINGS (for better email delivery)
// ========================================
// Uncomment and configure if using SMTP
/*
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-app-password');
define('SMTP_SECURE', 'tls');
*/

// ========================================
// TIMEZONE
// ========================================
date_default_timezone_set('Asia/Kolkata');
