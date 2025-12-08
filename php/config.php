<?php
// ============================================
// TMG - OPTIMIZED DATABASE CONFIGURATION
// Lightning Fast Performance
// ============================================

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u112004868_tmguserdb');
define('DB_PASS', 'MsfVenom@8080');
define('DB_NAME', 'u112004868_tmg_db');

// Performance Settings
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

// Create optimized connection with persistent connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        die("Service temporarily unavailable. Please try again later.");
    }
    
    // Set charset for security and performance
    $conn->set_charset(DB_CHARSET);
    
    // Performance optimizations
    $conn->query("SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'");
    $conn->query("SET SESSION query_cache_type = ON");
    
    // Connection options for better performance
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
    
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    die("Service temporarily unavailable. Please try again later.");
}

// ============================================
// SESSION CONFIGURATION (Optimized)
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    // Session security and performance settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 when using HTTPS
    ini_set('session.gc_maxlifetime', 3600); // 1 hour
    ini_set('session.cookie_lifetime', 0); // Until browser closes
    
    session_start();
    
    // Regenerate session ID periodically for security
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
}

// ============================================
// HELPER FUNCTIONS (Optimized)
// ============================================

// Sanitize input (XSS protection)
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $conn->real_escape_string($data);
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header('Location: ../auth/login.php');
        exit;
    }
}

// Get current user data (with caching)
function get_current_user() {
    global $conn;
    
    if (!is_logged_in()) {
        return null;
    }
    
    // Check if user data is already cached in session
    if (isset($_SESSION['user_data']) && isset($_SESSION['user_data_time'])) {
        // Cache for 5 minutes
        if (time() - $_SESSION['user_data_time'] < 300) {
            return $_SESSION['user_data'];
        }
    }
    
    // Fetch from database
    $user_id = (int)$_SESSION['user_id'];
    $sql = "SELECT id, name, email, phone, location, current_education, created_at FROM users WHERE id = ? AND is_active = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return null;
    }
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    // Cache user data in session
    if ($user) {
        $_SESSION['user_data'] = $user;
        $_SESSION['user_data_time'] = time();
    }
    
    return $user;
}

// Clear user cache (call after profile update)
function clear_user_cache() {
    unset($_SESSION['user_data']);
    unset($_SESSION['user_data_time']);
}

// ============================================
// OUTPUT COMPRESSION (if not enabled in .htaccess)
// ============================================
if (!ob_get_level() && extension_loaded('zlib')) {
    ob_start('ob_gzhandler');
}
?>
