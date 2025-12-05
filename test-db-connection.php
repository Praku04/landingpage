<?php
/**
 * Database Connection Test
 * This file helps diagnose database connection issues
 */

require_once 'php/config.php';

echo "<h2>Database Connection Test</h2>";
echo "<pre>";

echo "Testing connection with:\n";
echo "Host: " . DB_HOST . "\n";
echo "Database: " . DB_NAME . "\n";
echo "User: " . DB_USER . "\n";
echo "Password: " . str_repeat('*', strlen(DB_PASS)) . "\n\n";

try {
    // Test connection
    $dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Successfully connected to MySQL server!\n\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    $dbExists = $stmt->fetch();
    
    if ($dbExists) {
        echo "✓ Database '" . DB_NAME . "' exists!\n\n";
        
        // Try to connect to the specific database
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "✓ Successfully connected to database '" . DB_NAME . "'!\n\n";
        
        // Check if inquiries table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'inquiries'");
        $tableExists = $stmt->fetch();
        
        if ($tableExists) {
            echo "✓ Table 'inquiries' exists!\n\n";
            
            // Check table structure
            $stmt = $pdo->query("DESCRIBE inquiries");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "Table structure:\n";
            foreach ($columns as $column) {
                echo "  - " . $column['Field'] . " (" . $column['Type'] . ")\n";
            }
            
            echo "\n✅ Everything looks good! Your database is ready to use.\n";
        } else {
            echo "⚠ Table 'inquiries' does not exist.\n";
            echo "You need to run the database setup.\n\n";
            echo "Options:\n";
            echo "1. Run: php database/setup.php\n";
            echo "2. Or import database/schema.sql manually\n";
        }
        
    } else {
        echo "✗ Database '" . DB_NAME . "' does not exist!\n\n";
        echo "Creating database...\n";
        
        try {
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "✓ Database created successfully!\n\n";
            echo "Now you need to import the schema.\n";
            echo "Run: php database/setup.php\n";
        } catch (PDOException $e) {
            echo "✗ Could not create database: " . $e->getMessage() . "\n\n";
            echo "You may need to:\n";
            echo "1. Create the database manually in cPanel/phpMyAdmin\n";
            echo "2. Or ask your hosting provider to create it\n";
            echo "3. Or grant CREATE DATABASE permission to your user\n";
        }
    }
    
} catch (PDOException $e) {
    echo "✗ Connection failed!\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    echo "Common solutions:\n";
    echo "1. Check if MySQL is running\n";
    echo "2. Verify database credentials in php/config.php\n";
    echo "3. Check if user has permission to access the database\n";
    echo "4. Contact your hosting provider if on shared hosting\n";
}

echo "</pre>";
?>
