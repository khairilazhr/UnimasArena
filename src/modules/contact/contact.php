<?php
include '../../config/db-config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/user-sidenav.css">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/contact.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>

<div class="sidenav">
        <a class="logo" href="/UnimasArena/src/modules/user/UserHome.php">
        <img src="/UnimasArena/src/Resources/Image/logo_mendatar.png" alt="Logo" >
        </a>
        <a class="u-email" href="UserProfile.php"><span style="font-size: 15px;"><?php echo $_SESSION['user_email']; ?></span></a>
        <a href="/UnimasArena/src/modules/booking/AddBooking.php"><img src="/UnimasArena/src/Resources/icon/add.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Add Booking</a>
        <a href="/UnimasArena/src/modules/booking/ViewBooking.php"><img src="/UnimasArena/src/Resources/icon/req.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">View Booking</a>
        <a href="/UnimasArena/src/modules/feedback/AddFeedback.php"><img src="/UnimasArena/src/Resources/icon/fb.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Feedback</a>
        <a href="/UnimasArena/src/modules/contact/Contact.php"><img src="/UnimasArena/src/Resources/icon/phone.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Contact</a>
        <div class="logout">
        <a href="logout.php"><img src="/UnimasArena/src/Resources/icon/logout.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Logout</a>
        </div>
    </div>

   
    <div class="main">
        <h1 class="title" >Contact</h1>

        <div class="card">
            <a class="ctc">Contact No: +6082581662</a><br>
            <a href="mailto:awaarshad@unimas.my" class="ctc">Email: awaarshad@unimas.my</a><br>
            <a class="ctc">Arena Tun Tuanku Haji Bujang, Universiti Malaysia Sarawak, 94300 Kota Samarahan, Sarawak, Malaysia</a><br>
            <a></a><br>
            <a class="ctc">Main Office Operating Hours :</a><br>
            <a class="ctc">Weekdays (Monday - Friday)</a><br>
            <a class="ctc">8.00am - 1.00pm, 2.00pm - 5.00pm (Monday - Thursday)</a><br>
            <a class="ctc">8.00am - 12.00pm, 2.30pm - 5.00pm (Friday)</a><br>

            <a href="https://www.google.com/maps/dir//Tun+Tuanku+Haji+Bujang+Arena,+Jln+Kapur,+94300+Kota+Samarahan,+Sarawak/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x31fba22d4a9d015f:0xcd36cae9c9f1517?sa=X&ved=2ahUKEwjx-K-BxuaDAxV0oWMGHZVPAFoQ48ADegQIExAA" target="_blank">
            <iframe
                 width="600"
                 height="450"
                 style="border:0; margin-left: 12rem; margin-top: 1rem;"
                 loading="lazy"
                 allowfullscreen
                 src="/UnimasArena/src/Resources/Image/map.png">
            </iframe>
            </a>

        </div>

    </div>


    
</body>
</html>