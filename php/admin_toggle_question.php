<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? 0;
$status = $data['status'] ?? 0;

$conn = getDBConnection();
$stmt = $conn->prepare("UPDATE quiz_questions SET is_active = ? WHERE id = ?");
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update status']);
}

$stmt->close();
$conn->close();
?>
