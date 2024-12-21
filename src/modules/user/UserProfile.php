<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="/UnimasArena/src/public/css/profile.css">
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
    <div class="card">
        <h1>User Profile</h1>
        <?php

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $_SESSION['user_email'];

        $sql = "SELECT * FROM user WHERE user_email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='user-details'>";
                echo "<span>Name:</span> " . $row["fname"] ." ". $row["lname"];
                echo "<span>Password:</span> " . $row["password"];
                echo "<span>Matric No:</span> " . $row["matric_number"];
                echo "<span>Email:</span> " . $row["user_email"];
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    <button class="edit-button" onclick="window.location.href='edit-profile.php'">Edit</button>
    </div>
    <script>
        /* Your existing JavaScript */
        function showEditForm() {
            var form = document.querySelector('.edit-form');
            form.style.display = 'block';
        }
    </script>
</body>
</html>