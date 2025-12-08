<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$conn = getDBConnection();

// Get all 5 questions
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d FROM lucky_draw_quiz_questions WHERE is_active = 1 ORDER BY id LIMIT 5";
$result = $conn->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode(['success' => true, 'questions' => $questions]);

$conn->close();
?>
