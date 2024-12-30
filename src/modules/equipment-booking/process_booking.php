<?php
// Include database configuration
include '../../config/db-config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the form
    $racket = $_POST['racket'];
    $booking_date = $_POST['date'];
    $booking_period = $_POST['period'];
    $court = $_POST['court'];
    $name = $_POST['name'];
    $matric_number = $_POST['matric_number'];
    $contact_number = $_POST['contact_number'];
    $user_id = $_POST['user_id'];
    $user_email = $_POST['user_email'];
    $status = $_POST['status'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO equipment_booking (racket, booking_date, booking_period, court, name, matric_number, contact_number, user_id, user_email, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssssss", $racket, $booking_date, $booking_period, $court, $name, $matric_number, $contact_number, $user_id, $user_email, $status);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the last inserted ID
        $booking_id = $stmt->insert_id;

        // Redirect to review_booking.php with a success message and booking ID
        header("Location: review_booking.php?message=Booking successfully created.&booking_id=" . $booking_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>