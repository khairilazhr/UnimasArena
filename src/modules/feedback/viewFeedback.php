<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="/UnimasArena/src/public/css/admin-view-fb.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>

    <div class="sidenav">
        <a class="logo" href="\UnimasArena\src\modules\admin\adminHomepage.php">
            <img src="/UnimasArena/src/Resources/Image/logo_mendatar.png" alt="Logo">
        </a>
        <div class="u-email"><span><?php echo $_SESSION['user_email']; ?></span></div>
        <a href="/UnimasArena/src/modules/admin/adminAdd.php"><img src="/UnimasArena/src/Resources/icon/add.png"
                alt="icon" style="width:14px; height:14px; margin-right: 7px;">Add Booking</a>
        <a href="/UnimasArena/src/modules/booking/bookingRequest.php"><img src="/UnimasArena/src/Resources/icon/req.png"
                alt="icon" style="width:14px; height:14px; margin-right: 7px;">Booking Request</a>
        <a href="/UnimasArena/src/modules/feedback/viewFeedback.php"><img src="/UnimasArena/src/Resources/icon/fb.png"
                alt="icon" style="width:14px; height:14px; margin-right: 7px;">View Feedback</a>
        <a href="/UnimasArena/src\modules\equipment-booking\admin_equipment_booking.php"><img
                src="/UnimasArena/src/Resources/icon/badminton-equipment.png" alt="icon"
                style="width:14px; height:14px; margin-right: 7px;">Equipment Booking</a>
        <div class="logout">
            <a href="/UnimasArena/src/modules/auth/logout.php"><img src="/UnimasArena/src/Resources/icon/logout.png"
                    alt="icon" style="width:14px; height:14px; margin-right: 7px;">Logout</a>
        </div>
    </div>

    <div class="main">
        <h1>User Feedback</h1>

        <div class="card">
            <?php
            $sql = "SELECT feedback_id, fb1, fb2, fb3, fb4, user_email FROM feedback ORDER BY feedback_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<table>";
            echo "<tr><th>No.</th><th>User Email</th><th>How was your experience using our booking system?</th><th>How was your experience with the facilities?</th><th>How was your experience with the services offered?</th><th>What improvements would you suggest for the booking system, facilities, or services offered?</th></tr>";

            if ($result->num_rows > 0) {
                // Output data of each row
                $counter = 1; // Initialize counter
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $counter++ . "</td><td>" . $row["user_email"] . "</td><td>" . $row["fb1"] . "</td><td>" . $row["fb2"] . "</td><td>" . $row["fb3"] . "</td><td>" . $row["fb4"] . "</td></tr>";
                }
            } else {
                echo "No records found";
            }

            echo "</table>";
            ?>
        </div>

    </div>

</body>

</html>