<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="/UnimasArena/src/public/css/edit-booking.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        .card {
  width: 80%;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 15px;
  box-shadow: 2px 2px 6px 0px  #ccc;
  padding: 20px;
  margin-top: 10px;
}

    </style>
</head>
<body>
    
<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $booking_date = $_POST['date'];
    $booking_period = $_POST['period'];
    $court = $_POST['court'];
    $matric_number = $_POST['matric_number'];
    $contact_number = $_POST['contact_number'];

    // Check for duplicate entry
    $check_duplicate = "SELECT * FROM Booking WHERE booking_date = ? AND booking_period = ? AND court = ? AND id != ?";
    $stmt = $conn->prepare($check_duplicate);
    $stmt->bind_param("sssi", $booking_date, $booking_period, $court, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        echo "<script>alert('The slot is already booked!'); window.location='editBooking.php?id=".$id."';</script>";
    } else {
        $sql = "UPDATE Booking SET booking_date = ?, booking_period = ?, court = ?, matric_number = ?, contact_number = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $booking_date, $booking_period, $court, $matric_number, $contact_number, $id);
        try {
            $stmt->execute();
            header('Location: ViewBooking.php'); // Redirect back to ViewBooking.php
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Booking WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
?>

<div id="bookingDetails">
    <h2>Edit Booking Details</h2>
    <div class="card">
    <p>Date: <?php echo $booking['booking_date']; ?></p>
    <p>Period: <?php echo $booking['booking_period']; ?></p>
    <p>Court: <?php echo $booking['court']; ?></p>
    <p>Matric Number: <?php echo $booking['matric_number']; ?></p>
    <p>Contact Number: <?php echo $booking['contact_number']; ?></p>
    </div>
    </div>

<div class="card">
<form id="bookingForm" action="editBooking.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $booking['booking_date']; ?>"><br>
        <label for="period">Period:</label><br>
        <select id="period" name="period" class="booking-period">
                <option value="9:00am - 10:00am">9:00am - 10:00am</option>
                <option value="10:00am - 11:00am">10:00am - 11:00am</option>
                <option value="11:00am - 12:00pm">11:00am - 12:00pm</option>
                <option value="12:00pm - 1:00pm">12:00pm - 1:00pm</option>
                <option value="1:00pm - 2:00pm">1:00pm - 2:00pm</option>
                <option value="2:00pm - 3:00pm">2:00pm - 3:00pm</option>
                <option value="3:00pm - 4:00pm">3:00pm - 4:00pm</option>
                <option value="4:00pm - 5:00pm">4:00pm - 5:00pm</option>
                <option value="5:00pm - 6:00pm">5:00pm - 6:00pm</option>
            </select><br>
        <label for="court">Court:</label><br>
        <select id="court" name="court" class="booking-period">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select><br>
                <div class="matric_number">
                <label for="matric-number">Matric Number:</label>
                <input type="text" id="matric_number" name="matric_number" class="booking-period">
            </div>

            <div class="contact_number">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" class="booking-period">
            </div>

            <div>
            <input type="submit" value="Submit">
            </div>
            <button type="button" onclick="window.location.href='ViewBooking.php'">Cancel</button>
        </form>
</div>
<?php
}
?>    

</body>
</html>