<?php
require_once '../php/config.php';
require_login();

$user = get_current_user();
$page_title = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <h2>TMG</h2>
                <p>Dashboard</p>
            </div>
            <nav class="sidebar-nav">
                <a href="index.php" class="nav-item active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="scholarship.php" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    Scholarship Quiz
                </a>
                <a href="lucky-draw.php" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                        <line x1="7" y1="7" x2="7.01" y2="7"/>
                    </svg>
                    Lucky Draw
                </a>
                <a href="services.php" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                    My Services
                </a>
                <a href="profile.php" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Profile
                </a>
                <a href="../php/logout.php" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-main">
            <div class="dashboard-header">
                <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
                <p>Here's what's happening with your account</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card-dash">
                    <div class="stat-icon">🎓</div>
                    <div class="stat-info">
                        <h3>Scholarship Status</h3>
                        <p class="stat-value">Not Attempted</p>
                        <a href="scholarship.php" class="stat-link">Take Quiz →</a>
                    </div>
                </div>
                
                <div class="stat-card-dash">
                    <div class="stat-icon">🎁</div>
                    <div class="stat-info">
                        <h3>Lucky Draw</h3>
                        <p class="stat-value">Not Entered</p>
                        <a href="lucky-draw.php" class="stat-link">Enter Now →</a>
                    </div>
                </div>
                
                <div class="stat-card-dash">
                    <div class="stat-icon">💼</div>
                    <div class="stat-info">
                        <h3>Services Booked</h3>
                        <p class="stat-value">0</p>
                        <a href="services.php" class="stat-link">Book Service →</a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="actions-grid">
                    <a href="scholarship.php" class="action-card">
                        <div class="action-icon">📝</div>
                        <h3>Take Scholarship Quiz</h3>
                        <p>20 questions, 30 minutes</p>
                    </a>
                    
                    <a href="lucky-draw.php" class="action-card">
                        <div class="action-icon">🎲</div>
                        <h3>Enter Lucky Draw</h3>
                        <p>Win amazing prizes weekly</p>
                    </a>
                    
                    <a href="services.php" class="action-card">
                        <div class="action-icon">🎯</div>
                        <h3>Book a Service</h3>
                        <p>Mock interviews, counselling & more</p>
                    </a>
                    
                    <a href="profile.php" class="action-card">
                        <div class="action-icon">👤</div>
                        <h3>Update Profile</h3>
                        <p>Keep your information current</p>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
