<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/UnimasArena/src/public/css/view-booking.css">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/user-sidenav.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
.status-pill {
    display: inline-block;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    border-radius: 30px; /* Adjust as needed */
    width: 50%;
    height: 50%;
}

    </style>
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
    <h1>Booking List</h1>
    <?php
    
$email = $_SESSION['user_email'];

// Fetch user_id and user_email from current session
$sql = "SELECT user_id, user_email FROM user WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Select columns from booking table where user_id matches the user_id from current session
$sql = "SELECT id, booking_date, booking_period, court, matric_number, contact_number, status FROM Booking WHERE user_email = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user['user_email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        $bookingDetails = [
            "Date" => $row["booking_date"],
            "Period" => $row["booking_period"],
            "Court" => $row["court"],
            "Matric Number" => $row["matric_number"],
            "Contact Number" => $row["contact_number"],
        ];
    
        foreach ($bookingDetails as $key => $value) {
            echo "<p>{$key}: {$value}</p>";
        }
    
        echo "<button class='status-pill'>{$row["status"]}</button>";
    
        if($row["status"] != "Approved") {
            echo "<button class='button' onclick='deleteBooking({$row["id"]})'>Delete</button>";
            echo "<button class='button' onclick='editBooking({$row["id"]})'>Edit</button>";
        }
        echo "</div>";
    }
} else {
    echo "No bookings found";
}

    ?>
    <h1>Rejected Booking</h1>
    <?php

// Select columns from rejectBooking table where user_id matches the user_id from current session
$sql = "SELECT rej_id, rej_booking_date, rej_booking_period, rej_court, rej_matric_number, rej_contact_number, rej_name, rej_status, user_email, remark FROM rejectBooking WHERE user_email = ? ORDER BY rej_booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user['user_email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        $bookingDetails = [
            "Date" => $row["rej_booking_date"],
            "Period" => $row["rej_booking_period"],
            "Court" => $row["rej_court"],
            "Matric Number" => $row["rej_matric_number"],
            "Contact Number" => $row["rej_contact_number"],
            "Remark" => $row["remark"],
        ];
    
        foreach ($bookingDetails as $key => $value) {
            echo "<p>{$key}: {$value}</p>";
        }
    
        echo "</div>";
    }
} else {
    echo "No rejected bookings found";
}

    ?>
    <script>
function deleteBooking(id) {
    var confirmation = confirm("Are you sure you want to delete this booking?");
    if (confirmation) {
        // If the user clicked "OK", proceed with the deletion.
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "deleteBooking.php?id=" + id, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert("Booking deleted successfully");
                location.reload(); // This will refresh the page
            }
        }
        xhr.send();
    }
}

function editBooking(id) {
    window.location.href = "editBooking.php?id=" + id;
}


    </script>
</div>    

</body>
</html>
