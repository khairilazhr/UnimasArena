<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/add-fb.css">
    <link rel="stylesheet" href="/UnimasArena/src/public/css/user-sidenav.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>

<div class="sidenav">
        <a class="logo" href="/UnimasArena/src/UserHome.php">
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
            <div class="card">
            <form id="feedbackForm" method="POST" action="submit_feedback.php">
            <div class="card-header">
            <h2>Feedback Form</h2>
            </div>
            <div class="card-body">
                <label for="fb1">How was your experience using our booking system?</label>
                <textarea id="fb1" name="fb1" style="height:200px"></textarea>
                <label for="fb2">How was your experience with the facilities?</label>
                <textarea id="fb2" name="fb2" style="height:200px"></textarea>
                <label for="fb3">How was your experience with the services offered?</label>
                <textarea id="fb3" name="fb3" style="height:200px"></textarea>
                <label for="fb4">What improvements would you suggest for the booking system, facilities, or services offered?</label>
                <textarea id="fb4" name="fb4" style="height:200px"></textarea>
                <div class="card-footer">
                <input type="submit" value="Submit">
                </div>
            </div>
            </form>
            </div>
        </div>
 
    <script>
document.getElementById('feedbackForm').addEventListener('submit', function() {
    alert('Feedback has been received');
});
</script>
    
</body>
</html>