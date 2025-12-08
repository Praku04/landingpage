let questions = [];
let currentQuestionIndex = 0;
let userAnswers = [];

// Start Quiz
document.getElementById('startQuizBtn')?.addEventListener('click', function() {
    document.querySelector('.quiz-intro-card').style.display = 'none';
    document.getElementById('quizContainer').style.display = 'block';
    loadQuiz();
});

// Load Quiz Questions
function loadQuiz() {
    fetch('../php/get_lucky_draw_quiz.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                questions = data.questions;
                userAnswers = new Array(questions.length).fill(null);
                showQuestion(0);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load quiz. Please try again.');
        });
}

// Show Question
function showQuestion(index) {
    currentQuestionIndex = index;
    const question = questions[index];
    
    document.getElementById('currentQuestion').textContent = index + 1;
    
    const html = `
        <div class="question-card">
            <h4 class="question-text">Q${index + 1}. ${question.question_text}</h4>
            <div class="options-list">
                <label class="option-item ${userAnswers[index] === 'A' ? 'selected' : ''}">
                    <input type="radio" name="question${index}" value="A" ${userAnswers[index] === 'A' ? 'checked' : ''}>
                    <span class="option-label">A</span>
                    <span class="option-text">${question.option_a}</span>
                </label>
                <label class="option-item ${userAnswers[index] === 'B' ? 'selected' : ''}">
                    <input type="radio" name="question${index}" value="B" ${userAnswers[index] === 'B' ? 'checked' : ''}>
                    <span class="option-label">B</span>
                    <span class="option-text">${question.option_b}</span>
                </label>
                <label class="option-item ${userAnswers[index] === 'C' ? 'selected' : ''}">
                    <input type="radio" name="question${index}" value="C" ${userAnswers[index] === 'C' ? 'checked' : ''}>
                    <span class="option-label">C</span>
                    <span class="option-text">${question.option_c}</span>
                </label>
                <label class="option-item ${userAnswers[index] === 'D' ? 'selected' : ''}">
                    <input type="radio" name="question${index}" value="D" ${userAnswers[index] === 'D' ? 'checked' : ''}>
                    <span class="option-label">D</span>
                    <span class="option-text">${question.option_d}</span>
                </label>
            </div>
        </div>
    `;
    
    document.getElementById('quizQuestions').innerHTML = html;
    
    // Add event listeners to options
    document.querySelectorAll(`input[name="question${index}"]`).forEach(input => {
        input.addEventListener('change', function() {
            userAnswers[index] = this.value;
            document.querySelectorAll('.option-item').forEach(item => item.classList.remove('selected'));
            this.closest('.option-item').classList.add('selected');
        });
    });
    
    // Update navigation buttons
    document.getElementById('prevBtn').style.display = index > 0 ? 'inline-block' : 'none';
    document.getElementById('nextBtn').style.display = index < questions.length - 1 ? 'inline-block' : 'none';
    document.getElementById('submitQuizBtn').style.display = index === questions.length - 1 ? 'inline-block' : 'none';
}

// Previous Button
document.getElementById('prevBtn')?.addEventListener('click', function() {
    if (currentQuestionIndex > 0) {
        showQuestion(currentQuestionIndex - 1);
    }
});

// Next Button
document.getElementById('nextBtn')?.addEventListener('click', function() {
    if (!userAnswers[currentQuestionIndex]) {
        alert('Please select an answer before proceeding.');
        return;
    }
    
    if (currentQuestionIndex < questions.length - 1) {
        showQuestion(currentQuestionIndex + 1);
    }
});

// Submit Quiz
document.getElementById('submitQuizBtn')?.addEventListener('click', function() {
    if (!userAnswers[currentQuestionIndex]) {
        alert('Please select an answer before submitting.');
        return;
    }
    
    // Check if all questions answered
    if (userAnswers.includes(null)) {
        alert('Please answer all questions before submitting.');
        return;
    }
    
    // Submit quiz
    fetch('../php/submit_lucky_draw_quiz.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ answers: userAnswers })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showResult(data);
        } else {
            alert(data.message || 'Failed to submit quiz');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});

// Show Result
function showResult(data) {
    document.getElementById('quizContainer').style.display = 'none';
    document.getElementById('quizResult').style.display = 'block';
    
    const passed = data.passed;
    const score = data.score;
    const total = data.total;
    
    document.getElementById('resultIcon').innerHTML = passed ? '🎉' : '😔';
    document.getElementById('resultTitle').textContent = passed ? 'Congratulations!' : 'Not Quite There';
    document.getElementById('resultScore').textContent = `${score} / ${total}`;
    document.getElementById('resultMessage').textContent = data.message;
    
    if (passed) {
        document.getElementById('enterDrawBtn').style.display = 'inline-block';
        document.getElementById('retryQuizBtn').style.display = 'none';
    } else {
        document.getElementById('enterDrawBtn').style.display = 'none';
        document.getElementById('retryQuizBtn').style.display = 'inline-block';
    }
}

// Enter Lucky Draw (After Passing Quiz)
document.getElementById('enterDrawBtn')?.addEventListener('click', function() {
    location.reload(); // Reload to show entry form
});

// Retry Quiz
document.getElementById('retryQuizBtn')?.addEventListener('click', function() {
    location.reload();
});

// Enter Lucky Draw Button (When Quiz Already Passed)
document.getElementById('enterLuckyDrawBtn')?.addEventListener('click', function() {
    if (confirm('Are you sure you want to enter this week\'s lucky draw?')) {
        fetch('../php/enter_lucky_draw.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Success! You have entered the lucky draw. Good luck!');
                location.reload();
            } else {
                alert(data.message || 'Failed to enter lucky draw');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
});
