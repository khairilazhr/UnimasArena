<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="/UnimasArena/src/public/css/userhome.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body>
  <div class="sidenav">
    <a class="logo" href="\UnimasArena\src\modules\user\UserHome.php">
      <img src="/UnimasArena/src/Resources/Image/logo_mendatar.png" alt="Logo">
    </a>
    <a class="u-email" href="UserProfile.php"><span
        style="font-size: 15px;"><?php echo $_SESSION['user_email']; ?></span></a>
    <a href="/UnimasArena/src/modules/booking/AddBooking.php"><img src="/UnimasArena/src/Resources/icon/add.png"
        alt="icon" style="width:14px; height:14px; margin-right: 7px;">Add Booking</a>
    <a href="/UnimasArena/src/modules/booking/ViewBooking.php"><img src="/UnimasArena/src/Resources/icon/req.png"
        alt="icon" style="width:14px; height:14px; margin-right: 7px;">View Booking</a>
    <a href="/UnimasArena/src/modules/feedback/AddFeedback.php"><img src="/UnimasArena/src/Resources/icon/fb.png"
        alt="icon" style="width:14px; height:14px; margin-right: 7px;">Feedback</a>
    <a href="/UnimasArena/src/modules/contact/Contact.php"><img src="/UnimasArena/src/Resources/icon/phone.png"
        alt="icon" style="width:14px; height:14px; margin-right: 7px;">Contact</a>
    <a href="/UnimasArena/src\modules\equipment-booking\add-equipment.php"><img
        src="/UnimasArena/src/Resources/icon/badminton-equipment.png" alt="icon"
        style="width:14px; height:14px; margin-right: 7px;">Book Equipment</a>
    <div class="logout">
      <a href="/UnimasArena/src/modules/auth/logout.php"><img src="/UnimasArena/src/Resources/icon/logout.png"
          alt="icon" style="width:14px; height:14px; margin-right: 7px;">Logout</a>
    </div>
  </div>

  <div class="main">
    <div id="date" style="text-align: center; font-size: 20px;"></div>
    <div id="clock" style="text-align: center; font-size: 20px;"></div>
  </div>

  <script>
    function updateClock() {
      var now = new Date();
      var dname = now.getDay(),
        mo = now.getMonth(),
        dnum = now.getDate(),
        yr = now.getFullYear(),
        hou = now.getHours(),
        min = now.getMinutes(),
        sec = now.getSeconds(),
        pe = "AM";

      if (hou >= 12) {
        pe = "PM";
      }
      if (hou == 0) {
        hou = 12;
      }
      if (hou > 12) {
        hou = hou - 12;
      }

      Number.prototype.pad = function (digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
      }

      var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
      var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
      document.getElementById('date').innerHTML = week[dname] + ", " + months[mo] + " " + dnum.pad(2) + ", " + yr;
      document.getElementById('clock').innerHTML = hou.pad(2) + ":" + min.pad(2) + ":" + sec.pad(2) + " " + pe;
    }

    window.onload = function () {
      updateClock();
      setInterval(updateClock, 1000);
    }
  </script>



</body>
<html>