<?php
require_once 'config.php';
require_once 'email_config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$location = trim($data['location'] ?? '');
$fatherName = trim($data['father_name'] ?? '');
$fatherPhone = trim($data['father_phone'] ?? '');
$query = trim($data['query'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($phone) || empty($query)) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Save to database
$conn = getDBConnection();
$stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, phone, location, father_name, father_phone, query, submitted_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssssss", $name, $email, $phone, $location, $fatherName, $fatherPhone, $query);

if ($stmt->execute()) {
    // Send email to admin
    sendContactFormToAdmin($name, $email, $phone, $location, $fatherName, $fatherPhone, $query);
    
    echo json_encode(['success' => true, 'message' => 'Thank you! We will contact you soon.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit form. Please try again.']);
}

$stmt->close();
$conn->close();
?>
