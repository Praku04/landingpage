<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get form data
$name = sanitize_input($_POST['name']);
$email = sanitize_input($_POST['email']);
$phone = sanitize_input($_POST['phone']);
$location = sanitize_input($_POST['location']);
$father_name = sanitize_input($_POST['father_name'] ?? '');
$father_phone = sanitize_input($_POST['father_phone'] ?? '');
$current_education = sanitize_input($_POST['current_education']);
$password = $_POST['password'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

// Check if email already exists
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already registered']);
    exit;
}

// Handle resume upload
$resume_path = null;
if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/resumes/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
    if (strtolower($file_extension) !== 'pdf') {
        echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed']);
        exit;
    }
    
    if ($_FILES['resume']['size'] > 2097152) { // 2MB
        echo json_encode(['success' => false, 'message' => 'File size must be less than 2MB']);
        exit;
    }
    
    $resume_filename = uniqid() . '_' . basename($_FILES['resume']['name']);
    $resume_path = $upload_dir . $resume_filename;
    
    if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload resume']);
        exit;
    }
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users (name, email, phone, password, father_name, father_phone, location, current_education, resume_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $name, $email, $phone, $hashed_password, $father_name, $father_phone, $location, $current_education, $resume_path);

if ($stmt->execute()) {
    // Send welcome email
    require_once 'email_config.php';
    sendWelcomeEmail($email, $name);
    
    echo json_encode(['success' => true, 'message' => 'Registration successful! Please login.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again.']);
}
?>
