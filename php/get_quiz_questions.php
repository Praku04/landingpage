<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

// Create new attempt
$sql = "INSERT INTO quiz_attempts (user_id, total_questions, status) VALUES (?, 20, 'in_progress')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$attempt_id = $conn->insert_id;

// Get 20 random questions
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d, cat_year 
        FROM quiz_questions 
        WHERE is_active = 1 
        ORDER BY RAND() 
        LIMIT 20";
$result = $conn->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode([
    'success' => true,
    'questions' => $questions,
    'attempt_id' => $attempt_id
]);
?>
