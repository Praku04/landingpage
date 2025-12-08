<?php
session_start();
require_once '../php/config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$conn = getDBConnection();
$bookings = $conn->query("SELECT sb.*, u.name, u.email, u.phone FROM service_bookings sb JOIN users u ON sb.user_id = u.id ORDER BY sb.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - TMG Admin</title>
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
                <a href="bookings.php" class="active"><i class="fas fa-calendar-check"></i> Bookings</a>
                <a href="lucky-draw.php"><i class="fas fa-gift"></i> Lucky Draw</a>
                <a href="../php/admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="content-header">
                <h1>Service Bookings</h1>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($booking = $bookings->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td>
                                <?php echo htmlspecialchars($booking['name']); ?><br>
                                <small><?php echo htmlspecialchars($booking['email']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($booking['service_type']); ?></td>
                            <td><?php echo date('d M Y', strtotime($booking['preferred_date'])); ?></td>
                            <td><?php echo htmlspecialchars($booking['preferred_time']); ?></td>
                            <td><span class="badge badge-<?php echo $booking['status']; ?>"><?php echo ucfirst($booking['status']); ?></span></td>
                            <td class="actions">
                                <select onchange="updateStatus(<?php echo $booking['id']; ?>, this.value)">
                                    <option value="">Change Status</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script>
    function updateStatus(id, status) {
        if (!status) return;
        if (confirm('Update booking status to ' + status + '?')) {
            fetch('../php/admin_update_booking.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, status })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
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
