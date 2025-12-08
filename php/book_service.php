<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$service_type = sanitize_input($_POST['service_type']);
$preferred_date = sanitize_input($_POST['preferred_date']);
$preferred_time = sanitize_input($_POST['preferred_time']);
$notes = sanitize_input($_POST['notes'] ?? '');

// Validate service type
$valid_services = ['mock_interview', 'career_counselling', 'placement_support'];
if (!in_array($service_type, $valid_services)) {
    echo json_encode(['success' => false, 'message' => 'Invalid service type']);
    exit;
}

// Insert booking
$sql = "INSERT INTO service_bookings (user_id, service_type, preferred_date, preferred_time, notes, status) 
        VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $service_type, $preferred_date, $preferred_time, $notes);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Service booked successfully! We will contact you soon.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to book service. Please try again.']);
}
?>
