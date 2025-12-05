# Form Validation & Error Handling Updates

## Changes Made

### ✅ 1. Phone Number Validation - Exactly 10 Digits

**JavaScript (js/form.js):**
- Changed validation to require **exactly 10 digits**
- Added check for valid Indian mobile prefix (must start with 6, 7, 8, or 9)
- Updated placeholder to show format: `9876543210`
- Clear error message: "Please enter a valid 10-digit phone number"

**PHP (php/submit-inquiry.php):**
- Updated server-side validation to match (exactly 10 digits)
- Added prefix validation (6-9)
- Consistent error messages between frontend and backend

### ✅ 2. Improved Error Handling

**Better Error Messages:**
- Form now shows specific error details when submission fails
- Console logging for debugging
- Server response errors are displayed to user
- Network errors are caught and displayed

**Enhanced Logging:**
- Added detailed error logging in PHP
- Logs validation errors
- Logs database connection issues
- Logs successful submissions
- Stack traces for debugging

**Error Display:**
- Shows error message in the error slide
- Displays server status codes
- Shows validation errors
- Network error handling

### ✅ 3. Debugging Tools

**Created test-form.php:**
A diagnostic tool to help identify issues:
- Tests database connection
- Checks if tables exist
- Verifies PHP extensions
- Tests file permissions
- Provides a simple test form

**How to use:**
1. Navigate to: `http://yoursite.com/php/test-form.php`
2. Check all tests (should show ✅)
3. Try submitting the test form
4. Check browser console for errors

## Common Issues & Solutions

### Issue 1: Form Submission Error
**Symptoms:** Error message appears after submitting form

**Check:**
1. Open browser console (F12) - look for error messages
2. Check if `php/submit-inquiry.php` exists
3. Verify database credentials in `php/config.php`
4. Run `php/test-form.php` to diagnose

**Solutions:**
- If database error: Update credentials in config.php
- If table missing: Run `database/schema.sql`
- If file not found: Check file paths

### Issue 2: Phone Validation
**Symptoms:** Can't submit with phone number

**Requirements:**
- Must be exactly 10 digits
- Must start with 6, 7, 8, or 9
- No spaces, dashes, or special characters needed
- Example: `9876543210`

### Issue 3: CORS Error
**Symptoms:** "Access-Control-Allow-Origin" error

**Solution:**
Already added CORS headers in PHP:
```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
```

### Issue 4: Database Connection Failed
**Symptoms:** "Database connection failed" error

**Check:**
1. Verify database exists
2. Check credentials in `php/config.php`:
   - DB_HOST
   - DB_NAME
   - DB_USER
   - DB_PASS
3. Ensure MySQL/MariaDB is running
4. Check if user has permissions

**Solution:**
```sql
-- Grant permissions
GRANT ALL PRIVILEGES ON database_name.* TO 'username'@'localhost';
FLUSH PRIVILEGES;
```

## Testing Checklist

### Before Going Live:

- [ ] Run `php/test-form.php` - all tests pass
- [ ] Database connection works
- [ ] `inquiries` table exists
- [ ] Test form submission with valid data
- [ ] Test phone validation (10 digits)
- [ ] Test phone validation (invalid prefix)
- [ ] Test email validation
- [ ] Test rate limiting (multiple submissions)
- [ ] Check browser console for errors
- [ ] Check server error logs
- [ ] Test on mobile device
- [ ] Test success message displays
- [ ] Test error message displays

## Phone Number Validation Rules

### Valid Examples:
✅ `9876543210` - Starts with 9
✅ `8765432109` - Starts with 8
✅ `7654321098` - Starts with 7
✅ `6543210987` - Starts with 6

### Invalid Examples:
❌ `98765` - Less than 10 digits
❌ `98765432109` - More than 10 digits
❌ `5876543210` - Starts with 5 (invalid)
❌ `+91 9876543210` - Contains special characters
❌ `98 7654 3210` - Contains spaces

## Error Log Locations

Check these files for error details:

**Apache:**
- `/var/log/apache2/error.log`
- `/var/log/httpd/error_log`

**Nginx:**
- `/var/log/nginx/error.log`

**PHP:**
- Check `php.ini` for `error_log` location
- Often: `/var/log/php_errors.log`

**cPanel:**
- Home directory: `error_log`
- public_html: `error_log`

## Next Steps

1. **Test the form:**
   - Visit `php/test-form.php`
   - Check all diagnostics
   - Submit test form

2. **If errors occur:**
   - Check browser console (F12)
   - Check server error logs
   - Verify database credentials
   - Ensure table exists

3. **Production ready:**
   - All tests pass ✅
   - Form submits successfully ✅
   - Email notifications work ✅
   - Error handling works ✅

## Support

If you continue to have issues:
1. Check browser console for JavaScript errors
2. Check server logs for PHP errors
3. Run the test-form.php diagnostic
4. Verify database credentials
5. Ensure all files are uploaded correctly

---

**Status:** ✅ Phone validation updated to exactly 10 digits
**Status:** ✅ Error handling improved with detailed messages
**Status:** ✅ Debugging tools created (test-form.php)
