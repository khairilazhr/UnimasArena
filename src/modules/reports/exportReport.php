<?php
// Establish a connection to the database
$db = new mysqli('localhost', 'root', '', 'UnimasArena');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Execute the SQL query for total bookings
$sql1 = "SELECT DATE_FORMAT(booking_date, '%Y-%M') AS month, COUNT(*) as total_bookings FROM booking WHERE status = 'Approved' GROUP BY month ORDER BY month";
$result1 = $db->query($sql1);

// Execute the SQL query for all approved bookings
$sql2 = "SELECT * FROM booking WHERE status = 'Approved' ORDER BY booking_date";
$result2 = $db->query($sql2);

if ($result1->num_rows > 0 || $result2->num_rows > 0) {
    // Set the headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="bookings.csv"');

    // Open a new CSV file
    $file = fopen('php://output', 'w');

    // Write the header row for total bookings
    fputcsv($file, array('Month', 'Total Bookings'));

    // Write the data rows for total bookings
    while($row = $result1->fetch_assoc()) {
        fputcsv($file, $row);
    }

    // Write a separator row
    fputcsv($file, array());

    // Write the header row for all approved bookings
    fputcsv($file, array('Booking Date', 'Booking Period', 'Court', 'Contact Number', 'Created At', 'Matric Number', 'Name', 'User Email'));

    // Write the data rows for all approved bookings
    while($row = $result2->fetch_assoc()) {
        fputcsv($file, array($row['booking_date'], $row['booking_period'], $row['court'], $row['contact_number'], $row['created_at'], $row['matric_number'], $row['name'], $row['user_email']));
    }

    // Close the CSV file
    fclose($file);
} else {
    echo "No bookings found";
}

$db->close();
?>
