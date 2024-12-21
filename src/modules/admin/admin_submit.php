<?php
include '../../config/db-config.php';

$booking_date = $_POST['date'];
$booking_period = $_POST['period'];
$court = $_POST['court'];
$name = $_POST['name'];
$matric_number = $_POST['matric_number'];
$contact_number = $_POST['contact_number'];
$user_email = $_POST['user_email'];
$status = $_POST['status'];

// Check for duplicate entry
$check_duplicate = "SELECT * FROM Booking WHERE booking_date = ? AND booking_period = ? AND court = ?";
$stmt = $conn->prepare($check_duplicate);
$stmt->bind_param("sss", $booking_date, $booking_period, $court);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script>alert('The slot is already booked!'); window.location='adminAdd.php';</script>";
} else {
    $sql = "INSERT INTO Booking (booking_date, booking_period, court, name, matric_number, contact_number, user_email, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $booking_date, $booking_period, $court, $name, $matric_number, $contact_number, $user_email, $status);
    print_r($_POST);
    try {
        $stmt->execute();

        // Store data in session
        $_SESSION['booking_date'] = $booking_date;
        $_SESSION['booking_period'] = $booking_period;
        $_SESSION['court'] = $court;
        $_SESSION['matric_number'] = $matric_number;
        $_SESSION['contact_number'] = $contact_number;

        header('Location: b-successAdmin.php'); 
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
?>