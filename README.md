# The Management Gurus - Landing Page

A modern, responsive landing page for The Management Gurus - your complete career partner for management students.

## 🎯 Features

### Core Sections
- **Hero Section** - Eye-catching introduction with animated elements
- **About Us** - Company ideology and mission
- **Career Services** - Redesigned modern service showcase
- **Roadmap** - Step-by-step journey to success
- **Testimonials** - Student success stories
- **Resources** - Podcast series and content
- **Top Colleges** - Partner institutions
- **FAQ** - Common questions answered
- **Contact** - Footer with contact information

### Key Features
✅ Fully responsive design (Desktop, Tablet, Mobile)
✅ Interactive form with step-by-step flow
✅ Mobile-optimized navigation
✅ Smooth animations and transitions
✅ Modern UI/UX design
✅ SEO optimized
✅ Fast loading performance

## 📱 Mobile Optimizations

- Horizontal scrollable navigation
- Full-width college cards
- Responsive form with keyboard handling
- Touch-friendly interface
- Optimized images and layouts

## 🎨 Design Highlights

### Services Section (Redesigned)
- **Featured Services** - Prominent display of main offerings
- **Compact Grid** - Quick overview of all services
- **Modern Cards** - Clean, professional design
- **Call-to-Action** - Direct booking buttons

### Navigation
- About | Services | Roadmap | Testimonials | Top Colleges | Contact
- Sticky bottom navigation
- Active state indicators
- Smooth scroll behavior

## 🗂️ File Structure

```
landingpage/
├── index.html              # Main HTML file
├── css/
│   ├── style.css          # Main styles
│   ├── animations.css     # Animation styles
│   └── responsive.css     # Responsive styles
├── js/
│   ├── main.js           # Main JavaScript
│   ├── form.js           # Form handling
│   └── navigation.js     # Navigation logic
├── php/
│   ├── config.php        # Database configuration
│   ├── db-connect.php    # Database connection
│   ├── submit-inquiry.php # Form submission handler
│   └── test-form.php     # Form testing tool
├── database/
│   ├── schema.sql        # Database schema
│   └── schema_optional_enhancements.sql
├── images/               # Image assets
└── README.md            # This file
```

## 🚀 Setup Instructions

### 1. Database Setup
```sql
-- Run the schema file
mysql -u username -p database_name < database/schema.sql
```

### 2. Configuration
Edit `php/config.php` with your database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

### 3. Test Form
Visit `php/test-form.php` to test:
- Database connection
- Table structure
- Form submission
- PHP configuration

### 4. Deploy
Upload all files to your web server and you're ready to go!

## 📋 Form Features

- **Step-by-step flow** - One question at a time
- **Real-time validation** - Instant feedback
- **Mobile responsive** - Works with keyboard
- **Error handling** - Clear error messages
- **Success confirmation** - Beautiful success screen
- **10-digit phone validation** - Indian mobile numbers

## 🎯 Services Offered

### Featured Services
1. **Mock Interviews** - Real-world practice with industry experts
2. **Career Counselling** - Personalized guidance for your career path

### Additional Services
- 📚 CAT & Exam Prep
- 💼 Internship Support
- 🎓 College Selection
- 🤖 AI & Tech Insights

## 🔧 Technical Stack

- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+ / MariaDB 10.2+
- **Design:** Custom CSS with CSS Variables
- **Icons:** SVG (inline)
- **Fonts:** Google Fonts (Inter, Poppins)

## 📱 Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🎨 Color Palette

- **Primary:** #1e40af (Blue)
- **Secondary:** #0891b2 (Cyan)
- **Success:** #10B981 (Green)
- **Accent:** #FBBF24 (Yellow)
- **Text:** #111827 (Dark Gray)

## 📊 Performance

- **Lighthouse Score:** 90+
- **Mobile Friendly:** Yes
- **Page Load:** < 2s
- **First Contentful Paint:** < 1s

## 🔒 Security Features

- SQL injection prevention (PDO prepared statements)
- XSS protection (input sanitization)
- CSRF protection (form tokens)
- Rate limiting (prevent spam)
- Input validation (client & server-side)

## 📞 Support

For issues or questions:
- Email: info@themanagementgurus.com
- Test Form: `php/test-form.php`
- Check browser console for errors
- Check server error logs

## 📝 License

© 2024 The Management Gurus. All rights reserved.

## 🎉 Recent Updates

### Latest Changes (December 2024)
- ✅ Redesigned services section with modern layout
- ✅ Removed unnecessary documentation files
- ✅ Improved mobile responsiveness
- ✅ Enhanced form keyboard handling
- ✅ Updated navigation menu
- ✅ Moved FAQ to end of page
- ✅ Optimized college cards for mobile

---

**Built with ❤️ for management students**
