<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$answers = $data['answers'] ?? [];

if (count($answers) !== 5) {
    echo json_encode(['success' => false, 'message' => 'Please answer all questions']);
    exit;
}

$conn = getDBConnection();

// Get correct answers
$sql = "SELECT id, correct_answer FROM lucky_draw_quiz_questions WHERE is_active = 1 ORDER BY id LIMIT 5";
$result = $conn->query($sql);

$score = 0;
$index = 0;
while ($row = $result->fetch_assoc()) {
    if (isset($answers[$index]) && $answers[$index] === $row['correct_answer']) {
        $score++;
    }
    $index++;
}

// Save attempt
$user_id = $_SESSION['user_id'];
$passed = ($score >= 3); // Need 3 out of 5 to pass

$sql = "INSERT INTO lucky_draw_quiz_attempts (user_id, score, total_questions, passed) VALUES (?, ?, 5, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $score, $passed);
$stmt->execute();

echo json_encode([
    'success' => true,
    'score' => $score,
    'total' => 5,
    'passed' => $passed,
    'message' => $passed ? 'Congratulations! You can now enter the lucky draw.' : 'You need at least 3 correct answers to enter the lucky draw. Please try again.'
]);

$conn->close();
?>
