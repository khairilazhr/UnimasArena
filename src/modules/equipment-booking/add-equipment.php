<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/add-booking.css">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/user-sidenav.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .main-container {
            margin-left: 15%;
            /* Match this with sidenav width */
            padding: 20px;
            /* Adjust padding as needed */
            width: calc(85%);
            /* Remaining width after sidenav */
            box-sizing: border-box;
            /* Includes padding in width calculation */
            z-index: 1;
            /* Lower z-index compared to sidenav */
            position: relative;
            /* Ensure it is positioned relative to the sidebar */
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 24px;
        }

        .booking-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Space between booking form and my bookings */
        }

        .my-bookings {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .my-bookings table {
            width: 100%;
            border-collapse: collapse;
        }

        .my-bookings th,
        .my-bookings td {
            border: 1px solid #ddd;
            /* Grid outline */
            padding: 8px;
            text-align: left;
        }

        .my-bookings th {
            background-color: #f2f2f2;
            /* Header background */
        }

        .my-bookings tr:hover {
            background-color: #f1f1f1;
            /* Row hover effect */
        }

        .my-bookings span {
            color: black;
            /* Change status text color to black */
        }
    </style>
</head>

<body>

    <?php
    include '../../config/db-config.php';
    // Fetch user information
    $email = $_SESSION['user_email'];
    $sql = "SELECT user_id, fname, lname, matric_number FROM user WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $matric_number = $row["matric_number"];
        $name = $row["fname"] . " " . $row["lname"];
        $user_id = $row["user_id"];
    } else {
        echo "User not found.";
    }

    $stmt->close();
    ?>

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

    <div class="main-container">
        <div class="header">Equipment Booking</div>

        <div class="booking-form">
            <form action="process_booking.php" method="POST">
                <div class="form-group">
                    <label for="racket">Select Racket:</label>
                    <select id="racket" name="racket" required>
                        <option value="">-- Choose Racket --</option>
                        <option value="Yonex">Yonex</option>
                        <option value="Li-Ning">Li-Ning</option>
                        <option value="Victor">Victor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Booking Date:</label>
                    <input type="date" id="date" name="date" required>

                    <label for="period">Booking Period:</label>
                    <select id="period" name="period">
                        <!-- Add booking period options here -->
                        <?php
                        for ($hour = 9; $hour <= 17; $hour++) {
                            echo "<option value='{$hour}:00am - " . ($hour + 1) . ":00am'>{$hour}:00am - " . ($hour + 1) . ":00am</option>";
                        }
                        ?>
                    </select>

                    <label for="court">Court:</label>
                    <select id="court" name="court">
                        <?php for ($i = 1; $i <= 8; $i++) {
                            echo "<option value='{$i}'>{$i}</option>";
                        } ?>
                    </select>

                    <!-- Hidden fields -->
                    <input type="hidden" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <input type="hidden" id="matric_number" name="matric_number"
                        value="<?php echo htmlspecialchars($matric_number); ?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                    <input type="hidden" id="user_email" name="user_email"
                        value="<?php echo htmlspecialchars($email); ?>">
                    <input type="hidden" id="status" name="status" value="Pending">

                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" id="contact_number" name="contact_number" required>
                    </div>

                    <button type="submit" class="btn">Book Now</button>
                </div>
            </form>
        </div>

        <!-- My Bookings Section -->
        <div class="my-bookings">
            <h3>My Bookings</h3>

            <?php
            // Fetch user's bookings
            $sqlBookings = "SELECT * FROM equipment_booking WHERE user_id = ?";
            $stmtBookings = $conn->prepare($sqlBookings);
            $stmtBookings->bind_param("i", $user_id);
            $stmtBookings->execute();
            $resultBookings = $stmtBookings->get_result();

            if ($resultBookings->num_rows > 0) {
                echo "<table style='width:100%; border-collapse: collapse; border: 1px solid #ddd;'>";
                echo "<tr>
                <th>Racket</th>
                <th>Booking Date</th>
                <th>Booking Period</th>
                <th>Court</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

                while ($booking = $resultBookings->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($booking['racket']) . "</td>";
                    echo "<td>" . htmlspecialchars($booking['booking_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($booking['booking_period']) . "</td>";
                    echo "<td>" . htmlspecialchars($booking['court']) . "</td>";

                    // Status pill with black text
                    $status = htmlspecialchars($booking['status']);
                    $pillColor = '';
                    if ($status == 'Pending') {
                        $pillColor = 'yellow';
                    } elseif ($status == 'Approved') {
                        $pillColor = 'green';
                    } elseif ($status == 'Rejected') {
                        $pillColor = 'red';
                    }
                    echo "<td><span style='background-color: $pillColor; color: black; padding: 5px 10px; border-radius: 15px;'>$status</span></td>";

                    // Show Edit button only if status is Pending
                    if ($status == 'Pending') {
                        echo "<td>
                        <form action='edit_booking.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='booking_id' value='" . htmlspecialchars($booking['id']) . "'>
                            <button type='submit' class='btn' style='background-color: blue; color: white;'>Edit</button>
                        </form>
                      </td>";
                    } else {
                        // If not pending, leave the cell empty
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No bookings found.</p>";
            }

            // Close statement
            $stmtBookings->close();
            ?>
        </div>




    </div>

</body>

</html>