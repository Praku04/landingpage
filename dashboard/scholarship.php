<?php
require_once '../php/config.php';
require_login();

$user = get_current_user();

// Check if user has already attempted
$sql = "SELECT * FROM quiz_attempts WHERE user_id = ? AND status = 'completed' ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$last_attempt = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Quiz - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/quiz.css?v=3.0.5">
</head>
<body>
    <div class="quiz-container">
        <?php if (!$last_attempt): ?>
        <!-- Quiz Instructions -->
        <div id="quiz-instructions" class="quiz-card">
            <h1>🎓 Scholarship Quiz</h1>
            <div class="quiz-info">
                <div class="info-item">
                    <strong>Questions:</strong> 20
                </div>
                <div class="info-item">
                    <strong>Time Limit:</strong> 30 minutes
                </div>
                <div class="info-item">
                    <strong>Source:</strong> CAT Exams (Last 5 Years)
                </div>
            </div>
            
            <div class="instructions">
                <h3>Instructions:</h3>
                <ul>
                    <li>You have 30 minutes to complete 20 questions</li>
                    <li>Each question has 4 options, only one is correct</li>
                    <li>You cannot pause or restart the quiz once started</li>
                    <li>Your score will be calculated automatically</li>
                    <li>You can attempt the quiz only once</li>
                </ul>
            </div>
            
            <button onclick="startQuiz()" class="btn-quiz-start">Start Quiz</button>
            <a href="index.php" class="btn-back">Back to Dashboard</a>
        </div>
        
        <!-- Quiz Interface -->
        <div id="quiz-interface" style="display: none;">
            <div class="quiz-header">
                <div class="quiz-progress">
                    <span id="current-question">1</span> / <span id="total-questions">20</span>
                </div>
                <div class="quiz-timer" id="timer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span id="time-remaining">30:00</span>
                </div>
            </div>
            
            <div class="quiz-content">
                <div class="question-card">
                    <h2 id="question-text"></h2>
                    <div class="options-container" id="options-container"></div>
                </div>
                
                <div class="quiz-navigation">
                    <button onclick="previousQuestion()" id="prev-btn" class="btn-nav" disabled>Previous</button>
                    <button onclick="nextQuestion()" id="next-btn" class="btn-nav">Next</button>
                    <button onclick="submitQuiz()" id="submit-btn" class="btn-submit-quiz" style="display: none;">Submit Quiz</button>
                </div>
            </div>
        </div>
        
        <!-- Results -->
        <div id="quiz-results" style="display: none;">
            <div class="results-card">
                <div class="results-icon">🎉</div>
                <h1>Quiz Completed!</h1>
                <div class="score-display">
                    <div class="score-circle">
                        <span id="score-percentage">0</span>%
                    </div>
                    <p>You scored <strong id="score-text">0/20</strong></p>
                </div>
                <div class="results-details">
                    <div class="detail-item">
                        <span>Time Taken:</span>
                        <strong id="time-taken">0:00</strong>
                    </div>
                    <div class="detail-item">
                        <span>Correct Answers:</span>
                        <strong id="correct-answers">0</strong>
                    </div>
                    <div class="detail-item">
                        <span>Wrong Answers:</span>
                        <strong id="wrong-answers">0</strong>
                    </div>
                </div>
                <a href="index.php" class="btn-quiz-start">Back to Dashboard</a>
            </div>
        </div>
        
        <?php else: ?>
        <!-- Already Attempted -->
        <div class="quiz-card">
            <h1>Quiz Already Completed</h1>
            <div class="score-display">
                <div class="score-circle">
                    <span><?php echo round(($last_attempt['score'] / $last_attempt['total_questions']) * 100); ?></span>%
                </div>
                <p>You scored <strong><?php echo $last_attempt['score']; ?>/<?php echo $last_attempt['total_questions']; ?></strong></p>
            </div>
            <p>You have already completed the scholarship quiz. You can only attempt it once.</p>
            <a href="index.php" class="btn-quiz-start">Back to Dashboard</a>
        </div>
        <?php endif; ?>
    </div>
    
    <script src="../js/quiz.js?v=3.0.5"></script>
</body>
</html>
