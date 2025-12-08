<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$id = $_GET['id'] ?? 0;

$conn = getDBConnection();
$stmt = $conn->prepare("SELECT * FROM quiz_questions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Question not found']);
    exit;
}

$question = $result->fetch_assoc();
echo json_encode(['success' => true, 'question' => $question]);

$stmt->close();
$conn->close();
?>
