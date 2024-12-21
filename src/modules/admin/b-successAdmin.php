<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Successful</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
      .card {
  width: 80%;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 15px;
  box-shadow: 2px 2px 6px 0px  #ccc;
  padding: 20px;
  margin-top: 10px;
  font-family: 'Poppins';
}

.card-body {
    background-color: #f8f9fa;
    border-radius: 5px;
    padding: 20px;
    margin: 10px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card-body .card-title {
    color: #007bff;
    font-size: 20px;
    margin-bottom: 20px;
}

.card-body .list-group-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    list-style-type: none;
    margin: 5px 0;
    padding: 10px;
}

.card-body .btn {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}


    </style>
<body>


<div class="card">
  <h1>Booking Details</h1>
  <div class="card-body">
    <h5 class="card-title">Booking has been successfully added!</h5>
    <li class="list-group-item">Booking Date: <?php echo $_SESSION['booking_date']; ?></li>
    <li class="list-group-item">Booking Period: <?php echo $_SESSION['booking_period']; ?></li>
    <li class="list-group-item">Court: <?php echo $_SESSION['court']; ?></li>
    <li class="list-group-item">Matric Number: <?php echo $_SESSION['matric_number']; ?></li>
    <li class="list-group-item">Contact Number: <?php echo $_SESSION['contact_number']; ?></li>
    <a href="adminHomepage.php" class="btn btn-primary">Return Home</a>
  </div>
</div>

</body>
</html>