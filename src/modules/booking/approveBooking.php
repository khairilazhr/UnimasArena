<?php
include '../../config/db-config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$id = $_GET['id'];

// Select the booking data
$sql = "SELECT booking_date, booking_period, court, matric_number, contact_number, name, user_email FROM Booking WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Update the status in the Booking table
$sql = "UPDATE Booking SET status = 'Approved' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

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
    $mail->addAddress($row['user_email'], $row['name']);     
    $mail->Subject = '[DO NOT REPLY]Booking Approved';
    $mail->Body    = 'Dear ' . $row['name'] . ', Your booking on ' . $row['booking_date'] . ' for period ' . $row['booking_period'] . ' at court ' . $row['court'] . ' has been approved. Thank you.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
