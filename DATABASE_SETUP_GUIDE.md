# Database Setup Guide - The Management Gurus

## Error: Access Denied

You're seeing this error because the database user doesn't have permission to access the database.

```
#1044 - Access denied for user 'u112004868_pikachu_guru'@'127.0.0.1' to database 'management_gurus'
```

## Quick Fix Steps

### Step 1: Test Your Connection
1. Open your browser and go to: `http://yourdomain.com/test-db-connection.php`
2. This will show you exactly what's wrong

### Step 2: Fix Database Name
The database name in your config is: `u112004868_gurus`

Make sure this database exists in your hosting control panel (cPanel/Plesk).

### Step 3: Grant Permissions (cPanel)

If you're using cPanel:

1. **Login to cPanel**
2. **Go to MySQL Databases**
3. **Check if database exists:**
   - Look for database: `u112004868_gurus`
   - If it doesn't exist, create it

4. **Grant user permissions:**
   - Scroll to "Add User To Database"
   - Select User: `u112004868_pikachu_guru`
   - Select Database: `u112004868_gurus`
   - Click "Add"
   - Check "ALL PRIVILEGES"
   - Click "Make Changes"

### Step 4: Import Database Schema

**Option A: Using phpMyAdmin**
1. Open phpMyAdmin from cPanel
2. Select database: `u112004868_gurus`
3. Click "Import" tab
4. Choose file: `database/schema.sql`
5. Click "Go"

**Option B: Using Command Line**
```bash
mysql -u u112004868_pikachu_guru -p u112004868_gurus < database/schema.sql
```

**Option C: Using PHP Setup Script**
```bash
php database/setup.php
```

### Step 5: Verify Setup
1. Go to: `http://yourdomain.com/test-db-connection.php`
2. You should see: "✅ Everything looks good!"

## Alternative: Create Database Manually

If automatic setup doesn't work, create the table manually:

### SQL to Run in phpMyAdmin:

```sql
USE u112004868_gurus;

CREATE TABLE IF NOT EXISTS inquiries (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Testing the Form

After setup:
1. Go to your website
2. Click "Enquire Now"
3. Fill out the form
4. Submit
5. Check phpMyAdmin to see if data was saved

## Troubleshooting

### Error: Database doesn't exist
- Create it in cPanel MySQL Databases section
- Name it: `u112004868_gurus`

### Error: User doesn't have permission
- In cPanel, add user to database
- Grant ALL PRIVILEGES

### Error: Table doesn't exist
- Import `database/schema.sql` via phpMyAdmin
- Or run the SQL commands above

### Still having issues?
1. Check `php/config.php` - make sure credentials are correct
2. Contact your hosting provider
3. Check PHP error logs in cPanel

## Security Notes

After setup is complete:
1. Delete `test-db-connection.php` (it shows sensitive info)
2. Set `ENVIRONMENT` to `'production'` in `php/config.php`
3. Make sure your database password is strong

## Need Help?

If you're still stuck:
1. Check your hosting control panel documentation
2. Contact your hosting provider's support
3. They can help grant database permissions
