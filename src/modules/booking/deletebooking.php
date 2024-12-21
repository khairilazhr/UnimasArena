<?php
include '../../config/db-config.php';

// Get the booking ID from the URL parameters
$booking_id = $_GET['id'];

// Prepare the SQL statement
$sql = "DELETE FROM Booking WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();

if ($stmt->affected_rows === 1) {
    echo "Booking deleted successfully";
} else {
    echo "Error deleting booking";
}
?>
