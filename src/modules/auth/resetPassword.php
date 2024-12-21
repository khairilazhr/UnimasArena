<?php
include '../../config/db-config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists in database
    $sql = "SELECT * FROM User WHERE user_email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a random password
        $new_password = bin2hex(random_bytes(5)); // This will generate a random 10 character string

        // Update the password in the database
        $sql = "UPDATE User SET password='$new_password' WHERE user_email='$email'";

        if ($conn->query($sql) === TRUE) {
            // Send the new password to the user's email
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
            $mail->addAddress($email);
            $mail->Subject  = 'Password Reset';
            $mail->Body     = 'Your new password is: ' . $new_password;
            if(!$mail->send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent.';
                header("Location: Login.php");
                exit;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No user found with that email address.";
    }

    $conn->close();
}
?>
