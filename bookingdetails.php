<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie Booking</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bookingdetails.css">
</head>

<body>
    <header>
        <img src="easymoviesbooking.png" alt="header" height="150" width="500">
    </header>

    <a href="home.php">❮ Back To Home</a><br>
    
    <?php
    $db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to the database. Please try again later.";
        exit;
    }

    session_start();


if (isset($_SESSION['email']) || isset($_SESSION['validuser'])) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $condition = "email = '$email'";
    } elseif (isset($_SESSION['validuser'])) {
        $user = $_SESSION['validuser'];
        $condition = "username = '$user'";
    }

    $query = "SELECT * FROM bookings WHERE $condition ORDER BY showtimeString, moviename, Place, seat_id";
    $result = $db->query($query);

    $currentGroup = null;

    while ($row = $result->fetch_assoc()) {
        $movieName = $row['moviename'];
        $time = $row['showtimeString'];
        $cinema = $row['Place'];
        $seatNumber = $row['seat_id'];

        $group = "$movieName-$time-$cinema-$seatNumber";
        if ($currentGroup !== $group) {
            if ($currentGroup !== null) {
                echo "</div>";
            }

            echo "<div class='group-container'>";
            $currentGroup = $group;
        }

        echo "<div class='container'>";
        echo "<img src = '$movieName.jpg' width='200' height='250'>";
        echo "<div class='moviesdetail'>";
        echo "<p>Name: $movieName</p>";
        echo "<p>Time: $time</p>";
        echo "<p>Cinema: $cinema</p>";
        echo "<p>Seat Number: $seatNumber</p>";
        echo "</div>";
        echo "</div>";
    }

    if ($currentGroup !== null) {
        echo "</div>";
    }

    $db->close();

    if (isset($_SESSION['email'])){
        unset ($_SESSION['email']);
    }

}

    ?>   

    <div class="footer">
        <footer>
            ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any
            form
            without our written permission.
        </footer>
    </div>

    <script src="bookingdetails.js"></script>

</body>
