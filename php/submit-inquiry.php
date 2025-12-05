<?php
/**
 * Form Submission Handler - The Management Gurus
 * Handles inquiry form submissions, validation, database storage, and email
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db-connect.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

/**
 * Sanitize input string
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate form data
 */
function validateFormData($data) {
    $errors = [];

    // Full name validation
    if (empty($data['full_name']) || strlen($data['full_name']) < 2) {
        $errors['full_name'] = 'Please enter a valid name (at least 2 characters)';
    } elseif (strlen($data['full_name']) > 100) {
        $errors['full_name'] = 'Name must be less than 100 characters';
    }

    // Email validation
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    } elseif (strlen($data['email']) > 150) {
        $errors['email'] = 'Email must be less than 150 characters';
    }

    // Phone validation (10-15 digits)
    $phone = preg_replace('/[^0-9]/', '', $data['phone']);
    if (empty($phone) || strlen($phone) < 10 || strlen($phone) > 15) {
        $errors['phone'] = 'Please enter a valid phone number (10-15 digits)';
    }

    // Message validation (optional but max 1000 chars)
    if (!empty($data['message']) && strlen($data['message']) > 1000) {
        $errors['message'] = 'Message must be less than 1000 characters';
    }

    return $errors;
}

/**
 * Get client IP address
 */
function getClientIP() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($ipKeys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = $_SERVER[$key];
            // Handle comma-separated IPs (for proxies)
            if (strpos($ip, ',') !== false) {
                $ip = trim(explode(',', $ip)[0]);
            }
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    
    return 'unknown';
}

/**
 * Check rate limiting
 */
function checkRateLimit($pdo, $ip) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM inquiries 
        WHERE ip_address = ? 
        AND submitted_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)
    ");
    $stmt->execute([$ip]);
    $result = $stmt->fetch();
    
    return $result['count'] < RATE_LIMIT;
}

/**
 * Save inquiry to database
 */
function saveInquiry($pdo, $data, $ip) {
    $stmt = $pdo->prepare("
        INSERT INTO inquiries (full_name, email, phone, message, ip_address) 
        VALUES (?, ?, ?, ?, ?)
    ");
    
    return $stmt->execute([
        $data['full_name'],
        $data['email'],
        preg_replace('/[^0-9]/', '', $data['phone']),
        $data['message'] ?? null,
        $ip
    ]);
}

/**
 * Send email notification
 */
function sendEmailNotification($data) {
    $to = ADMIN_EMAIL;
    $subject = "New Inquiry from " . SITE_NAME;
    
    $message = "New inquiry received:\n\n";
    $message .= "Name: " . $data['full_name'] . "\n";
    $message .= "Email: " . $data['email'] . "\n";
    $message .= "Phone: " . $data['phone'] . "\n";
    $message .= "Message: " . ($data['message'] ?? 'No message provided') . "\n";
    $message .= "\nSubmitted at: " . date('Y-m-d H:i:s') . "\n";
    
    $headers = [
        'From: noreply@themanagementgurus.com',
        'Reply-To: ' . $data['email'],
        'X-Mailer: PHP/' . phpversion(),
        'Content-Type: text/plain; charset=UTF-8'
    ];
    
    // Attempt to send email (don't fail if email fails)
    try {
        return mail($to, $subject, $message, implode("\r\n", $headers));
    } catch (Exception $e) {
        error_log("Email send failed: " . $e->getMessage());
        return false;
    }
}

// Main execution
try {
    // Get and sanitize form data
    $formData = [
        'full_name' => sanitizeInput($_POST['full_name'] ?? ''),
        'email' => sanitizeInput($_POST['email'] ?? ''),
        'phone' => sanitizeInput($_POST['phone'] ?? ''),
        'message' => sanitizeInput($_POST['message'] ?? '')
    ];

    // Validate form data
    $errors = validateFormData($formData);
    
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit;
    }

    // Get database connection
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    // Get client IP
    $clientIP = getClientIP();

    // Check rate limiting
    if (!checkRateLimit($pdo, $clientIP)) {
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Too many requests. Please try again later.'
        ]);
        exit;
    }

    // Save to database
    if (!saveInquiry($pdo, $formData, $clientIP)) {
        throw new Exception('Failed to save inquiry');
    }

    // Send email notification (async-like, don't wait for result)
    sendEmailNotification($formData);

    // Success response
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your inquiry. We will contact you soon!'
    ]);

} catch (Exception $e) {
    error_log("Inquiry submission error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Something went wrong. Please try again later.'
    ]);
}
