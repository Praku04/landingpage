# TMG Admin Panel Guide

## Admin Access

**URL:** `http://yoursite.com/admin/login.php`

**Default Credentials:**
- Username: `admin`
- Password: `password`

**IMPORTANT:** Change the default password immediately after first login by updating the database.

## Admin Features

### 1. Dashboard
- View statistics: Total users, questions, quiz attempts, bookings, lucky draw entries
- Quick access to all admin functions
- Real-time data overview

### 2. Quiz Questions Management
**Features:**
- Add new questions with multiple choice answers
- Edit existing questions
- Activate/Deactivate questions
- Delete questions
- Filter by year (2019-2023), difficulty (Easy/Medium/Hard), topic (Quantitative/Verbal/Logical/Data Interpretation)
- Pagination for easy navigation

**Adding Questions:**
1. Click "Add Question" button
2. Fill in all fields:
   - Question text
   - Four options (A, B, C, D)
   - Correct answer
   - Topic, Year, Difficulty
   - Active status
3. Click "Save Question"

**Database:** 100 CAT questions from 2019-2023 are pre-loaded. Additional questions can be added via:
- Admin panel interface
- SQL file: `database/additional_questions.sql`

### 3. Users Management
- View all registered users
- See user details: Name, Email, Phone, Location, Education
- Track registration dates
- Export user data (future feature)

### 4. Service Bookings
- View all service bookings (Mock Interview, Career Counselling, Placement Support)
- Update booking status: Pending → Confirmed → Completed/Cancelled
- Contact information for each booking
- Preferred date and time slots

### 5. Lucky Draw Management
- View all weekly entries (max 100 per week)
- Mark winners
- Track entry numbers and dates
- Week-wise filtering
- Winner notification (manual via email/phone)

## Database Setup

1. Import the main schema:
```sql
mysql -u username -p database_name < database/tmg_complete_schema.sql
```

2. Add additional questions:
```sql
mysql -u username -p database_name < database/additional_questions.sql
```

## Security Notes

1. **Change Default Password:**
```sql
UPDATE admin_users SET password = '$2y$10$YOUR_NEW_HASHED_PASSWORD' WHERE username = 'admin';
```

2. **Protect Admin Directory:**
Add to `.htaccess` in admin folder:
```apache
<Files "*.php">
    Order Deny,Allow
    Deny from all
    Allow from YOUR_IP_ADDRESS
</Files>
```

3. **Use HTTPS:** Always access admin panel over HTTPS in production

## User Features

### Registration
- Name, Email, Phone, Location
- Father's Name, Father's Phone
- Current Education
- Resume Upload (PDF, max 2MB)
- Password (hashed with bcrypt)

### Dashboard
Users can access:
1. **Scholarship Programme:** Take 20-question quiz (30 minutes)
2. **Lucky Draw:** Enter weekly draw (first 100 entries)
3. **Service Booking:** Book mock interviews, counselling, placement support
4. **Profile:** Edit details and update resume

### Scholarship Quiz
- 20 random questions from database
- 30-minute timer (auto-submit)
- One attempt per user
- Results show score, time taken, correct/wrong answers
- Questions from CAT 2019-2023

### Lucky Draw
- Weekly entries (max 100)
- Entry number assigned automatically
- Winner announcement by admin
- Prizes: Counselling discounts, college fee discounts, internships

## File Structure

```
admin/
├── login.php          # Admin login
├── dashboard.php      # Main dashboard
├── questions.php      # Quiz questions CRUD
├── users.php          # User management
├── bookings.php       # Service bookings
└── lucky-draw.php     # Lucky draw management

php/
├── admin_login_process.php
├── admin_logout.php
├── admin_save_question.php
├── admin_get_question.php
├── admin_delete_question.php
├── admin_toggle_question.php
├── admin_update_booking.php
└── admin_mark_winner.php

css/
└── admin.css          # Admin panel styles

js/
├── admin-auth.js      # Admin authentication
└── admin-questions.js # Question management
```

## Support

For technical issues or questions, contact the development team.
