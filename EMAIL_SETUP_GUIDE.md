# TMG Email System Setup Guide

## Overview
The TMG platform now includes a complete email notification system that sends automated emails for:
- User registration (welcome email)
- Quiz results
- Lucky draw entry confirmation
- Service booking confirmation
- Contact form submissions (to admin)

## Database Setup

### Step 1: Update Database Schema
Run the complete update SQL file:

```bash
mysql -u your_username -p your_database < database/complete_update.sql
```

This will create:
- `contact_submissions` table
- `email_logs` table
- `notifications` table
- `email_templates` table
- Add email preference columns to `users` table

### Step 2: Verify Tables
Check if all tables were created:

```sql
SHOW TABLES LIKE '%email%';
SHOW TABLES LIKE '%contact%';
SHOW TABLES LIKE '%notifications%';
```

## Email Configuration

### Option 1: PHP mail() Function (Default)
The system uses PHP's built-in `mail()` function by default. This works on most shared hosting.

**No configuration needed** - it works out of the box!

### Option 2: SMTP (Recommended for Production)
For better deliverability, use SMTP (Gmail, SendGrid, Mailgun, etc.)

#### Using Gmail SMTP:

1. **Enable 2-Factor Authentication** on your Gmail account

2. **Generate App Password:**
   - Go to Google Account → Security → 2-Step Verification → App passwords
   - Generate a new app password for "Mail"
   - Copy the 16-character password

3. **Update `php/email_config.php`:**

```php
define('SMTP_ENABLED', true);
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-16-char-app-password');
define('SMTP_ENCRYPTION', 'tls');
```

4. **Install PHPMailer** (if using SMTP):

```bash
composer require phpmailer/phpmailer
```

5. **Update email addresses:**

```php
define('FROM_EMAIL', 'noreply@yourdomain.com');
define('FROM_NAME', 'The Management Gurus');
define('ADMIN_EMAIL', 'admin@yourdomain.com');
define('SUPPORT_EMAIL', 'support@yourdomain.com');
```

## Email Types

### 1. Welcome Email
**Trigger:** User registration  
**Recipient:** New user  
**File:** `php/register_process.php`

```php
sendWelcomeEmail($email, $name);
```

### 2. Quiz Result Email
**Trigger:** Quiz submission  
**Recipient:** User who completed quiz  
**File:** `php/submit_quiz.php`

```php
sendQuizResultEmail($email, $name, $score, $total, $percentage);
```

### 3. Lucky Draw Confirmation
**Trigger:** Lucky draw entry  
**Recipient:** User who entered  
**File:** `php/enter_lucky_draw.php`

```php
sendLuckyDrawConfirmation($email, $name, $entryNumber, $weekNumber);
```

### 4. Booking Confirmation
**Trigger:** Service booking  
**Recipient:** User who booked  
**File:** `php/book_service.php`

```php
sendBookingConfirmation($email, $name, $serviceType, $date, $time);
```

### 5. Contact Form to Admin
**Trigger:** Contact form submission  
**Recipient:** Admin  
**File:** `php/submit_contact_form.php`

```php
sendContactFormToAdmin($name, $email, $phone, $location, $fatherName, $fatherPhone, $query);
```

## Testing Emails

### Test 1: Registration Email
1. Go to `auth/register.php`
2. Register a new user with your email
3. Check your inbox for welcome email

### Test 2: Contact Form
1. Go to homepage
2. Click "Get Started" button
3. Fill and submit the contact form
4. Check admin email for submission

### Test 3: Quiz Result
1. Login to dashboard
2. Take the scholarship quiz
3. Submit answers
4. Check email for results

### Test 4: Lucky Draw
1. Login to dashboard
2. Enter lucky draw
3. Check email for confirmation

## Troubleshooting

### Emails Not Sending

**Check 1: PHP mail() enabled**
```php
<?php
if (function_exists('mail')) {
    echo "mail() is available";
} else {
    echo "mail() is NOT available";
}
?>
```

**Check 2: Check spam folder**
- Emails might be in spam/junk folder
- Add sender to contacts

**Check 3: Server logs**
```bash
tail -f /var/log/mail.log
```

**Check 4: Test basic email**
```php
<?php
$to = "your-email@example.com";
$subject = "Test Email";
$message = "This is a test email";
$headers = "From: noreply@yourdomain.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Email failed";
}
?>
```

### Gmail SMTP Issues

**Error: "Username and Password not accepted"**
- Make sure 2FA is enabled
- Use App Password, not regular password
- Check username is full email address

**Error: "Could not authenticate"**
- Enable "Less secure app access" (not recommended)
- Or use App Password (recommended)

**Error: "Connection timeout"**
- Check firewall allows port 587
- Try port 465 with SSL instead of TLS

## Email Logs

All emails are logged in the `email_logs` table:

```sql
SELECT * FROM email_logs ORDER BY sent_at DESC LIMIT 10;
```

Check failed emails:
```sql
SELECT * FROM email_logs WHERE status = 'failed';
```

## Admin Panel - Contact Submissions

View contact form submissions in admin panel:

```sql
SELECT * FROM contact_submissions ORDER BY submitted_at DESC;
```

Or create an admin page to view them (future enhancement).

## Customizing Email Templates

### Method 1: Edit PHP Functions
Edit functions in `php/email_config.php`:
- `sendWelcomeEmail()`
- `sendQuizResultEmail()`
- `sendLuckyDrawConfirmation()`
- etc.

### Method 2: Use Database Templates
Update templates in `email_templates` table:

```sql
UPDATE email_templates 
SET body = '<h2>Your custom HTML</h2>' 
WHERE template_name = 'welcome';
```

## Production Checklist

- [ ] Update email addresses in `php/email_config.php`
- [ ] Configure SMTP if using (recommended)
- [ ] Test all email types
- [ ] Check spam score (use mail-tester.com)
- [ ] Set up SPF, DKIM, DMARC records for domain
- [ ] Monitor email logs regularly
- [ ] Set up email bounce handling
- [ ] Configure email rate limiting if needed

## Alternative Email Services

### SendGrid
- Free tier: 100 emails/day
- Better deliverability
- Detailed analytics

### Mailgun
- Free tier: 5,000 emails/month
- Good for transactional emails

### Amazon SES
- Very cheap: $0.10 per 1,000 emails
- Requires AWS account

### Postmark
- Focused on transactional emails
- Great deliverability

## Support

For issues or questions:
- Check error logs: `php/error.log`
- Check email logs: `SELECT * FROM email_logs WHERE status='failed'`
- Test with different email providers
- Contact hosting support if mail() doesn't work

---

**Email system is now ready to use!**
