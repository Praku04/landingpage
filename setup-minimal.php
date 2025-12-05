<?php
/**
 * Minimal Database Setup
 * Creates only the essential inquiries table needed for the form
 */

require_once 'php/config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Setup - The Management Gurus</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: #10b981; background: #d1fae5; padding: 15px; border-radius: 8px; margin: 10px 0; }
        .error { color: #ef4444; background: #fee2e2; padding: 15px; border-radius: 8px; margin: 10px 0; }
        .info { color: #0891b2; background: #cffafe; padding: 15px; border-radius: 8px; margin: 10px 0; }
        pre { background: #f3f4f6; padding: 15px; border-radius: 8px; overflow-x: auto; }
        h1 { color: #1e40af; }
    </style>
</head>
<body>
    <h1>🚀 Database Setup</h1>";

try {
    // Connect to MySQL server
    $dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<div class='success'>✓ Connected to MySQL server</div>";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    $dbExists = $stmt->fetch();
    
    if (!$dbExists) {
        echo "<div class='info'>Creating database: " . DB_NAME . "</div>";
        $pdo->exec("CREATE DATABASE `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "<div class='success'>✓ Database created</div>";
    } else {
        echo "<div class='success'>✓ Database exists: " . DB_NAME . "</div>";
    }
    
    // Connect to the database
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<div class='success'>✓ Connected to database</div>";
    
    // Create inquiries table
    echo "<div class='info'>Creating inquiries table...</div>";
    
    $sql = "CREATE TABLE IF NOT EXISTS inquiries (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    
    echo "<div class='success'>✓ Inquiries table created successfully</div>";
    
    // Verify table structure
    $stmt = $pdo->query("DESCRIBE inquiries");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<div class='info'><strong>Table Structure:</strong></div>";
    echo "<pre>";
    foreach ($columns as $column) {
        echo $column['Field'] . " - " . $column['Type'] . "\n";
    }
    echo "</pre>";
    
    echo "<div class='success'>
        <h2>✅ Setup Complete!</h2>
        <p>Your database is ready to receive form submissions.</p>
        <p><strong>Next steps:</strong></p>
        <ol>
            <li>Delete this file (setup-minimal.php) for security</li>
            <li>Delete test-db-connection.php for security</li>
            <li>Test your form by clicking 'Enquire Now' on your website</li>
        </ol>
    </div>";
    
} catch (PDOException $e) {
    echo "<div class='error'>
        <h2>❌ Setup Failed</h2>
        <p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
        <p><strong>Solutions:</strong></p>
        <ul>
            <li>Check your database credentials in php/config.php</li>
            <li>Make sure your database user has CREATE TABLE permission</li>
            <li>Contact your hosting provider if the issue persists</li>
        </ul>
    </div>";
}

echo "</body></html>";
?>
