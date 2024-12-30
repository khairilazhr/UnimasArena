<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['message']) && isset($_GET['booking_id'])) {
    // Retrieve the message and booking ID from the URL
    $message = htmlspecialchars($_GET['message']);
    $booking_id = $_GET['booking_id'];

    // Fetch the updated booking details from the database
    $stmt = $conn->prepare("SELECT * FROM equipment_booking WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        echo "Booking not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Determine the header based on the message
$header = strpos($message, 'created') !== false ? 'Booking Created' : 'Booking Updated';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/add-booking.css">
    <title><?php echo $header; ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .booking-info {
            margin-bottom: 15px;
            text-align: left;
            color: #555;
        }

        .booking-info p {
            margin: 5px 0;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2><?php echo $header; ?></h2>
        <p><?php echo $message; ?></p>
        <div class="booking-info">
            <p><strong>Racket:</strong> <?php echo htmlspecialchars($booking['racket']); ?></p>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking['booking_date']); ?></p>
            <p><strong>Booking Period:</strong> <?php echo htmlspecialchars($booking['booking_period']); ?></p>
            <p><strong>Court:</strong> <?php echo htmlspecialchars($booking['court']); ?></p>
            <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($booking['contact_number']); ?></p>
        </div>
        <a href="add-equipment.php" class="btn">Back to Add Equipment</a>
    </div>

</body>

</html>