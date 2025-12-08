# TMG Database Setup Guide

## Single File Installation

All database schema and initial data has been consolidated into one file for easy deployment on shared hosting.

### File: `tmg_complete_database.sql`

This file contains:
- All table schemas (users, admin, quiz, lucky draw, bookings, email system)
- Default admin account
- Email templates
- 5 TMG brand story questions for lucky draw
- 20 sample CAT questions

### Installation Steps

#### For Shared Hosting (cPanel/phpMyAdmin):

1. **Login to phpMyAdmin**
   - Access your hosting control panel (cPanel)
   - Click on phpMyAdmin

2. **Select Your Database**
   - Click on your database name from the left sidebar
   - (If you don't have a database, create one first)

3. **Import the SQL File**
   - Click on the "Import" tab at the top
   - Click "Choose File" and select `tmg_complete_database.sql`
   - Scroll down and click "Go"
   - Wait for the import to complete

4. **Verify Installation**
   - Check that all tables are created (should see 15+ tables)
   - Look for: users, admin_users, quiz_questions, lucky_draw_entries, etc.

### Important: Update Database Configuration

After importing, update your database connection in `php/config.php`:

```php
$host = 'localhost';           // Usually 'localhost' for shared hosting
$dbname = 'your_database_name'; // Your actual database name
$username = 'your_db_username'; // Your database username
$password = 'your_db_password'; // Your database password
```

### Default Admin Credentials

**Username:** admin  
**Password:** password  

⚠️ **IMPORTANT:** Change this password immediately after first login!

### Tables Created

1. **users** - Student/user accounts
2. **admin_users** - Admin panel access
3. **quiz_questions** - Scholarship quiz questions
4. **quiz_attempts** - Quiz attempt tracking
5. **quiz_answers** - Individual question answers
6. **lucky_draw_quiz_questions** - TMG brand story questions
7. **lucky_draw_quiz_attempts** - Lucky draw quiz tracking
8. **lucky_draw_entries** - Weekly lucky draw entries
9. **service_bookings** - Service booking requests
10. **contact_submissions** - Contact form submissions
11. **email_logs** - Email sending logs
12. **notifications** - In-app notifications
13. **email_templates** - Email template management

### Troubleshooting

**Error: "Table already exists"**
- This is normal if you're re-running the script
- The script uses `CREATE TABLE IF NOT EXISTS` to avoid errors

**Error: "Foreign key constraint fails"**
- Make sure you're using InnoDB engine
- Check that your MySQL version supports foreign keys

**Error: "Access denied"**
- Verify your database credentials in `php/config.php`
- Ensure your database user has proper permissions

### Need Help?

Contact your hosting provider if you encounter issues with:
- Database creation
- Import file size limits
- Permission errors
- MySQL version compatibility

---

**Note:** This file is optimized for shared hosting and does not use `USE database` statements. Always select your database first before importing.
