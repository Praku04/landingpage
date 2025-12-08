<?php
// Email Configuration for TMG

// SMTP Configuration (recommended for production)
define('SMTP_ENABLED', false); // Set to true to use SMTP
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_ENCRYPTION', 'tls'); // tls or ssl

// Email Settings
define('FROM_EMAIL', 'noreply@tmg.com');
define('FROM_NAME', 'The Management Gurus');
define('ADMIN_EMAIL', 'admin@tmg.com');
define('SUPPORT_EMAIL', 'support@tmg.com');

/**
 * Send email using PHP mail() or SMTP
 */
function sendEmail($to, $subject, $message, $headers = []) {
    if (SMTP_ENABLED) {
        return sendSMTPEmail($to, $subject, $message, $headers);
    } else {
        return sendPHPMail($to, $subject, $message, $headers);
    }
}

/**
 * Send email using PHP mail()
 */
function sendPHPMail($to, $subject, $message, $customHeaders = []) {
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: ' . FROM_NAME . ' <' . FROM_EMAIL . '>',
        'Reply-To: ' . FROM_EMAIL,
        'X-Mailer: PHP/' . phpversion()
    ];
    
    $headers = array_merge($headers, $customHeaders);
    $headerString = implode("\r\n", $headers);
    
    return mail($to, $subject, $message, $headerString);
}

/**
 * Send email using SMTP (requires PHPMailer or similar)
 */
function sendSMTPEmail($to, $subject, $message, $headers = []) {
    // This requires PHPMailer library
    // Install via: composer require phpmailer/phpmailer
    
    // For now, fallback to PHP mail
    return sendPHPMail($to, $subject, $message, $headers);
}

/**
 * Email Templates
 */
