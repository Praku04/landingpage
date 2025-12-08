<?php
require_once '../php/config.php';
require_login();

$user = get_current_user();

// Get current week number
$week_number = date('W');
$year = date('Y');

// Check if already entered this week
$sql = "SELECT * FROM lucky_draw_entries WHERE user_id = ? AND week_number = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user['id'], $week_number, $year);
$stmt->execute();
$existing_entry = $stmt->get_result()->fetch_assoc();

// Count entries this week
$sql = "SELECT COUNT(*) as count FROM lucky_draw_entries WHERE week_number = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $week_number, $year);
$stmt->execute();
$count_result = $stmt->get_result()->fetch_assoc();
$entries_count = $count_result['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Draw - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
    <link rel="stylesheet" href="../css/lucky-draw.css?v=3.0.5">
</head>
<body>
    <div class="lucky-draw-container">
        <div class="lucky-draw-card">
            <div class="lucky-draw-header">
                <div class="header-icon">🎁</div>
                <h1>Weekly Lucky Draw</h1>
                <p>First 100 entries every week!</p>
            </div>
            
            <?php if ($existing_entry): ?>
                <!-- Already Entered -->
                <div class="entry-status success">
                    <div class="status-icon">✓</div>
                    <h2>You're In!</h2>
                    <p>You have successfully entered this week's lucky draw.</p>
                    <div class="entry-details">
                        <div class="detail-row">
                            <span>Entry Number:</span>
                            <strong>#<?php echo $existing_entry['id']; ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Entry Date:</span>
                            <strong><?php echo date('M d, Y', strtotime($existing_entry['entry_date'])); ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Week:</span>
                            <strong>Week <?php echo $week_number; ?>, <?php echo $year; ?></strong>
                        </div>
                        <?php if ($existing_entry['is_winner']): ?>
                        <div class="winner-badge">
                            🎉 Congratulations! You're a Winner!
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($entries_count >= 100): ?>
                <!-- Limit Reached -->
                <div class="entry-status warning">
                    <div class="status-icon">⚠️</div>
                    <h2>Entries Full</h2>
                    <p>This week's lucky draw has reached the maximum of 100 entries.</p>
                    <p>Try again next week!</p>
                </div>
            <?php else: ?>
                <!-- Entry Form -->
                <div class="entry-info">
                    <h3>🎯 What You Can Win:</h3>
                    <ul class="prizes-list">
                        <li>✓ TMG expert counselling at best discounted rates</li>
                        <li>✓ College fee discounts for MBA/Diploma in Top 5 TMG colleges</li>
                        <li>✓ Internship opportunities in top 10 TMG listed companies</li>
                    </ul>
                </div>
                
                <div class="entries-counter">
                    <span class="counter-label">Entries This Week:</span>
                    <span class="counter-value"><?php echo $entries_count; ?> / 100</span>
                </div>
                
                <form id="luckyDrawForm" class="entry-form">
                    <div class="form-message"></div>
                    <button type="submit" class="btn-enter-draw">
                        Enter Lucky Draw Now
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            <?php endif; ?>
            
            <a href="index.php" class="btn-back-dash">← Back to Dashboard</a>
        </div>
    </div>
    
    <script src="../js/lucky-draw.js?v=3.0.5"></script>
</body>
</html>
