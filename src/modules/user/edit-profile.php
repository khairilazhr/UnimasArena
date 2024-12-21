<?php
include '../../config/db-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['user_email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $matric_number = $_POST['matric_number'];

    // Update the user data in the database
    $sql = "UPDATE user SET fname = '$fname', lname = '$lname', password = '$password', matric_number = '$matric_number' WHERE user_email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: UserProfile.php");  // Redirect to UserProfile.php
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-shadow: 2px 2px 6px 0px  #ccc;
            padding: 20px;
            background-color: #fff;
        }
        .form-container h1 {
            text-align: center;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Profile</h1>
        <form method="post">
            First name: <input type="text" name="fname"><br>
            Last name: <input type="text" name="lname"><br>
            Password: <input type="password" name="password"><br>
            Matric number: <input type="text" name="matric_number"><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
