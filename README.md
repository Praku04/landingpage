# TMG - The Management Gurus

A complete career management platform for students featuring scholarship quizzes, lucky draws, service bookings, and career guidance.

## 🚀 Quick Start

### 1. Database Setup
1. Login to phpMyAdmin on your hosting
2. Select your database
3. Import `database/tmg_complete_database.sql`
4. Done! All tables and initial data will be created

### 2. Configuration
Edit `php/config.php` with your database credentials:
```php
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_db_username';
$password = 'your_db_password';
```

### 3. Default Admin Login
- **URL:** `admin/login.php`
- **Username:** admin
- **Password:** password
- ⚠️ **Change this immediately after first login!**

## 📁 Project Structure

```
tmg/
├── index.php              # Homepage
├── about.php              # About page
├── services.php           # Services page
├── contact.php            # Contact page
├── roadmap.php            # Career roadmap
├── testimonials.php       # Student testimonials
├── colleges.php           # Partner colleges
│
├── auth/                  # Authentication
│   ├── login.php
│   └── register.php
│
├── dashboard/             # Student Dashboard
│   ├── index.php         # Dashboard home
│   ├── profile.php       # Profile management
│   ├── scholarship.php   # Scholarship quiz
│   ├── lucky-draw.php    # Lucky draw entry
│   └── services.php      # Service booking
│
├── admin/                 # Admin Panel
│   ├── login.php         # Admin login
│   ├── dashboard.php     # Admin dashboard
│   ├── users.php         # User management
│   ├── questions.php     # Quiz questions
│   ├── bookings.php      # Service bookings
│   └── lucky-draw.php    # Lucky draw management
│
├── php/                   # Backend Logic
│   ├── config.php        # Database config
│   ├── register_process.php
│   ├── submit_quiz.php
│   ├── enter_lucky_draw.php
│   └── email_config.php
│
├── css/                   # Stylesheets
├── js/                    # JavaScript
├── images/                # Images
└── database/              # Database files
    ├── tmg_complete_database.sql  # Main database file
    └── README.md          # Database setup guide
```

## ✨ Features

### For Students
- 📝 **Registration & Login** - Secure account creation
- 🎓 **Scholarship Quiz** - 20 CAT questions, earn scholarships
- 🎰 **Weekly Lucky Draw** - Answer 5 TMG questions to enter
- 📅 **Service Booking** - Book mock interviews, counselling
- 👤 **Profile Management** - Update details, upload resume
- 📊 **Dashboard** - Track quiz scores, bookings, entries

### For Admins
- 👥 **User Management** - View and manage all users
- ❓ **Question Bank** - Add/edit quiz questions
- 📋 **Booking Management** - Handle service requests
- 🎲 **Lucky Draw** - Manage weekly draws, select winners
- 📧 **Email System** - Send notifications to users

### Technical Features
- ✅ Fully responsive (mobile, tablet, desktop)
- ✅ Modern UI with smooth animations
- ✅ Email notification system
- ✅ Secure authentication (password hashing)
- ✅ SQL injection protection
- ✅ Form validation (client & server)
- ✅ Session management

## 🎯 Main Pages

### Public Pages
- **Homepage** - Hero section, stats, call-to-action
- **About** - Company story, mission, values
- **Services** - Mock interviews, counselling, placement
- **Roadmap** - 4-step career journey
- **Testimonials** - Student success stories
- **Colleges** - Partner institutions
- **Contact** - Contact form

### Student Dashboard
- **Scholarship Quiz** - Take quiz, view results
- **Lucky Draw** - Answer brand questions, enter draw
- **Services** - Book career services
- **Profile** - Manage account details

### Admin Panel
- **Dashboard** - Overview statistics
- **Users** - User list and management
- **Questions** - Quiz question management
- **Bookings** - Service booking requests
- **Lucky Draw** - Weekly draw management

## 🗄️ Database Tables

1. **users** - Student accounts
2. **admin_users** - Admin accounts
3. **quiz_questions** - Scholarship quiz questions (CAT)
4. **quiz_attempts** - Quiz attempt tracking
5. **quiz_answers** - Individual answers
6. **lucky_draw_quiz_questions** - TMG brand questions
7. **lucky_draw_quiz_attempts** - Lucky draw quiz tracking
8. **lucky_draw_entries** - Weekly draw entries
9. **service_bookings** - Service booking requests
10. **contact_submissions** - Contact form submissions
11. **email_logs** - Email sending logs
12. **notifications** - In-app notifications
13. **email_templates** - Email templates

## 📧 Email Setup

Edit `php/email_config.php` to configure email:
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('FROM_EMAIL', 'noreply@tmg.com');
define('FROM_NAME', 'The Management Gurus');
```

See `EMAIL_SETUP_GUIDE.md` for detailed instructions.

## 🔒 Security

- Password hashing with bcrypt
- Prepared statements (SQL injection prevention)
- Input sanitization (XSS prevention)
- Session security
- CSRF protection on forms
- File upload validation

## 🎨 Design System

### Colors
- **Primary:** #1e40af (Blue)
- **Secondary:** #0891b2 (Cyan)
- **Success:** #10B981 (Green)
- **Text:** #111827 (Dark)

### Typography
- **Headings:** Poppins
- **Body:** Inter

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers

## 🛠️ Requirements

- PHP 7.4 or higher
- MySQL 5.7+ / MariaDB 10.2+
- Apache/Nginx web server
- mod_rewrite enabled (for .htaccess)

## 📞 Support

For technical issues:
1. Check `database/README.md` for database setup
2. Check `EMAIL_SETUP_GUIDE.md` for email configuration
3. Check `ADMIN_GUIDE.md` for admin panel usage
4. Review browser console for JavaScript errors
5. Check server error logs for PHP errors

## 📝 Important Files

- `database/tmg_complete_database.sql` - Complete database
- `php/config.php` - Database configuration
- `php/email_config.php` - Email configuration
- `.htaccess` - URL rewriting rules

## 🎉 Version

**Version:** 1.0  
**Last Updated:** December 2024  
**Status:** Production Ready

---

**© 2024 The Management Gurus. All rights reserved.**

Built with ❤️ for management students aspiring to become future leaders.
