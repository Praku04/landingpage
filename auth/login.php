<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ../dashboard/index.php');
    exit;
}

$page_title = 'Login';
$current_page = 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/auth.css?v=3.0.5">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Login to your TMG account</p>
            </div>
            
            <form id="loginForm" class="auth-form">
                <div class="form-group-auth">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group-auth">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                
                <div class="form-message"></div>
                
                <button type="submit" class="btn-auth">Login</button>
                
                <p class="auth-link">
                    Don't have an account? <a href="register.php">Register here</a>
                </p>
            </form>
        </div>
    </div>
    
    <script src="../js/auth.js?v=3.0.5"></script>
</body>
</html>
