function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Question';
    document.getElementById('questionForm').reset();
    document.getElementById('questionId').value = '';
    document.getElementById('questionModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('questionModal').style.display = 'none';
}

function viewQuestion(id) {
    fetch(`../php/admin_get_question.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const q = data.question;
                alert(`Question: ${q.question_text}\n\nA) ${q.option_a}\nB) ${q.option_b}\nC) ${q.option_c}\nD) ${q.option_d}\n\nCorrect: ${q.correct_answer}\nTopic: ${q.topic}\nYear: ${q.year}\nDifficulty: ${q.difficulty}`);
            }
        });
}

function editQuestion(id) {
    fetch(`../php/admin_get_question.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const q = data.question;
                document.getElementById('modalTitle').textContent = 'Edit Question';
                document.getElementById('questionId').value = q.id;
                document.getElementById('questionText').value = q.question_text;
                document.getElementById('optionA').value = q.option_a;
                document.getElementById('optionB').value = q.option_b;
                document.getElementById('optionC').value = q.option_c;
                document.getElementById('optionD').value = q.option_d;
                document.getElementById('correctAnswer').value = q.correct_answer;
                document.getElementById('topic').value = q.topic;
                document.getElementById('year').value = q.year;
                document.getElementById('difficulty').value = q.difficulty;
                document.getElementById('isActive').checked = q.is_active == 1;
                document.getElementById('questionModal').style.display = 'block';
            }
        });
}

function toggleStatus(id, currentStatus) {
    if (confirm(`Are you sure you want to ${currentStatus ? 'deactivate' : 'activate'} this question?`)) {
        fetch('../php/admin_toggle_question.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, status: currentStatus ? 0 : 1 })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

function deleteQuestion(id) {
    if (confirm('Are you sure you want to delete this question? This action cannot be undone.')) {
        fetch('../php/admin_delete_question.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

document.getElementById('questionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {
        id: formData.get('id'),
        question_text: formData.get('question_text'),
        option_a: formData.get('option_a'),
        option_b: formData.get('option_b'),
        option_c: formData.get('option_c'),
        option_d: formData.get('option_d'),
        correct_answer: formData.get('correct_answer'),
        topic: formData.get('topic'),
        year: formData.get('year'),
        difficulty: formData.get('difficulty'),
        is_active: document.getElementById('isActive').checked ? 1 : 0
    };
    
    fetch('../php/admin_save_question.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Question saved successfully!');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
});

window.onclick = function(event) {
    const modal = document.getElementById('questionModal');
    if (event.target == modal) {
        closeModal();
    }
}
