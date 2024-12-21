<?php
include '../../config/db-config.php';
?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/UnimasArena/src/public/css/add-booking.css">
<link rel="stylesheet" href="/UnimasArena/src/public/css/user-sidenav.css">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
    .booking-period input[type="radio"] {
    display: inline-block;
    margin-right: 10px;
}
.booking-period label {
    display: inline-block;
    margin-right: 20px;
}

</style>
</head>
<body>
<script>
        window.onload = function() {
            var date = new Date();
            var month = date.getMonth();
            var year = date.getFullYear();
            var input = document.getElementById('date');

            // Get the next Monday
            date.setDate(date.getDate() + (1 + 7 - date.getDay()) % 7);
            if (date.getMonth() !== month) {
                // If the next Monday is in the next month, set the date to the first day of the next month
                date.setDate(1);
                date.setMonth(month + 1);
            }
            input.min = date.toISOString().split('T')[0];

            // Get the next Friday
            date.setDate(date.getDate() + 4);
            if (date.getMonth() !== month) {
                // If the next Friday is in the next month, set the date to the last day of the current month
                date.setDate(0);
            }
            input.max = date.toISOString().split('T')[0];

            input.addEventListener('input', function() {
                var day = new Date(this.value).getUTCDay();
                // Sunday = 0, Saturday = 6
                if (day === 0 || day === 6) {
                    this.setCustomValidity('Please select a weekday');
                } else {
                    this.setCustomValidity('');
                }
            });
        }
    </script>


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
        <a href="/UnimasArena/src/logout.php"><img src="/UnimasArena/src/Resources/icon/logout.png" alt="icon" style="width:14px; height:14px; margin-right: 7px;">Logout</a>
        </div>
    </div>

<div class="main">
        <h1>Add Booking</h1>
        <form id="bookingForm" action="/UnimasArena/src/submit_page.php" method="POST">
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
            </select>

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

                <div class="name">
    <?php
    $email = $_SESSION['user_email'];
    $sql = "SELECT user_id, fname, lname, matric_number FROM user WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $matric_number = $row["matric_number"];
            $name = $row["fname"]. " " . $row["lname"];
            $user_id = $row["user_id"]; 
            echo "<div class='inline-field'><label for='u-name'>Name:</label> <span style='font-size: 18px; font-family: Poppins;'>". $name. "</span></div>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <input type="hidden" id="name" name="name" value="<?php echo $name; ?>">
    <input type="hidden" id="matric_number" name="matric_number" value="<?php echo $matric_number; ?>">
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" id="user_email" name="user_email" value="<?php echo $email; ?>">
    <input type="hidden" id="status" name="status" value="Pending">
</div>

<div class="matric_number">
    <?php
echo "<div class='inline-field'><label for='matric-number'>Matric Number:</label> <span style='font-size: 18px; font-family: Poppins;'>". $matric_number. "</span></div>";
?>
</div>


            <div class="contact_number">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" class="booking-period">
            </div>

            </div>
            <div>
            <input type="submit" value="Submit">
            </div>
        </form>
        </div>
   
</body>
</html> 
