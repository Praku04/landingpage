<?php
session_start();
require_once '../php/config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$admin = getUserById($_SESSION['admin_id'], 'admin_users');

// Get statistics
$conn = getDBConnection();
$stats = [
    'total_users' => $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'],
    'total_questions' => $conn->query("SELECT COUNT(*) as count FROM quiz_questions")->fetch_assoc()['count'],
    'active_questions' => $conn->query("SELECT COUNT(*) as count FROM quiz_questions WHERE is_active = 1")->fetch_assoc()['count'],
    'quiz_attempts' => $conn->query("SELECT COUNT(*) as count FROM quiz_attempts")->fetch_assoc()['count'],
    'lucky_draw_entries' => $conn->query("SELECT COUNT(*) as count FROM lucky_draw_entries")->fetch_assoc()['count'],
    'service_bookings' => $conn->query("SELECT COUNT(*) as count FROM service_bookings")->fetch_assoc()['count']
];
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TMG</title>
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
    <link rel="stylesheet" href="../css/admin.css?v=3.0.5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-user-shield"></i> TMG Admin</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="questions.php"><i class="fas fa-question-circle"></i> Quiz Questions</a>
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
                <a href="bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
                <a href="lucky-draw.php"><i class="fas fa-gift"></i> Lucky Draw</a>
                <a href="../php/admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="content-header">
                <h1>Admin Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($admin['username']); ?>!</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['total_users']; ?></h3>
                        <p>Total Users</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-question-circle"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['total_questions']; ?></h3>
                        <p>Total Questions</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-check-circle"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['active_questions']; ?></h3>
                        <p>Active Questions</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-clipboard-check"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['quiz_attempts']; ?></h3>
                        <p>Quiz Attempts</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-gift"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['lucky_draw_entries']; ?></h3>
                        <p>Lucky Draw Entries</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-calendar-check"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['service_bookings']; ?></h3>
                        <p>Service Bookings</p>
                    </div>
                </div>
            </div>
            
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="action-grid">
                    <a href="questions.php?action=add" class="action-card">
                        <i class="fas fa-plus-circle"></i>
                        <h3>Add Question</h3>
                        <p>Add new quiz question</p>
                    </a>
                    <a href="users.php" class="action-card">
                        <i class="fas fa-users"></i>
                        <h3>Manage Users</h3>
                        <p>View all registered users</p>
                    </a>
                    <a href="bookings.php" class="action-card">
                        <i class="fas fa-calendar"></i>
                        <h3>View Bookings</h3>
                        <p>Manage service bookings</p>
                    </a>
                    <a href="lucky-draw.php" class="action-card">
                        <i class="fas fa-trophy"></i>
                        <h3>Lucky Draw</h3>
                        <p>Manage weekly winners</p>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
