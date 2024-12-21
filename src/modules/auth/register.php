<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UnimasArena";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Your booking insertion code...
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$user_email = $_POST['user_email'];
$password = $_POST['password'];

$sql = "INSERT INTO user (fname, lname, user_email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fname, $lname, $user_email, $password);

try {
    $stmt->execute();
    header('Location: Login.php'); 
} catch (mysqli_sql_exception $exception) {
    if ($exception->getCode() == 1062) { // Code for 'Duplicate entry'
        $_SESSION['error'] = 'Email already taken'; // Set the error message
        header('Location: AddBooking.php'); // Redirect back to AddBooking.php
    } else {
        throw $exception; // If it's another exception, rethrow it
    }
}

?>