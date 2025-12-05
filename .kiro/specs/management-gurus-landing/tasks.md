# Implementation Plan

- [x] 1. Set up project structure and base files


  - Create directory structure: css/, js/, php/, images/
  - Create index.html with HTML5 boilerplate and section structure
  - Create empty CSS files (style.css, responsive.css, animations.css)
  - Create empty JS files (main.js, navigation.js, form.js)
  - Link Google Fonts (Poppins, Inter) in HTML head
  - _Requirements: 10.1, 10.4_






- [ ] 2. Implement CSS design system and base styles
  - [ ] 2.1 Create CSS variables for colors, typography, and spacing
    - Define color palette (primary #4F46E5, secondary #10B981, etc.)
    - Set up typography scale and font families

    - Create spacing utility variables
    - _Requirements: 9.1, 9.2_



  - [x] 2.2 Implement base styles and reset

    - Add CSS reset/normalize styles



    - Set body defaults (font-family, line-height, colors)
    - Style common elements (headings, paragraphs, buttons)
    - _Requirements: 9.2, 9.3_


- [x] 3. Build Hero Section

  - [ ] 3.1 Create hero section HTML structure
    - Add hero container with company name "The Management Gurus"
    - Add tagline and service description text
    - Add CTA button for inquiry form trigger


    - _Requirements: 1.1, 1.2, 1.3_



  - [x] 3.2 Style hero section with educational design

    - Implement full viewport height layout
    - Style typography with Poppins font, large bold heading

    - Add decorative elements (shapes, image placeholders)
    - Style CTA button with primary color
    - _Requirements: 1.1, 1.2, 9.1, 9.3_

- [x] 4. Build Bottom Navigation Menu

  - [ ] 4.1 Create navigation HTML structure
    - Add fixed bottom nav container

    - Add menu items: About Us, Services, Roadmap, Testimonials, Pricing, Contact

    - Add active state indicator element
    - _Requirements: 2.4_


  - [x] 4.2 Style bottom navigation

    - Position fixed at bottom with glassmorphism effect
    - Style menu items with hover and active states

    - Add smooth transitions for active indicator




    - _Requirements: 2.1, 9.4_

  - [ ] 4.3 Implement scroll detection with Intersection Observer
    - Set up Intersection Observer for all sections


    - Update active nav item based on visible section
    - Ensure highlight updates within 100ms
    - _Requirements: 2.2_




  - [x] 4.4 Implement smooth scroll navigation


    - Add click handlers to nav items
    - Implement smooth scroll to sections (500ms duration)

    - Prevent default anchor behavior
    - _Requirements: 2.3, 9.4_


- [x] 5. Build About Us Section

  - [ ] 5.1 Create About Us HTML structure
    - Add section with id="about"
    - Add vision statement content
    - Add key value propositions with icons



    - _Requirements: 3.1, 3.2, 3.3, 3.4_



  - [ ] 5.2 Style About Us section
    - Implement two-column layout (text + visual)
    - Style vision statement typography
    - Add icon styling for value propositions

    - _Requirements: 3.1, 9.1, 9.3_


- [ ] 6. Build Roadmap/Modules Section
  - [ ] 6.1 Create roadmap HTML structure
    - Add section with id="roadmap"
    - Create timeline/journey structure with 4 stages

    - Add stage content: Internship Selection, Interview Prep, Mock Interviews, Final Placement


    - Add "All at One Place" tagline


    - _Requirements: 4.1, 4.2, 4.4_

  - [ ] 6.2 Style roadmap as visual timeline
    - Create connected node/card design for stages

    - Add progress line connecting stages
    - Style stage icons and descriptions
    - Ensure visual progression is clear
    - _Requirements: 4.1, 4.3, 9.3_





- [x] 7. Build Testimonials Section

  - [x] 7.1 Create testimonials HTML structure

    - Add section with id="testimonials"
    - Create 3+ testimonial cards with photo, name, text

    - Add carousel/slider container structure
    - _Requirements: 5.1, 5.2_

  - [ ] 7.2 Style testimonials cards
    - Design card layout with circular photo, quote styling
    - Style student name and college text

    - Match educational design aesthetic
    - _Requirements: 5.2, 5.3, 9.1_


  - [ ] 7.3 Implement testimonials carousel/slider
    - Add horizontal scroll or navigation arrows
    - Implement smooth slide transitions


    - _Requirements: 5.1_

- [ ] 8. Build Commercial/Pricing Section
  - [x] 8.1 Create pricing HTML structure

    - Add section with id="pricing"

    - Create 2-3 pricing tier cards



    - Add feature lists and CTA buttons per card

    - _Requirements: 6.1, 6.2, 6.3_

  - [x] 8.2 Style pricing cards

    - Design card layout with tier name, price, features
    - Highlight recommended/popular package

    - Style feature checkmarks and CTA buttons
    - _Requirements: 6.1, 6.2, 9.1_

- [x] 9. Build Inquiry Popup Form

  - [x] 9.1 Create popup form HTML structure

    - Add modal overlay and form container


    - Add form fields: full name, email, phone, message

    - Add close button and submit button
    - _Requirements: 7.1, 7.2_

  - [x] 9.2 Style popup form modal

    - Style overlay with dark backdrop

    - Design form card with rounded corners


    - Style input fields with floating labels or placeholders
    - Add loading, success, and error state styles
    - _Requirements: 7.1, 7.6, 7.7_


  - [x] 9.3 Implement form open/close functionality


    - Add click handlers to all CTA buttons to open modal
    - Implement close on X button and overlay click
    - Add escape key to close modal
    - Ensure modal opens within 200ms
    - _Requirements: 7.1_


  - [ ] 9.4 Implement frontend form validation
    - Validate required fields (name, email, phone)
    - Add email format validation
    - Add phone number format validation
    - Display field-specific error messages

    - _Requirements: 7.3_





- [ ] 10. Build PHP Backend
  - [ ] 10.1 Create database configuration and connection
    - Create config.php with database credentials
    - Create db-connect.php with PDO connection

    - Create inquiries table SQL schema
    - _Requirements: 10.2, 10.3_

  - [x] 10.2 Implement form submission handler


    - Create submit-inquiry.php endpoint
    - Implement server-side validation
    - Sanitize all input data
    - Use prepared statements for database insert
    - _Requirements: 7.4, 7.5, 10.2_

  - [ ] 10.3 Implement email sending functionality
    - Configure PHP mail or SMTP settings
    - Send inquiry data to info@themanagementgurus.com
    - Handle email send failures gracefully
    - _Requirements: 7.4_

  - [ ] 10.4 Connect frontend form to PHP backend
    - Implement AJAX form submission in form.js
    - Handle success response and show confirmation
    - Handle error response and display messages
    - _Requirements: 7.6, 7.7_

- [ ] 11. Build Footer Section
  - Create footer HTML with company info, quick links, contact
  - Style footer with dark background
  - Add social media icon placeholders
  - _Requirements: 9.1_

- [ ] 12. Implement Responsive Design
  - [ ] 12.1 Add mobile styles (< 768px)
    - Single column layouts for all sections
    - Adjust typography sizes
    - Stack navigation items or use hamburger menu
    - Ensure touch-friendly form inputs
    - _Requirements: 8.1, 8.2, 8.3_

  - [ ] 12.2 Add tablet styles (768px - 1199px)
    - Two-column layouts where appropriate
    - Adjust spacing and padding
    - _Requirements: 8.1_

  - [ ] 12.3 Add desktop styles (1200px+)
    - Full multi-column layouts
    - Maximum content width constraints
    - _Requirements: 8.1_

- [ ] 13. Add animations and polish
  - [ ] 13.1 Implement scroll animations
    - Add fade-in animations for sections on scroll
    - Add subtle hover animations for cards and buttons
    - _Requirements: 9.4_

  - [ ] 13.2 Final polish and cross-browser testing
    - Test in Chrome, Firefox, Safari, Edge
    - Fix any browser-specific issues
    - Ensure smooth performance
    - _Requirements: 8.1, 9.4_

- [ ] 13.3 Write unit tests for form validation
    - Test valid/invalid inputs for each field
    - Test form submission success/error handling
    - _Requirements: 7.3, 7.6, 7.7_
