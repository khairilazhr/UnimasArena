<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UnimasArena";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fb1 = $_POST['fb1'];
    $fb2 = $_POST['fb2'];
    $fb3 = $_POST['fb3'];
    $fb4 = $_POST['fb4'];

    // Create a prepared statement
    $stmt = $conn->prepare("INSERT INTO feedback (fb1, fb2, fb3, fb4) VALUES (?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssss", $fb1, $fb2, $fb3, $fb4);

    // Execute the prepared statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    header("Location:AddFeedback.php ");
    exit;
}
?>
