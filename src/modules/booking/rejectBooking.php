<?php
include '../../config/db-config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Get the booking ID from the URL parameters
$booking_id = $_GET['id'];
$remark = $_GET['remark'];

// First, get the booking details
$sql = "SELECT id, booking_date, booking_period, court, matric_number, contact_number, name, status, user_email FROM Booking WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if ($booking) {
    // Insert the booking into the rejectBooking table
    $sql = "INSERT INTO rejectBooking (rej_id, rej_booking_date, rej_booking_period, rej_court, rej_matric_number, rej_contact_number, rej_name, rej_status, user_email, remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $status = 'Rejected';
    $stmt->bind_param("isssssssss", $booking['id'], $booking['booking_date'], $booking['booking_period'], $booking['court'], $booking['matric_number'], $booking['contact_number'], $booking['name'], $status, $booking['user_email'], $remark);

    if ($stmt->execute()) {
        // Delete the booking from the Booking table
        $sql = "DELETE FROM Booking WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            // Send email to the user
            $mail = new PHPMailer(true);
            try {
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 2;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Username = 'a.arenaunimas@gmail.com';
                $mail->Password = 'nvexioffsvkhjbcn';
                $mail->setFrom('a.arenaunimas@gmail.com', 'Admin Arena');
                $mail->addAddress($booking['user_email'], $booking['name']);                                
                $mail->Subject = 'Booking Rejected';
                $mail->Body    = 'Dear ' . $booking['name'] . ', Your booking on ' . $booking['booking_date'] . ' for period ' . $booking['booking_period'] . ' at court ' . $booking['court'] . ' has been rejected.  Remark: ' . $remark . '  Thank you.';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            echo "Error deleting booking from Booking table";
        }
    } else {
        echo "Error inserting into rejectBooking table";
    }
} else {
    echo "Booking not found";
}
?>
