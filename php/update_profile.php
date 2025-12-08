<?php
require_once 'config.php';
require_login();

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$name = sanitize_input($_POST['name']);
$phone = sanitize_input($_POST['phone']);
$location = sanitize_input($_POST['location']);
$father_name = sanitize_input($_POST['father_name'] ?? '');
$father_phone = sanitize_input($_POST['father_phone'] ?? '');
$current_education = sanitize_input($_POST['current_education']);

// Handle resume upload
$resume_path = null;
if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/resumes/';
    
    $file_extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
    if (strtolower($file_extension) !== 'pdf') {
        echo json_encode(['success' => false, 'message' => 'Only PDF files are allowed']);
        exit;
    }
    
    if ($_FILES['resume']['size'] > 2097152) {
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

// Update user
if ($resume_path) {
    $sql = "UPDATE users SET name = ?, phone = ?, location = ?, father_name = ?, father_phone = ?, current_education = ?, resume_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $name, $phone, $location, $father_name, $father_phone, $current_education, $resume_path, $user_id);
} else {
    $sql = "UPDATE users SET name = ?, phone = ?, location = ?, father_name = ?, father_phone = ?, current_education = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $phone, $location, $father_name, $father_phone, $current_education, $user_id);
}

if ($stmt->execute()) {
    $_SESSION['user_name'] = $name;
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
}
?>
