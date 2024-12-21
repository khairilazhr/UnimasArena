<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/adminhome.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>
<body>

<div class="sidenav">
  <a class="logo" href="adminHomepage.php">
  <img src="/UnimasArena/src/Resources/Image/logo_mendatar.png" alt="Logo" >
  </a>
  <div class="u-email"><span><?php echo $_SESSION['user_email']; ?></span></div>
  <a href="/UnimasArena/src/modules/admin/adminAdd.php"><img src="/UnimasArena/src/Resources/icon/add.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Add Booking</a>
  <a href="/UnimasArena/src/modules/booking/bookingRequest.php"><img src="/UnimasArena/src/Resources/icon/req.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Booking Request</a>
  <a href="/UnimasArena/src/modules/feedback/viewFeedback.php"><img src="/UnimasArena/src/Resources/icon/fb.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">View Feedback</a>
  <div class="logout">
  <a href="/UnimasArena/src/modules/auth/logout.php"><img src="/UnimasArena/src/Resources/icon/logout.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Logout</a>
  </div>
</div>

<div class="main">
<h1>Add Booking</h1>
    <div class="card">
        <form id="bookingForm" action="admin_submit.php" method="POST">
            <label for="bdate">Booking Date:</label>
            <div class="input-field">
            <input type="date" id="date" name="date" onchange="fetchBookings()">
            </div>
            <label for="bperiod">Booking Period:</label>
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

            <div class="court-selection">
                <label for="court">Court:</label>
                <select id="court" name="court" class="booking-period">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>

                <div class="name">
                <label for="u-name">Name:</label>
                <input type="text" id="name" name="name" class="booking-period">
                </div>

                <div class="email">
                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" class="booking-period">
                </div>

            <div class="matric_number">
                <label for="matric-number">Matric Number:</label>
                <input type="text" id="matric_number" name="matric_number" class="booking-period">
            </div>

            <div class="contact_number">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" class="booking-period">
            </div>

            <input type="hidden" id="status" name="status" value="Approved">

            <div>
            <input type="submit" value="Submit">
            </div>
        </form>
        </div>
</div>
</body>
</html>