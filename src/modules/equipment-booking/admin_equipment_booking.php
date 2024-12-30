<?php
include '../../config/db-config.php';

// Fetch pending bookings
$stmt_pending = $conn->prepare("SELECT * FROM equipment_booking WHERE status = 'Pending'");
$stmt_pending->execute();
$result_pending = $stmt_pending->get_result();

// Fetch approved and rejected bookings
$stmt_approved_rejected = $conn->prepare("SELECT * FROM equipment_booking WHERE status IN ('Approved', 'Rejected')");
$stmt_approved_rejected->execute();
$result_approved_rejected = $stmt_approved_rejected->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/add-booking.css">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/adminhome.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Booking Management</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            margin: 20px 15%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 83%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }

        .approve {
            background-color: #28a745;
        }

        .reject {
            background-color: #dc3545;
        }

        .approve:hover {
            background-color: #218838;
        }

        .reject:hover {
            background-color: #c82333;
        }
    </style>

    <script>
        function confirmAction(action) {
            return confirm(`Are you sure you want to ${action} this booking?`);
        }
    </script>
</head>

<body>

    <div class="sidenav">
        <!-- Sidebar content remains unchanged -->
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

    <h1>Admin Equipment Booking Management</h1>

    <!-- Container for Pending Bookings -->
    <div class="container">
        <h2>Pending Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Racket</th>
                    <th>Booking Date</th>
                    <th>Booking Period</th>
                    <th>Court</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $result_pending->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['racket']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_period']); ?></td>
                        <td><?php echo htmlspecialchars($booking['court']); ?></td>
                        <td><?php echo htmlspecialchars($booking['name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                        <td>
                            <form action="update_equipment_booking_status.php" method="POST" style="display:inline;"
                                onsubmit="return confirmAction('approve');">
                                <input type="hidden" name="booking_id"
                                    value="<?php echo htmlspecialchars($booking['id']); ?>">
                                <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                            </form>
                            <form action="update_equipment_booking_status.php" method="POST" style="display:inline;"
                                onsubmit="return confirmAction('reject');">
                                <input type="hidden" name="booking_id"
                                    value="<?php echo htmlspecialchars($booking['id']); ?>">
                                <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Container for Approved and Rejected Bookings -->
    <div class="container">
        <h2>History</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Racket</th>
                    <th>Booking Date</th>
                    <th>Booking Period</th>
                    <th>Court</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $result_approved_rejected->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['racket']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_period']); ?></td>
                        <td><?php echo htmlspecialchars($booking['court']); ?></td>
                        <td><?php echo htmlspecialchars($booking['name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
// Close statements and connection
$stmt_pending->close();
$stmt_approved_rejected->close();
$conn->close();
?>