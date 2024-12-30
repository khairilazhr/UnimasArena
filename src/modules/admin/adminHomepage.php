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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <h1>Dashboard</h1>

        <?php
        // Establish a connection to the database
        $db = new mysqli('localhost', 'root', '', 'UnimasArena');

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $sql = "SELECT DATE_FORMAT(booking_date, '%Y-%M') AS month, COUNT(*) as total_bookings 
FROM booking 
WHERE status = 'Approved' 
GROUP BY month 
ORDER BY month";
        $result = $db->query($sql);
        ?>

        <style>
            .card {
                width: 80%;
                margin: 0 auto;
                border: 1px solid #ccc;
                border-radius: 15px;
                box-shadow: 2px 2px 6px 0px #ccc;
                padding: 20px;
                margin-top: 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid #000;
                padding: 10px;
                text-align: left;
                font-size: 18px;
            }

            th {
                background-color: #f2f2f2;
            }

            #myChart {
                width: 300px;
                height: 300px;
            }

            .export {
                border-radius: 5px;
                font-size: 14px;
                margin-bottom: 10px;

            }

            .export img {
                width: 20px;
                height: 20px;
            }
        </style>

        <div class="card">
            <button class="export" onclick="exportData()">Export</button>
            <script>
                function exportData() {
                    window.location.href = '/UnimasArena/src/modules/reports/exportReport.php';
                }
            </script>
            <table>
                <tr>
                    <th>Month</th>
                    <th>Total Bookings</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["month"] . "</td><td>" . $row["total_bookings"] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No bookings found</td></tr>";
                }
                ?>
            </table>
        </div>

        <?php
        // Execute the SQL query
        $sql = "SELECT DATE_FORMAT(booking_date, '%Y-%M') AS month, COUNT(*) as total_bookings FROM booking WHERE status = 'Approved' GROUP BY month ORDER BY month";
        $result = $db->query($sql);

        $bookingsData = array();

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $bookingsData[] = array('month' => $row["month"], 'total_bookings' => $row["total_bookings"]);
            }
        }

        ?>
        <div class="card">
            <canvas id="myChart"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var data = <?php echo json_encode($bookingsData); ?>;
                var labels = data.map(function (e) {
                    return e.month;
                });
                var bookings = data.map(function (e) {
                    return e.total_bookings;
                });

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Bookings',
                            data: bookings,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Change as needed
                            borderColor: 'rgba(75, 192, 192, 1)', // Change as needed
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });
            </script>
        </div>

        <?php
        $db->close();
        ?>

    </div>

    </div>

</body>

</html>