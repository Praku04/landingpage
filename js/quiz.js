// Quiz JavaScript with 30-minute timer

let questions = [];
let currentQuestionIndex = 0;
let userAnswers = [];
let timerInterval;
let timeRemaining = 1800; // 30 minutes in seconds
let startTime;
let attemptId;

async function startQuiz() {
    try {
        // Fetch questions
        const response = await fetch('../php/get_quiz_questions.php');
        const data = await response.json();
        
        if (!data.success) {
            alert('Failed to load questions');
            return;
        }
        
        questions = data.questions;
        attemptId = data.attempt_id;
        userAnswers = new Array(questions.length).fill(null);
        
        // Hide instructions, show quiz
        document.getElementById('quiz-instructions').style.display = 'none';
        document.getElementById('quiz-interface').style.display = 'block';
        
        // Start timer
        startTime = Date.now();
        startTimer();
        
        // Load first question
        loadQuestion();
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
}

function startTimer() {
    timerInterval = setInterval(() => {
        timeRemaining--;
        
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        document.getElementById('time-remaining').textContent = 
            `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            submitQuiz();
        }
    }, 1000);
}

function loadQuestion() {
    const question = questions[currentQuestionIndex];
    
    document.getElementById('current-question').textContent = currentQuestionIndex + 1;
    document.getElementById('total-questions').textContent = questions.length;
    document.getElementById('question-text').textContent = question.question_text;
    
    const optionsContainer = document.getElementById('options-container');
    optionsContainer.innerHTML = '';
    
    ['A', 'B', 'C', 'D'].forEach(option => {
        const btn = document.createElement('button');
        btn.className = 'option-btn';
        btn.textContent = `${option}. ${question['option_' + option.toLowerCase()]}`;
        btn.onclick = () => selectOption(option);
        
        if (userAnswers[currentQuestionIndex] === option) {
            btn.classList.add('selected');
        }
        
        optionsContainer.appendChild(btn);
    });
    
    // Update navigation buttons
    document.getElementById('prev-btn').disabled = currentQuestionIndex === 0;
    document.getElementById('next-btn').style.display = 
        currentQuestionIndex === questions.length - 1 ? 'none' : 'block';
    document.getElementById('submit-btn').style.display = 
        currentQuestionIndex === questions.length - 1 ? 'block' : 'none';
}

function selectOption(option) {
    userAnswers[currentQuestionIndex] = option;
    
    // Update UI
    document.querySelectorAll('.option-btn').forEach(btn => {
        btn.classList.remove('selected');
    });
    event.target.classList.add('selected');
}

function previousQuestion() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        loadQuestion();
    }
}

function nextQuestion() {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        loadQuestion();
    }
}

async function submitQuiz() {
    if (!confirm('Are you sure you want to submit? You cannot change your answers after submission.')) {
        return;
    }
    
    clearInterval(timerInterval);
    
    const timeTaken = Math.floor((Date.now() - startTime) / 1000);
    
    try {
        const response = await fetch('../php/submit_quiz.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                attempt_id: attemptId,
                answers: userAnswers,
                time_taken: timeTaken
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showResults(result);
        } else {
            alert('Failed to submit quiz');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while submitting');
    }
}

function showResults(result) {
    document.getElementById('quiz-interface').style.display = 'none';
    document.getElementById('quiz-results').style.display = 'block';
    
    const percentage = Math.round((result.score / result.total) * 100);
    
    document.getElementById('score-percentage').textContent = percentage;
    document.getElementById('score-text').textContent = `${result.score}/${result.total}`;
    document.getElementById('correct-answers').textContent = result.score;
    document.getElementById('wrong-answers').textContent = result.total - result.score;
    
    const minutes = Math.floor(result.time_taken / 60);
    const seconds = result.time_taken % 60;
    document.getElementById('time-taken').textContent = 
        `${minutes}:${seconds.toString().padStart(2, '0')}`;
}
