<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'] ?? null;
$question_text = trim($data['question_text'] ?? '');
$option_a = trim($data['option_a'] ?? '');
$option_b = trim($data['option_b'] ?? '');
$option_c = trim($data['option_c'] ?? '');
$option_d = trim($data['option_d'] ?? '');
$correct_answer = $data['correct_answer'] ?? '';
$topic = $data['topic'] ?? '';
$year = $data['year'] ?? '';
$difficulty = $data['difficulty'] ?? '';
$is_active = $data['is_active'] ?? 1;

if (empty($question_text) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer) || empty($topic) || empty($year) || empty($difficulty)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

$conn = getDBConnection();

if ($id) {
    $stmt = $conn->prepare("UPDATE quiz_questions SET question_text=?, option_a=?, option_b=?, option_c=?, option_d=?, correct_answer=?, topic=?, year=?, difficulty=?, is_active=? WHERE id=?");
    $stmt->bind_param("sssssssssii", $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $topic, $year, $difficulty, $is_active, $id);
} else {
    $stmt = $conn->prepare("INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_answer, topic, year, difficulty, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssi", $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $topic, $year, $difficulty, $is_active);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Question saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save question']);
}

$stmt->close();
$conn->close();
?>
