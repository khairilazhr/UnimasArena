<?php
include '../../config/db-config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$booking_date = $_POST['date'];
$booking_period = $_POST['period'];
$court = $_POST['court'];
$name = $_POST['name'];
$matric_number = $_POST['matric_number'];
$contact_number = $_POST['contact_number'];
$user_id = $_POST['user_id'];
$status = $_POST['status'];
$user_email = $_POST['user_email'];

// Check for duplicate entry
$check_duplicate = "SELECT * FROM Booking WHERE booking_date = ? AND booking_period = ? AND court = ?";
$stmt = $conn->prepare($check_duplicate);
$stmt->bind_param("sss", $booking_date, $booking_period, $court);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script>alert('The slot is already booked!'); window.location='/UnimasArena/src/modules/booking/AddBooking.php';</script>";
} else {
    $sql = "INSERT INTO Booking (booking_date, booking_period, court, name, matric_number, contact_number, user_id, user_email, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssiss", $booking_date, $booking_period, $court, $name, $matric_number, $contact_number, $user_id, $user_email, $status);
    print_r($_POST);
    try {
        $stmt->execute();

        // Store data in session
        $_SESSION['booking_date'] = $booking_date;
        $_SESSION['booking_period'] = $booking_period;
        $_SESSION['court'] = $court;
        $_SESSION['matric_number'] = $matric_number;
        $_SESSION['contact_number'] = $contact_number;

        // Create a new PHPMailer instance
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
        $mail->addAddress($user_email, $name);
        $mail->Subject = '[DO NOT REPLY] Booking Confirmation';
        $mail->Body = "Your booking has been confirmed. Please wait approval from admin. Here are the details:\n".
                      "Booking Date: ".$_SESSION['booking_date']."\n".
                      "Booking Period: ".$_SESSION['booking_period']."\n".
                      "Court: ".$_SESSION['court']."\n".
                      "Matric Number: ".$_SESSION['matric_number']."\n".
                      "Contact Number: ".$_SESSION['contact_number'];


        //send the message
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }

        header('Location: /UnimasArena/src/modules/booking/booking_success.php'); // Redirect back to AddBooking.php
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
?>
