<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $action = $_POST['action'];

    // Prepare SQL statement based on action
    if ($action === 'approve') {
        $status = 'Approved';
    } elseif ($action === 'reject') {
        $status = 'Rejected';
    } else {
        // Invalid action
        exit('Invalid action');
    }

    // Update booking status in the database
    $stmt = $conn->prepare("UPDATE equipment_booking SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $booking_id);

    if ($stmt->execute()) {
        // Redirect back to the booking management page after update
        header("Location: admin_equipment_booking.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>