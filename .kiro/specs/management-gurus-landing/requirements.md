# Requirements Document

## Introduction

This document outlines the requirements for "The Management Gurus" landing page website - an educational platform focused on mock interviews, interview preparation, and placement assistance for students seeking positions at top colleges and companies. The website will feature a modern, educational design with smooth scroll-based navigation, inquiry forms, and a comprehensive roadmap of services from internship to final placement.

## Glossary

- **Landing_Page**: The main single-page website for The Management Gurus
- **Navigation_Menu**: A fixed bottom navigation bar that highlights the current section on scroll
- **Inquiry_Form**: A popup modal form for collecting visitor contact information
- **Roadmap_Module**: A visual representation of the student journey from internship to placement
- **Testimonials_Section**: A section displaying student success stories and reviews
- **Commercial_Section**: Pricing and service packages display area
- **PHP_Backend**: Server-side processing for form submissions and database operations
- **SQL_Database**: MySQL database for storing inquiry form submissions

## Requirements

### Requirement 1: Hero Section

**User Story:** As a visitor, I want to see an engaging hero section when I land on the website, so that I immediately understand what The Management Gurus offers.

#### Acceptance Criteria

1. WHEN a visitor loads the Landing_Page, THE Landing_Page SHALL display a hero section with the company name "The Management Gurus" prominently visible within 3 seconds of page load.
2. WHEN a visitor views the hero section, THE Landing_Page SHALL display a tagline describing mock interview and placement services.
3. THE Landing_Page SHALL include a call-to-action button in the hero section that opens the Inquiry_Form.

### Requirement 2: Bottom Navigation Menu

**User Story:** As a visitor, I want a navigation menu at the bottom of the viewport that updates as I scroll, so that I can easily navigate between sections and know my current location.

#### Acceptance Criteria

1. THE Navigation_Menu SHALL remain fixed at the bottom of the viewport during scrolling.
2. WHEN a visitor scrolls to a new section, THE Navigation_Menu SHALL highlight the corresponding menu item within 100 milliseconds.
3. WHEN a visitor clicks a Navigation_Menu item, THE Landing_Page SHALL smoothly scroll to the corresponding section within 500 milliseconds.
4. THE Navigation_Menu SHALL include links to: About Us, Services/Modules, Roadmap, Testimonials, Pricing, and Contact sections.

### Requirement 3: About Us Section

**User Story:** As a visitor, I want to learn about The Management Gurus' vision and mission, so that I can understand their approach to bridging the industry skills gap.

#### Acceptance Criteria

1. THE Landing_Page SHALL display an About Us section containing the company vision statement.
2. THE About Us section SHALL communicate the goal of bridging the gap between academic skills and industry requirements.
3. THE About Us section SHALL describe the company's approach to training people for industry readiness.
4. THE About Us section SHALL explain how the company connects students with top industries.

### Requirement 4: Services/Modules Roadmap Section

**User Story:** As a student, I want to see a clear roadmap of services from internship to final placement, so that I understand the complete journey The Management Gurus offers.

#### Acceptance Criteria

1. THE Landing_Page SHALL display a Roadmap_Module section showing the student journey as a visual progression.
2. THE Roadmap_Module SHALL include at minimum: Internship Selection, Interview Preparation, Mock Interviews, and Final Placement stages.
3. WHEN a visitor views the Roadmap_Module, THE Landing_Page SHALL present each stage as a distinct, visually connected module.
4. THE Roadmap_Module SHALL communicate that all services are available "all at one place."

### Requirement 5: Testimonials Section

**User Story:** As a prospective student, I want to read testimonials from previous students, so that I can trust the quality of The Management Gurus' services.

#### Acceptance Criteria

1. THE Landing_Page SHALL display a Testimonials_Section with at least 3 student testimonials.
2. THE Testimonials_Section SHALL include student name, photo placeholder, and testimonial text for each entry.
3. THE Testimonials_Section SHALL follow the educational design aesthetic consistent with the rest of the page.

### Requirement 6: Commercial/Pricing Section

**User Story:** As a potential customer, I want to see pricing information and service packages, so that I can make an informed decision about enrolling.

#### Acceptance Criteria

1. THE Landing_Page SHALL display a Commercial_Section with service packages and pricing information.
2. THE Commercial_Section SHALL present at least 2 different service tiers or packages.
3. THE Commercial_Section SHALL include a call-to-action button that opens the Inquiry_Form for each package.

### Requirement 7: Inquiry Popup Form

**User Story:** As an interested visitor, I want to submit my contact information through a popup form, so that The Management Gurus can reach out to me.

#### Acceptance Criteria

1. WHEN a visitor clicks an inquiry button, THE Landing_Page SHALL display the Inquiry_Form as a modal popup within 200 milliseconds.
2. THE Inquiry_Form SHALL collect: full name, email address, phone number, and message fields.
3. THE Inquiry_Form SHALL validate all required fields before submission.
4. WHEN a visitor submits the Inquiry_Form, THE PHP_Backend SHALL send the form data to info@themanagementgurus.com.
5. WHEN a visitor submits the Inquiry_Form, THE PHP_Backend SHALL store the submission in the SQL_Database.
6. WHEN form submission succeeds, THE Inquiry_Form SHALL display a success confirmation message.
7. IF form submission fails, THEN THE Inquiry_Form SHALL display an error message to the visitor.

### Requirement 8: Responsive Design

**User Story:** As a visitor using different devices, I want the website to display correctly on desktop, tablet, and mobile, so that I have a good experience regardless of my device.

#### Acceptance Criteria

1. THE Landing_Page SHALL adapt its layout for screen widths of 320px, 768px, and 1200px or greater.
2. THE Navigation_Menu SHALL remain functional and accessible on all supported screen sizes.
3. THE Inquiry_Form SHALL be fully usable on mobile devices with touch input.

### Requirement 9: Educational Design Aesthetic

**User Story:** As a visitor, I want the website to have a professional educational look and feel, so that I perceive The Management Gurus as a credible educational service.

#### Acceptance Criteria

1. THE Landing_Page SHALL use a color scheme appropriate for educational platforms (clean, professional colors).
2. THE Landing_Page SHALL use readable typography with a minimum body text size of 16px.
3. THE Landing_Page SHALL incorporate visual elements (icons, illustrations) consistent with educational website standards.
4. THE Landing_Page SHALL implement smooth scroll transitions between sections.

### Requirement 10: Technology Stack Compliance

**User Story:** As a developer, I want the website built with HTML, CSS, JavaScript for frontend and PHP for backend, so that it meets the specified technology requirements.

#### Acceptance Criteria

1. THE Landing_Page frontend SHALL be built using only HTML, CSS, and vanilla JavaScript.
2. THE PHP_Backend SHALL handle form processing and email sending functionality.
3. THE PHP_Backend SHALL connect to a MySQL SQL_Database for storing form submissions.
4. THE Landing_Page SHALL not use any frontend frameworks (React, Vue, Angular, etc.).
