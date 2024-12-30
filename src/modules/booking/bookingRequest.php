<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/UnimasArena/src/public/css/admin-view-fb.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
        <h1>Booking Request</h1>

        <?php
        // Select columns from booking table where user_id matches the user_id from current session
        $sql = "SELECT id, booking_date, booking_period, court, matric_number, contact_number, name, status, user_email FROM Booking ORDER BY booking_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row["status"] == "Pending") {
                    echo "<div class='card'>";
                    echo "<p>Date: " . $row["booking_date"] . "</p>";
                    echo "<p>Period: " . $row["booking_period"] . "</p>";
                    echo "<p>Court: " . $row["court"] . "</p>";
                    echo "<p>Name: " . $row["name"] . "</p>";
                    echo "<p>Matric Number: " . $row["matric_number"] . "</p>";
                    echo "<p>Contact Number: " . $row["contact_number"] . "</p>";
                    echo "<button class='button' onclick='deleteBooking(" . $row["id"] . ")'>Delete</button>";
                    echo "<button class='button' onclick='editBooking(" . $row["id"] . ")'>Edit</button>";
                    echo "<button class='button' onclick='approveBooking(" . $row["id"] . ")'>Approve</button>";
                    echo "<button class='button' onclick='rejectBooking(" . $row["id"] . ")'>Reject</button>";
                    echo "</div>";
                }
            }
        } else {
            echo "No bookings found";
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
                window.location.href = "/UnimasArena/src/modules/admin/adminEdit.php?id=" + id;
            }

            function approveBooking(id) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "approveBooking.php?id=" + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert("Booking approved successfully");
                        location.reload(); // This will refresh the page
                    }
                }
                xhr.send();
            }

            function rejectBooking(id) {
                var remark = prompt("Please enter a remark for this booking:");
                if (remark != null) {
                    // If the admin entered a remark, proceed with the rejection.
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "rejectBooking.php?id=" + id + "&remark=" + encodeURIComponent(remark), true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            alert(xhr.responseText);
                            location.reload(); // This will refresh the page
                        }
                    }
                    xhr.send();
                }
            }




        </script>
    </div>

</body>

</html>