function getEmailTemplate($content, $title = '') {
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { background: #f9fafb; padding: 30px; }
            .footer { background: #1e293b; color: white; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; font-size: 14px; }
            .button { display: inline-block; padding: 12px 30px; background: #1e40af; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
            .info-box { background: white; padding: 20px; border-left: 4px solid #1e40af; margin: 20px 0; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>The Management Gurus</h1>
                ' . ($title ? '<p>' . $title . '</p>' : '') . '
            </div>
            <div class="content">
                ' . $content . '
            </div>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' The Management Gurus. All rights reserved.</p>
                <p>Your Career Partner</p>
            </div>
        </div>
    </body>
    </html>
    ';
}

/**
 * Send welcome email to new user
 */
function sendWelcomeEmail($userEmail, $userName) {
    $subject = 'Welcome to The Management Gurus!';
    $content = '
        <h2>Welcome, ' . htmlspecialchars($userName) . '!</h2>
        <p>Thank you for registering with The Management Gurus. We\'re excited to help you build your career!</p>
        
        <div class="info-box">
            <h3>What\'s Next?</h3>
            <ul>
                <li>Complete your profile</li>
                <li>Take the Scholarship Quiz</li>
                <li>Enter the Weekly Lucky Draw</li>
                <li>Book Career Counselling Sessions</li>
            </ul>
        </div>
        
        <a href="' . getBaseUrl() . '/dashboard/" class="button">Go to Dashboard</a>
        
        <p>If you have any questions, feel free to contact us at ' . SUPPORT_EMAIL . '</p>
    ';
    
    $message = getEmailTemplate($content, 'Welcome to TMG!');
    return sendEmail($userEmail, $subject, $message);
}

/**
 * Send quiz result email
 */
function sendQuizResultEmail($userEmail, $userName, $score, $totalQuestions, $percentage) {
    $subject = 'Your Scholarship Quiz Results';
    $passed = $percentage >= 60;
    
    $content = '
        <h2>Quiz Results for ' . htmlspecialchars($userName) . '</h2>
        <p>You have completed the TMG Scholarship Quiz. Here are your results:</p>
        
        <div class="info-box">
            <h3>Your Score</h3>
            <p style="font-size: 24px; color: #1e40af; font-weight: bold;">' . $score . ' / ' . $totalQuestions . ' (' . $percentage . '%)</p>
            <p style="font-size: 18px; color: ' . ($passed ? '#10b981' : '#ef4444') . ';">
                ' . ($passed ? '✓ Congratulations! You passed!' : '✗ Keep practicing!') . '
            </p>
        </div>
        
        ' . ($passed ? '
        <p>Great job! Our team will review your application and contact you soon regarding scholarship opportunities.</p>
        ' : '
        <p>Don\'t worry! You can improve your skills and try again in the future. We recommend:</p>
        <ul>
            <li>Review CAT preparation materials</li>
            <li>Practice more sample questions</li>
            <li>Book a counselling session for guidance</li>
        </ul>
        ') . '
        
        <a href="' . getBaseUrl() . '/dashboard/" class="button">View Dashboard</a>
    ';
    
    $message = getEmailTemplate($content, 'Quiz Results');
    return sendEmail($userEmail, $subject, $message);
}

/**
 * Send lucky draw entry confirmation
 */
function sendLuckyDrawConfirmation($userEmail, $userName, $entryNumber, $weekNumber) {
    $subject = 'Lucky Draw Entry Confirmed - Entry #' . $entryNumber;
    
    $content = '
        <h2>Lucky Draw Entry Confirmed!</h2>
        <p>Dear ' . htmlspecialchars($userName) . ',</p>
        <p>Your entry for the TMG Weekly Lucky Draw has been confirmed!</p>
        
        <div class="info-box">
            <h3>Entry Details</h3>
            <p><strong>Entry Number:</strong> ' . $entryNumber . '</p>
            <p><strong>Week:</strong> ' . $weekNumber . '</p>
            <p><strong>Date:</strong> ' . date('F d, Y') . '</p>
        </div>
        
        <h3>What You Can Win:</h3>
        <ul>
            <li>TMG expert counselling at best discounted rates</li>
            <li>College fee discounts for MBA programs in Top 5 TMG colleges</li>
            <li>Internship opportunities in top 10 TMG listed companies</li>
        </ul>
        
        <p>Winners will be announced via email and phone. Good luck!</p>
        
        <a href="' . getBaseUrl() . '/dashboard/lucky-draw.php" class="button">Check Status</a>
    ';
    
    $message = getEmailTemplate($content, 'Lucky Draw Entry');
    return sendEmail($userEmail, $subject, $message);
}

/**
 * Send booking confirmation email
 */
function sendBookingConfirmation($userEmail, $userName, $serviceType, $date, $time) {
    $subject = 'Service Booking Confirmed - ' . $serviceType;
    
    $content = '
        <h2>Booking Confirmed!</h2>
        <p>Dear ' . htmlspecialchars($userName) . ',</p>
        <p>Your booking for <strong>' . htmlspecialchars($serviceType) . '</strong> has been confirmed.</p>
        
        <div class="info-box">
            <h3>Booking Details</h3>
            <p><strong>Service:</strong> ' . htmlspecialchars($serviceType) . '</p>
            <p><strong>Date:</strong> ' . date('F d, Y', strtotime($date)) . '</p>
            <p><strong>Time:</strong> ' . htmlspecialchars($time) . '</p>
            <p><strong>Status:</strong> Pending Confirmation</p>
        </div>
        
        <p>Our team will contact you shortly to confirm the final details.</p>
        
        <a href="' . getBaseUrl() . '/dashboard/services.php" class="button">View Bookings</a>
    ';
    
    $message = getEmailTemplate($content, 'Booking Confirmation');
    return sendEmail($userEmail, $subject, $message);
}

/**
 * Send contact form submission to admin
 */
function sendContactFormToAdmin($name, $email, $phone, $location, $fatherName, $fatherPhone, $query) {
    $subject = 'New Contact Form Submission - ' . $name;
    
    $content = '
        <h2>New Contact Form Submission</h2>
        
        <div class="info-box">
            <h3>Contact Details</h3>
            <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
            <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>
            <p><strong>Location:</strong> ' . htmlspecialchars($location) . '</p>
            <p><strong>Father\'s Name:</strong> ' . htmlspecialchars($fatherName) . '</p>
            <p><strong>Father\'s Phone:</strong> ' . htmlspecialchars($fatherPhone) . '</p>
        </div>
        
        <div class="info-box">
            <h3>Query/Description</h3>
            <p>' . nl2br(htmlspecialchars($query)) . '</p>
        </div>
        
        <p><strong>Submitted:</strong> ' . date('F d, Y H:i:s') . '</p>
    ';
    
    $message = getEmailTemplate($content, 'New Contact Form');
    return sendEmail(ADMIN_EMAIL, $subject, $message);
}

/**
 * Get base URL
 */
function getBaseUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = dirname($_SERVER['SCRIPT_NAME']);
    return $protocol . '://' . $host . $script;
}
?>
