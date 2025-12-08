<?php
session_start();
require_once '../php/config.php';

$page_title = 'Register';
$current_page = 'register';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/auth.css?v=3.0.5">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Create Your Account</h1>
                <p>Join The Management Gurus</p>
            </div>
            
            <form id="registerForm" class="auth-form" enctype="multipart/form-data">
                <div class="form-row-auth">
                    <div class="form-group-auth">
                        <label>Full Name *</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group-auth">
                        <label>Email *</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
                
                <div class="form-row-auth">
                    <div class="form-group-auth">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" required>
                    </div>
                    <div class="form-group-auth">
                        <label>Location *</label>
                        <input type="text" name="location" required>
                    </div>
                </div>
                
                <div class="form-row-auth">
                    <div class="form-group-auth">
                        <label>Father's Name</label>
                        <input type="text" name="father_name">
                    </div>
                    <div class="form-group-auth">
                        <label>Father's Phone</label>
                        <input type="tel" name="father_phone">
                    </div>
                </div>
                
                <div class="form-group-auth">
                    <label>Current Education *</label>
                    <select name="current_education" required>
                        <option value="">Select...</option>
                        <option value="Undergraduate">Undergraduate</option>
                        <option value="Postgraduate">Postgraduate (MBA/PGDM)</option>
                        <option value="Working Professional">Working Professional</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group-auth">
                    <label>Upload Resume (PDF only)</label>
                    <input type="file" name="resume" accept=".pdf">
                    <small>Max size: 2MB</small>
                </div>
                
                <div class="form-row-auth">
                    <div class="form-group-auth">
                        <label>Password *</label>
                        <input type="password" name="password" required minlength="6">
                    </div>
                    <div class="form-group-auth">
                        <label>Confirm Password *</label>
                        <input type="password" name="confirm_password" required>
                    </div>
                </div>
                
                <div class="form-message"></div>
                
                <button type="submit" class="btn-auth">Create Account</button>
                
                <p class="auth-link">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>
    </div>
    
    <script src="../js/auth.js?v=3.0.5"></script>
</body>
</html>
