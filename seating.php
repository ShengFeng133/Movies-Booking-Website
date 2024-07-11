<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Seat Selection</title>
    <link rel="stylesheet" href="cqstyle.css">
    <link rel="stylesheet" href="home.css">


    <style>
    .seat {
        width: 35px;
        height: 40px;
        background-color: #21D375;
        margin: 5px;
        text-align: center;
        vertical-align: middle;
        line-height: 30px;
        cursor: pointer;
        border-radius: 5px; /* 这会使方格成为圆形 */
    }
    .selected {
        background-color: #3dcaf5;
    }

    .booked {
    background-color: #FF0000; /* 已预订的座位颜色 */
    cursor: not-allowed; /* 不允许点击 */


}


#seatingArea table{
    width: 45%;

    padding-top: 100px;
}
</style>
</head>



<body>

<?php

include "homelogin.php";

$loggedIn = isset($_SESSION['validuser']);

$destinationURL = $loggedIn ? 'bookingdetails.php' : 'checkbooking.php';

$db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_GET['MovieName'])) {
    $MovieName = $_GET['MovieName'];
    $sql = "SELECT * FROM movies WHERE MovieName = '$MovieName'";
    $result = $db->query($sql);

    $row = $result->fetch_assoc();
    
    if ($result) {
      echo"";
      $db->close();
    } else {
      echo "123Error: " . $sql . "<br>" . $db->error;
    }
  }



  // 数据库连接信息
$host = "localhost";
$username = "f32ee";
$password = "f32ee";
$database = "project";

// 创建数据库连接
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movie_id = $_POST['movie_id'];
$cinema_id = $_POST['cinema_id'];
$session_id = $_POST['session_id'];

function getSeatsStatus($conn, $movie_id, $cinema_id, $session_id) {
    $stmt = $conn->prepare("SELECT seat_id, status FROM seat_status WHERE movie_id = ? AND cinema_id = ? AND session_id = ?");
    $stmt->bind_param("iii", $movie_id, $cinema_id, $session_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $seatsStatus = array();
    while ($row = $result->fetch_assoc()) {
        $seatsStatus[$row['seat_id']] = $row['status'];
    }

    return $seatsStatus;
}

$seatsStatus = getSeatsStatus($conn, $movie_id, $cinema_id, $session_id);

// 关闭数据库连接
$conn->close();


?>




    <div id="wrapper">
        <header>
            <img src="logo.png" width="500px" height="150px">
        </header>



        <div id="navigation">
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="<?php echo $destinationURL; ?>">View Booking Details</a></li>
      <li>

      <?php
    if (isset($_SESSION['validuser'])) {
      echo '<div class="form-container-wrapper">';
      echo '<button class="open-button" onclick="openLogoutForm()">' . $_SESSION['validuser'] . '</button>';
      echo '<div class="form-popup" id="myFormlogout">';
      echo '<form method="POST" action="homelogout.php" class="form-container">';
      echo '<button type="button" class="cancel2" onclick="closeLogoutForm()"><span class="close">&times;</span></button><br><br>';
      echo '<input type="submit" value="Log out" class="logout">';
      echo '</form></div></div>';
    } else {
      // Display the login form if the user is not logged in
      echo '<div class="form-container-wrapper">';
      echo '<button class="open-button" onclick="openLoginForm()">Sign in/ Register</button>';
      echo '<div class="form-popup" id="myFormlogin">';
      echo '<form method="POST" action="homelogin.php" class="form-container">';
      echo '<button type="cancel" class="cancel2" onclick="closeLoginForm()"><span class="close">&times;</span></button>';
      echo '<h1>Login</h1>';
      echo '<label for="email"><b>Email</b></label>';
      echo '<input type="text" placeholder="Enter Email" name="email" id="email" required>';
      echo '<label for="password"><b>Password</b></label>';
      echo '<input type="password" placeholder="Enter Password" name="password" id="password" required>';
      echo '<input type="submit" value="Sign in" class="signin">';
      echo '<a href="register.php" class="register">Register</a>';
      echo '</form></div></div>';
    }
    ?>
    </li>
    </ul>
  </div>


    <div id="movie" style="margin-bottom: 200px;" >
    <div id="MoviePoster">
        <img id="posterImage" src="<?php echo $row['MoviePoster'] ?>.jpg" alt="Movie Poster" style="width: 500px; height: 450px;">
    </div>

    <form id="seatsForm" action="payment.php" method="post">
<div id="seatingArea">
        <h1> Pick A Seat:</h1>
        <table>
            <?php for($row = 1; $row <= 3; $row++): ?>
            <tr>
                <?php for($number = 1; $number <= 8; $number++): ?>
                <?php
                    $seatId = $row . '-' . $number;
                    $seatClass = 'seat';
                    if (isset($seatsStatus[$seatId]) && $seatsStatus[$seatId] == 'booked') {
                        $seatClass .= ' booked'; // 如果座位已被预订，则添加 'booked' 类
                    }
                ?>
                <td class="<?php echo $seatClass; ?>" data-seat-id="<?php echo $seatId; ?>" onclick="toggleSeat(this)"><?php echo $seatId; ?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </table>
    
    <input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie_id; ?>">
    <input type="hidden" name="cinema_id" id="cinema_id" value="<?php echo $cinema_id; ?>">
    <input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id; ?>">
    <input type="hidden" name="selectedSeatsCount" id="selectedSeatsCount" value="">
    <input type="hidden" name="selectedSeatIds" id="selectedSeatIds" value="">
    <input type="hidden" name="selectedSeatsInput" id="selectedSeatsInput" value="">


    <input type="button" onclick="submitSeats();getvalue()" value="NEXT">
    </form>
    </div>
</div>
</div>

<div class="footer">
    <footer>
      ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any form
      without our written permission.
    </footer>
  </div>




    <script>
function toggleSeat(seat) {
    if (!seat.classList.contains('booked')) {
        seat.classList.toggle('selected');
    }
}

    
    function submitSeats() {
        var selectedSeats = document.querySelectorAll('.selected');
        var seatIds = [];

        if (selectedSeats.length === 0) {
        alert("You haven't selected any seat!");
        return; 
    }

        for (var i = 0; i < selectedSeats.length; i++) {
            seatIds.push(selectedSeats[i].getAttribute('data-seat-id'));
        }
        document.getElementById('selectedSeatsInput').value = seatIds.join(',');
        document.getElementById('selectedSeatsCount').value =selectedSeats.length ; // 将所选座位数量存储在隐藏字段中
        document.getElementById('selectedSeatIds').value = seatIds.join(','); // 将所选座位的ID存储在隐藏字段中


        document.getElementById('seatsForm').submit();
    }
    
    
    </script>
            <script src="home.js"></script>

</body>
</html>
