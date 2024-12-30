<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get booking ID from POST request
    $booking_id = $_POST['booking_id'];

    // Fetch booking details from the database
    $stmt = $conn->prepare("SELECT * FROM equipment_booking WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/UnimasArena/src/public/css/add-booking.css">
            <title>Edit Booking</title>
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    display: flex;
                    margin: 0;
                    padding: 0;
                }

                .main-container {
                    margin-left: 250px;
                    /* Adjust according to your sidebar */
                    padding: 20px;
                    width: calc(100% - 250px);
                    box-sizing: border-box;
                }

                .booking-form {
                    background-color: #f9f9f9;
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
            </style>
        </head>

        <body>

            <div class="main-container">
                <h2>Edit Booking</h2>
                <div class="booking-form">
                    <form action="process_edit_booking.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['id']); ?>">

                        <div class="form-group">
                            <label for="racket">Select Racket:</label>
                            <select id="racket" name="racket" required>
                                <option value="<?php echo htmlspecialchars($booking['racket']); ?>" selected>
                                    <?php echo htmlspecialchars($booking['racket']); ?>
                                </option>
                                <option value="Yonex">Yonex</option>
                                <option value="Li-Ning">Li-Ning</option>
                                <option value="Victor">Victor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Booking Date:</label>
                            <input type="date" id="date" name="date"
                                value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="period">Booking Period:</label>
                            <select id="period" name="period" required>
                                <!-- Populate with existing period -->
                                <option value="<?php echo htmlspecialchars($booking['booking_period']); ?>" selected>
                                    <?php echo htmlspecialchars($booking['booking_period']); ?>
                                </option>
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
                        </div>

                        <div class="form-group">
                            <label for="court">Court:</label>
                            <select id="court" name="court" required>
                                <!-- Populate with existing court -->
                                <option value="<?php echo htmlspecialchars($booking['court']); ?>" selected>
                                    <?php echo htmlspecialchars($booking['court']); ?>
                                </option>
                                <?php for ($i = 1; $i <= 8; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" id="contact_number" name="contact_number"
                                value="<?php echo htmlspecialchars($booking['contact_number']); ?>" required>
                        </div>

                        <button type="submit" class="btn">Update Booking</button>
                    </form>
                </div>
            </div>

        </body>

        </html>
        <?php
    } else {
        echo "Booking not found.";
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>