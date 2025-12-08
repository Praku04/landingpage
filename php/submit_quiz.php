<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$attempt_id = $data['attempt_id'];
$answers = $data['answers'];
$time_taken = $data['time_taken'];

// Get questions for this attempt
$sql = "SELECT qa.id as attempt_id FROM quiz_attempts qa WHERE qa.id = ? AND qa.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $attempt_id, $_SESSION['user_id']);
$stmt->execute();
if ($stmt->get_result()->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid attempt']);
    exit;
}

// Get all questions used (we'll fetch them again)
$sql = "SELECT id, correct_answer FROM quiz_questions ORDER BY RAND() LIMIT 20";
$result = $conn->query($sql);
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

// Calculate score
$score = 0;
foreach ($answers as $index => $answer) {
    if ($answer && isset($questions[$index])) {
        $question_id = $questions[$index]['id'];
        $correct_answer = $questions[$index]['correct_answer'];
        $is_correct = ($answer === $correct_answer) ? 1 : 0;
        
        if ($is_correct) {
            $score++;
        }
        
        // Save answer
        $sql = "INSERT INTO quiz_answers (attempt_id, question_id, user_answer, is_correct) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisi", $attempt_id, $question_id, $answer, $is_correct);
        $stmt->execute();
    }
}

// Update attempt
$sql = "UPDATE quiz_attempts SET score = ?, time_taken = ?, status = 'completed', end_time = NOW() WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $score, $time_taken, $attempt_id);
$stmt->execute();

// Calculate percentage
$percentage = round(($score / 20) * 100, 2);

// Send result email
require_once 'email_config.php';
$user = getUserById($_SESSION['user_id']);
sendQuizResultEmail($user['email'], $user['name'], $score, 20, $percentage);

echo json_encode([
    'success' => true,
    'score' => $score,
    'total' => 20,
    'time_taken' => $time_taken
]);
?>
