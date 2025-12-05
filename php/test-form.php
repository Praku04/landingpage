<?php
/**
 * Form Test Script - The Management Gurus
 * Use this to test if your form submission is working
 */

// Enable error display for testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Form Submission Test</h2>";

// Test 1: Check if config file exists
echo "<h3>Test 1: Config File</h3>";
if (file_exists(__DIR__ . '/config.php')) {
    echo "✅ config.php exists<br>";
    require_once __DIR__ . '/config.php';
    echo "✅ config.php loaded successfully<br>";
    echo "Database: " . DB_NAME . "<br>";
    echo "Host: " . DB_HOST . "<br>";
} else {
    echo "❌ config.php not found<br>";
}

// Test 2: Check database connection
echo "<h3>Test 2: Database Connection</h3>";
try {
    require_once __DIR__ . '/db-connect.php';
    $db = Database::getInstance();
    $pdo = $db->getConnection();
    echo "✅ Database connection successful<br>";
    
    // Test if inquiries table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'inquiries'");
    if ($stmt->rowCount() > 0) {
        echo "✅ 'inquiries' table exists<br>";
        
        // Check table structure
        $stmt = $pdo->query("DESCRIBE inquiries");
        echo "<strong>Table structure:</strong><br>";
        echo "<pre>";
        while ($row = $stmt->fetch()) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
        echo "</pre>";
    } else {
        echo "❌ 'inquiries' table does not exist<br>";
        echo "Please run the schema.sql file to create the table<br>";
    }
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}

// Test 3: Test form submission
echo "<h3>Test 3: Form Submission</h3>";
echo '<form method="POST" action="submit-inquiry.php" style="max-width: 400px;">
    <div style="margin-bottom: 10px;">
        <label>Full Name:</label><br>
        <input type="text" name="full_name" value="Test User" required style="width: 100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="email" value="test@example.com" required style="width: 100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Phone (10 digits):</label><br>
        <input type="tel" name="phone" value="9876543210" required style="width: 100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Message:</label><br>
        <textarea name="message" style="width: 100%; padding: 8px; height: 80px;">Test message</textarea>
    </div>
    <button type="submit" style="padding: 10px 20px; background: #1e40af; color: white; border: none; cursor: pointer;">
        Submit Test Form
    </button>
</form>';

// Test 4: Check PHP version and extensions
echo "<h3>Test 4: PHP Environment</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "PDO Extension: " . (extension_loaded('pdo') ? '✅ Loaded' : '❌ Not loaded') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Loaded' : '❌ Not loaded') . "<br>";
echo "JSON Extension: " . (extension_loaded('json') ? '✅ Loaded' : '❌ Not loaded') . "<br>";

// Test 5: Check file permissions
echo "<h3>Test 5: File Permissions</h3>";
$files = ['config.php', 'db-connect.php', 'submit-inquiry.php'];
foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "$file: $perms " . (is_readable($path) ? '✅ Readable' : '❌ Not readable') . "<br>";
    } else {
        echo "$file: ❌ Not found<br>";
    }
}

echo "<hr>";
echo "<p><strong>Instructions:</strong></p>";
echo "<ol>";
echo "<li>Check all tests above - they should show ✅</li>";
echo "<li>If database connection fails, check your config.php credentials</li>";
echo "<li>If table doesn't exist, run database/schema.sql</li>";
echo "<li>Try submitting the test form above</li>";
echo "<li>Check browser console (F12) for JavaScript errors</li>";
echo "<li>Check server error logs for PHP errors</li>";
echo "</ol>";
?>
