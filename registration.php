<?php

require_once('db.php');

$message = "";

// Enable error reporting for debugging (optional)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Get form data with validation
    $studentID = trim($_POST['student_id'] ?? '');
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phoneNumber = trim($_POST['phone_number'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $password = trim($_POST['password']) ?? '';

    // Validate required fields
    if (empty($studentID) || empty($fullName) || empty($email) || empty($phoneNumber) || empty($gender) || empty($course) || empty($password)) {
        throw new Exception("All fields are required!");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format.");
    }

    // Hash the password for security
    //$hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (student_id, full_name, email, phone_number, gender, course, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $studentID, $fullName, $email, $phoneNumber, $gender, $course, $password);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        throw new Exception("Error: " . $stmt->error);
    }
    
    // Close statement
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close connection
    $stmt->close();
    $conn->close();
}
?>