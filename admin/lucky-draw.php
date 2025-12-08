<?php
session_start();
require_once '../php/config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$conn = getDBConnection();
$entries = $conn->query("SELECT ld.*, u.name, u.email, u.phone FROM lucky_draw_entries ld JOIN users u ON ld.user_id = u.id ORDER BY ld.entry_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Draw - TMG Admin</title>
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
                <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="questions.php"><i class="fas fa-question-circle"></i> Quiz Questions</a>
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
                <a href="bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
                <a href="lucky-draw.php" class="active"><i class="fas fa-gift"></i> Lucky Draw</a>
                <a href="../php/admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="content-header">
                <h1>Lucky Draw Entries</h1>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Entry #</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Week</th>
                            <th>Entry Date</th>
                            <th>Winner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($entry = $entries->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $entry['entry_number']; ?></td>
                            <td><?php echo htmlspecialchars($entry['name']); ?></td>
                            <td><?php echo htmlspecialchars($entry['email']); ?></td>
                            <td><?php echo htmlspecialchars($entry['phone']); ?></td>
                            <td><?php echo $entry['week_number']; ?></td>
                            <td><?php echo date('d M Y', strtotime($entry['entry_date'])); ?></td>
                            <td>
                                <?php if ($entry['is_winner']): ?>
                                    <span class="badge badge-success">Winner</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td class="actions">
                                <?php if (!$entry['is_winner']): ?>
                                    <button onclick="markWinner(<?php echo $entry['id']; ?>)" class="btn-icon" title="Mark as Winner">
                                        <i class="fas fa-trophy"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script>
    function markWinner(id) {
        if (confirm('Mark this entry as winner?')) {
            fetch('../php/admin_mark_winner.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Winner marked successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }
    }
    </script>
</body>
</html>
<?php $conn->close(); ?>
