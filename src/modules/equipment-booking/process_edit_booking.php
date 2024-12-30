<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the form
    $booking_id = $_POST['booking_id'];
    $racket = $_POST['racket'];
    $booking_date = $_POST['date'];
    $booking_period = $_POST['period'];
    $court = $_POST['court'];
    $contact_number = $_POST['contact_number'];

    // Prepare SQL statement to update the booking
    $stmt = $conn->prepare("UPDATE equipment_booking SET racket = ?, booking_date = ?, booking_period = ?, court = ?, contact_number = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $racket, $booking_date, $booking_period, $court, $contact_number, $booking_id);

    if ($stmt->execute()) {
        // Redirect back to the review booking page with a success message and booking ID
        header("Location: review_booking.php?message=Booking updated successfully.&booking_id=" . $booking_id);
        exit();
    } else {
        echo "Error updating booking: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>