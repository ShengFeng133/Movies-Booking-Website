<?php
  session_start();

// Assuming you have a database connection
$db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);

    
        
        $query = "SELECT * FROM bookings WHERE PhoneNumber = '$phone' AND Email = '$email'";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $_SESSION['phone']=$phone;
            $_SESSION['email']=$email;
            header("Location: bookingdetails.php");
            exit;
        } else {
            echo '<script>alert("There are no users associated with the provided phone number and email. Please check again.");</script>';
        }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie Booking</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="checkbooking.css">
</head>

<body>
    <header>
        <img src="easymoviesbooking.png" alt="header" height="150" width="500">
    </header>
    <div class="register-box">
        <a href="home.php">❮  Back To Home</a>
        <h2>Check Booking</h2>
        <form method="POST" action="" id="checkbooking">
          
          Phone: <input type="text" name="phone" id="phone" placeholder="Please enter your phone no.">
          <br>
          Email: <input type="email" name="email" id="email" placeholder="Please enter your email">

          <input type="reset" value="Reset">
          <input type="submit" value="Check">
        </form>
    </div>



    <div class="footer">
        <footer>
            ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any form
            without our written permission.
        </footer>
    </div>
    <script type="text/javascript" src="checkbooking.js"></script>



</body>


<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie Booking</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="checkbooking.css">
</head>

<body>
    <header>
        <img src="easymoviesbooking.png" alt="header" height="100" width="500">
    </header>

    php
    if (!isset($_SESSION['validuser'])) {
   

        echo '<div class="register-box">';
        echo '<a href="home.php">❮  Back To Home</a>';
        echo '<h2>Check Booking</h2>';
        echo '<form action="/your-register-handler.php" method="POST">';
        echo 'Phone: <input type="text" name="phone" placeholder="Please enter your phone no."><br>';
        echo 'Email: <input type="email" name="email" placeholder="Please enter your email">';
        echo '<input type="reset" value="Reset">';
        echo '<input type="submit" value="Check">';
        echo '</form>';
        echo '</div>';
    }
    php

    <div class="footer">
        <footer>
            ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any
            form without our written permission.
        </footer>
    </div>

    
</body>

</html> -->
