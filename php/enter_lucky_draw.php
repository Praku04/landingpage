<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$week_number = date('W');
$year = date('Y');

// Check if already entered
$sql = "SELECT id FROM lucky_draw_entries WHERE user_id = ? AND week_number = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $week_number, $year);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'You have already entered this week']);
    exit;
}

// Check if limit reached
$sql = "SELECT COUNT(*) as count FROM lucky_draw_entries WHERE week_number = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $week_number, $year);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result['count'] >= 100) {
    echo json_encode(['success' => false, 'message' => 'This week\'s entries are full']);
    exit;
}

// Enter user
$sql = "INSERT INTO lucky_draw_entries (user_id, week_number, year) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $week_number, $year);

if ($stmt->execute()) {
    $entry_id = $conn->insert_id;
    
    // Get entry number
    $sql = "SELECT entry_number FROM lucky_draw_entries WHERE id = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $entry_id);
    $stmt2->execute();
    $entry_data = $stmt2->get_result()->fetch_assoc();
    $entry_number = $entry_data['entry_number'];
    
    // Send confirmation email
    require_once 'email_config.php';
    $user = getUserById($_SESSION['user_id']);
    sendLuckyDrawConfirmation($user['email'], $user['name'], $entry_number, $week_number);
    
    echo json_encode(['success' => true, 'message' => 'Successfully entered! Good luck!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to enter. Please try again.']);
}
?>
