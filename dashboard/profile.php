<?php
require_once '../php/config.php';
require_login();

$user = get_current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
    <link rel="stylesheet" href="../css/profile.css?v=3.0.5">
</head>
<body>
    <div class="profile-container">
        <div class="profile-content">
            <h1>My Profile</h1>
            <p>Manage your account information</p>
            
            <div class="profile-card">
                <form id="profileForm" enctype="multipart/form-data">
                    <div class="form-row-profile">
                        <div class="form-group-profile">
                            <label>Full Name *</label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>
                        <div class="form-group-profile">
                            <label>Email *</label>
                            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                            <small>Email cannot be changed</small>
                        </div>
                    </div>
                    
                    <div class="form-row-profile">
                        <div class="form-group-profile">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                        </div>
                        <div class="form-group-profile">
                            <label>Location *</label>
                            <input type="text" name="location" value="<?php echo htmlspecialchars($user['location']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row-profile">
                        <div class="form-group-profile">
                            <label>Father's Name</label>
                            <input type="text" name="father_name" value="<?php echo htmlspecialchars($user['father_name']); ?>">
                        </div>
                        <div class="form-group-profile">
                            <label>Father's Phone</label>
                            <input type="tel" name="father_phone" value="<?php echo htmlspecialchars($user['father_phone']); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group-profile">
                        <label>Current Education *</label>
                        <select name="current_education" required>
                            <option value="Undergraduate" <?php echo $user['current_education'] == 'Undergraduate' ? 'selected' : ''; ?>>Undergraduate</option>
                            <option value="Postgraduate" <?php echo $user['current_education'] == 'Postgraduate' ? 'selected' : ''; ?>>Postgraduate (MBA/PGDM)</option>
                            <option value="Working Professional" <?php echo $user['current_education'] == 'Working Professional' ? 'selected' : ''; ?>>Working Professional</option>
                            <option value="Other" <?php echo $user['current_education'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group-profile">
                        <label>Update Resume (PDF only)</label>
                        <?php if ($user['resume_path']): ?>
                        <p class="current-resume">Current: <a href="../<?php echo $user['resume_path']; ?>" target="_blank">View Resume</a></p>
                        <?php endif; ?>
                        <input type="file" name="resume" accept=".pdf">
                        <small>Max size: 2MB</small>
                    </div>
                    
                    <div class="form-message"></div>
                    
                    <button type="submit" class="btn-update-profile">Update Profile</button>
                </form>
            </div>
            
            <a href="index.php" class="btn-back-dash">← Back to Dashboard</a>
        </div>
    </div>
    
    <script src="../js/profile.js?v=3.0.5"></script>
</body>
</html>
