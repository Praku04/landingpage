<?php
session_start();
require_once '../php/config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$conn = getDBConnection();

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Filters
$year_filter = isset($_GET['year']) ? $_GET['year'] : '';
$difficulty_filter = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';
$topic_filter = isset($_GET['topic']) ? $_GET['topic'] : '';

$where = [];
if ($year_filter) $where[] = "year = '$year_filter'";
if ($difficulty_filter) $where[] = "difficulty = '$difficulty_filter'";
if ($topic_filter) $where[] = "topic = '$topic_filter'";
$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$total_query = "SELECT COUNT(*) as count FROM quiz_questions $where_clause";
$total_result = $conn->query($total_query);
$total_questions = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_questions / $per_page);

$query = "SELECT * FROM quiz_questions $where_clause ORDER BY created_at DESC LIMIT $per_page OFFSET $offset";
$questions = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions - TMG Admin</title>
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
    <link rel="stylesheet" href="../css/admin.css?v=3.0.5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-user-shield"></i> TMG Admin</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="questions.php" class="active"><i class="fas fa-question-circle"></i> Quiz Questions</a>
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
                <a href="bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
                <a href="lucky-draw.php"><i class="fas fa-gift"></i> Lucky Draw</a>
                <a href="../php/admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="content-header">
                <h1>Quiz Questions</h1>
                <button onclick="openAddModal()" class="btn-primary">
                    <i class="fas fa-plus"></i> Add Question
                </button>
            </div>
            
            <div class="filters">
                <form method="GET" class="filter-form">
                    <select name="year" onchange="this.form.submit()">
                        <option value="">All Years</option>
                        <option value="2023" <?php echo $year_filter == '2023' ? 'selected' : ''; ?>>2023</option>
                        <option value="2022" <?php echo $year_filter == '2022' ? 'selected' : ''; ?>>2022</option>
                        <option value="2021" <?php echo $year_filter == '2021' ? 'selected' : ''; ?>>2021</option>
                        <option value="2020" <?php echo $year_filter == '2020' ? 'selected' : ''; ?>>2020</option>
                        <option value="2019" <?php echo $year_filter == '2019' ? 'selected' : ''; ?>>2019</option>
                    </select>
                    
                    <select name="difficulty" onchange="this.form.submit()">
                        <option value="">All Difficulties</option>
                        <option value="Easy" <?php echo $difficulty_filter == 'Easy' ? 'selected' : ''; ?>>Easy</option>
                        <option value="Medium" <?php echo $difficulty_filter == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="Hard" <?php echo $difficulty_filter == 'Hard' ? 'selected' : ''; ?>>Hard</option>
                    </select>
                    
                    <select name="topic" onchange="this.form.submit()">
                        <option value="">All Topics</option>
                        <option value="Quantitative" <?php echo $topic_filter == 'Quantitative' ? 'selected' : ''; ?>>Quantitative</option>
                        <option value="Verbal" <?php echo $topic_filter == 'Verbal' ? 'selected' : ''; ?>>Verbal</option>
                        <option value="Logical" <?php echo $topic_filter == 'Logical' ? 'selected' : ''; ?>>Logical</option>
                        <option value="Data Interpretation" <?php echo $topic_filter == 'Data Interpretation' ? 'selected' : ''; ?>>Data Interpretation</option>
                    </select>
                    
                    <?php if ($year_filter || $difficulty_filter || $topic_filter): ?>
                        <a href="questions.php" class="btn-secondary">Clear Filters</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Topic</th>
                            <th>Year</th>
                            <th>Difficulty</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($q = $questions->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $q['id']; ?></td>
                            <td class="question-text"><?php echo substr(htmlspecialchars($q['question_text']), 0, 80) . '...'; ?></td>
                            <td><span class="badge badge-info"><?php echo $q['topic']; ?></span></td>
                            <td><?php echo $q['year']; ?></td>
                            <td><span class="badge badge-<?php echo strtolower($q['difficulty']); ?>"><?php echo $q['difficulty']; ?></span></td>
                            <td>
                                <span class="badge badge-<?php echo $q['is_active'] ? 'success' : 'danger'; ?>">
                                    <?php echo $q['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td class="actions">
                                <button onclick="viewQuestion(<?php echo $q['id']; ?>)" class="btn-icon" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editQuestion(<?php echo $q['id']; ?>)" class="btn-icon" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="toggleStatus(<?php echo $q['id']; ?>, <?php echo $q['is_active']; ?>)" class="btn-icon" title="Toggle Status">
                                    <i class="fas fa-toggle-<?php echo $q['is_active'] ? 'on' : 'off'; ?>"></i>
                                </button>
                                <button onclick="deleteQuestion(<?php echo $q['id']; ?>)" class="btn-icon btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&year=<?php echo $year_filter; ?>&difficulty=<?php echo $difficulty_filter; ?>&topic=<?php echo $topic_filter; ?>" 
                       class="<?php echo $page == $i ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </main>
    </div>
    
    <!-- Add/Edit Modal -->
    <div id="questionModal" class="modal">
        <div class="modal-content modal-large">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Add Question</h2>
            <form id="questionForm">
                <input type="hidden" id="questionId" name="id">
                
                <div class="form-group">
                    <label>Question Text *</label>
                    <textarea id="questionText" name="question_text" rows="4" required></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Option A *</label>
                        <input type="text" id="optionA" name="option_a" required>
                    </div>
                    <div class="form-group">
                        <label>Option B *</label>
                        <input type="text" id="optionB" name="option_b" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Option C *</label>
                        <input type="text" id="optionC" name="option_c" required>
                    </div>
                    <div class="form-group">
                        <label>Option D *</label>
                        <input type="text" id="optionD" name="option_d" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Correct Answer *</label>
                        <select id="correctAnswer" name="correct_answer" required>
                            <option value="">Select</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Topic *</label>
                        <select id="topic" name="topic" required>
                            <option value="">Select</option>
                            <option value="Quantitative">Quantitative</option>
                            <option value="Verbal">Verbal</option>
                            <option value="Logical">Logical</option>
                            <option value="Data Interpretation">Data Interpretation</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Year *</label>
                        <select id="year" name="year" required>
                            <option value="">Select</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Difficulty *</label>
                        <select id="difficulty" name="difficulty" required>
                            <option value="">Select</option>
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="isActive" name="is_active" checked>
                        Active
                    </label>
                </div>
                
                <div class="form-actions">
                    <button type="button" onclick="closeModal()" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Save Question</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../js/admin-questions.js?v=3.0.5"></script>
</body>
</html>
<?php $conn->close(); ?>
