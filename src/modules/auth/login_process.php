<?php
include '../../config/db-config.php';

// Retrieve form data
$user_email = $_POST['user_email'];
$password = $_POST['password'];

// Prepare SQL statement with placeholders to prevent SQL injection
$sql = "SELECT * FROM User WHERE user_email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_email, $password);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Check if a matching user was found
if ($result->num_rows > 0) {
    // Successful login
    $_SESSION['user_email'] = $user_email; // Store user information in session
    if ($user_email == "Admin@Arena") {
        header("Location: /UnimasArena/src/modules/admin/adminHomepage.php");
    } else {
        header("Location: /UnimasArena/src/modules/user/UserHome.php");
    }
    exit;
} else {
    // Failed login
    $_SESSION['error'] = "Invalid email or password.";
    header("Location: /UnimasArena/src/Login.php"); // Redirect back to the login page
    exit;
}

$stmt->close();
$conn->close();

?>