<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Seat Selection</title>
    <link rel="stylesheet" href="cqstyle.css">
    <link rel="stylesheet" href="home.css">

</head>



<body>
<?php

include "homelogin.php";

$loggedIn = isset($_SESSION['validuser']);

$destinationURL = $loggedIn ? 'bookingdetails.php' : 'checkbooking.php';

$host = "localhost";
$username = "f32ee";
$password = "f32ee";
$database = "project";

$selectedSeatsCount = $_POST['selectedSeatsCount'];
$selectedSeatIds = $_POST['selectedSeatIds'];
$selectedSeatsInput = $_POST['selectedSeatsInput'];
$movie_id = $_POST['movie_id'];
$cinema_id = $_POST['cinema_id'];
$session_id = $_POST['session_id'];





$db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


    $movie_id = $_POST['movie_id'];
    $sql = "SELECT * FROM movies WHERE MovieID = '$movie_id'";
    $result = $db->query($sql);

    $row = $result->fetch_assoc();
    
    if ($result) {
      echo"";
      $db->close();
    } else {
      echo "123Error: " . $sql . "<br>" . $db->error;
    }



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


    <div id="movie">
    <div id="MoviePoster">
        <img id="posterImage" src="<?php echo $row['MoviePoster']; ?>.jpg" alt="Movie Poster" style="width: 500px; height: 450px;">
    </div>

<form id="finishpayment" action="checkout.php" method="post">
    <div id="paymentdetails">
        <div id="moviename">
        <h1><?php echo $row['MovieName']; ?></h1>
        </div>

        <div id="personaldetails">
            <label for="Email">*E-mail:</label>
            <input type="text" name="Email" id="Email" placeholder="Enter your Email ID here: example@example.com" onchange="validateEmail();calculateTotalPrice()" onblur="calculateTotalPrice()" required> <br>
            <label for="PhoneNumber">*Phone Number:</label>
            <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Enter your 8 digits phone number here" onchange="validatePhoneNumber();calculateTotalPrice()"  onblur="calculateTotalPrice()" required> <br>
            <label for="CardNumber">*Card Number:</label>
            <input type="text" name="CardNumber" id="CardNumber" placeholder="Enter your 16 digits card number here" onchange="validateCardNumber();calculateTotalPrice()" onblur="calculateTotalPrice()" required> <br>
            <label for="PinNumber">*Pin Number:</label>
            <input type="password" name="PinNumber" id="PinNumber" placeholder="Enter your 6 digits Pin Number here"  onchange="validatePinNumber();calculateTotalPrice()" onblur="calculateTotalPrice()" required> 

            <p>Selected Seats: <?php echo $selectedSeatIds; ?> </p>



            <label for="ticket_type">Select Ticket Type:</label>
            <select id="ticket_type" class="custom-select" onchange="calculateTotalPrice()" onblur="calculateTotalPrice()">
            <option value="studentprice">Student Price --$7</option>
            <option value="standardprice">Standard Price --$14</option>
            </select>
            <br>
            <p>Total Price: $<span id="total_price">0</span></p>



            <input type="hidden" name="seat_id" id="seat_id" value="<?php echo $selectedSeatIds; ?>">
            <input type="hidden" name="ticket_num" id="ticket_num" value="<?php echo $selectedSeatsCount; ?>">
            <input type="hidden" name="ticket_price_payment" id="ticket_price_payment" value="">
            <input type="hidden" name="showtimeString" id="showtimeString" value="">
            <input type="hidden" name="CinemaPlace" id="CinemaPlace" value="">
            <input type="hidden" name="moviename" id="moviename" value="<?php echo $row['MovieName']; ?>">

            <input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie_id; ?>">
            <input type="hidden" name="cinema_id" id="cinema_id" value="<?php echo $cinema_id; ?>">
            <input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id; ?>">
            <input type="hidden" name="selectedSeatsCount" id="selectedSeatsCount" value="<?php echo $selectedSeatsCount; ?>">
            <input type="hidden" name="selectedSeatIds" id="selectedSeatIds" value="<?php echo $selectedSeatIds; ?>">
            <input type="hidden" name="selectedSeatsInput" id="selectedSeatsInput" value="<?php echo $selectedSeatsInput; ?>">

            <input type="submit" value="Pay !" id="paybutton" style="width: 100px;" onclick="validateForm();getvalue()">
    </div>
    </div>

    </form>
</div>
</div>





<script>
    function calculateTotalPrice() {
    var ticketType = document.getElementById("ticket_type").value;
    var totalPriceElement = document.getElementById("total_price");

    if (ticketType === "studentprice") {
        var price = 7*<?php echo $selectedSeatsCount; ?>;
        totalPriceElement.innerText = parseFloat(price);
        document.getElementById("ticket_price_payment").value = price;
    } else if (ticketType === "standardprice") {
        var price = 14*<?php echo $selectedSeatsCount; ?>;
        totalPriceElement.innerText = parseFloat(price);
        document.getElementById("ticket_price_payment").value = price;
    }
}


// function validateEmail() {
//     var email = document.getElementById("Email").value.trim();
//     var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    
//     if (!emailPattern.test(email)) {
//         alert("Invalid email format. Please enter a valid email address.");
//         return false;
//     }
    
//     return true;
// }


// function validatePhoneNumber() {
//     var phoneNumber = document.getElementById("PhoneNumber").value.trim();
//     var phoneNumberPattern = /^[\d]{4}\s*[\d]{4}$/; // 8位数字
//     if (!phoneNumberPattern.test(phoneNumber)) {
//         alert("Please enter a valid 8 digits phone no., with the example format 1234 5678.");
//         return false;
//     }
//     return true;
// }

// function validateCardNumber() {
//     var cardNumber = document.getElementById("CardNumber").value.trim();
//     var cardNumberPattern = /^[\d]{4}\s*[\d]{4}\s*[\d]{4}\s*[\d]{4}$/; // 16位数字
//     if (!cardNumberPattern.test(cardNumber)) {
//         alert("Please enter a valid card number with the example format 1234 5678 1234 5678.");
//         return false;
//     }
//     return true;
// }

// function validatePinNumber() {
//     var pinNumber = document.getElementById("PinNumber").value;
//     var pinNumberPattern = /^\d{6}$/; // 6位数字
//     if (!pinNumberPattern.test(pinNumber)) {
//         alert("Pin Number must be exactly 6 digits with no space.");
//         return false;
//     }
//     return true;
// }



function validateForm() {
    var phoneNumber = document.getElementById("PhoneNumber").value.trim();
    var cardNumber = document.getElementById("CardNumber").value.trim();
    var pinNumber = document.getElementById("PinNumber").value;

    var phoneNumberPattern = /^[\d]{4}\s*[\d]{4}$/; // 8位数字
    var cardNumberPattern = /^[\d]{4}\s*[\d]{4}\s*[\d]{4}\s*[\d]{4}$/; // 16位数字
    var pinNumberPattern = /^\d{6}$/; // 6位数字


    var email = document.getElementById("Email").value.trim();
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    
    if (!emailPattern.test(email)) {
        alert("Invalid email format. Please enter a valid email address.");
        return false;
    }

    if (!phoneNumberPattern.test(phoneNumber)) {
        alert("Phone Number must be 8 digits with the example format 1234 5678.");
        return false;
    }

    if (!cardNumberPattern.test(cardNumber)) {
        alert("Card Number must be 16 digits with the example format 1234 5678 1234 5678.");
        return false;
    }

    if (!pinNumberPattern.test(pinNumber)) {
        alert("Pin Number must be exactly 6 digits with no space.");
        return false;
    }

    return true; // 表单通过验证
}

document.getElementById("finishpayment").addEventListener("submit", function(event) {
    if (!validateForm()) {
        event.preventDefault(); // 阻止表单提交
    }
});


function getvalue() {
        var showtimeString = "";
        var cinema ="";
        var cinema_id = <?php echo $cinema_id; ?>;
        var session_id = <?php echo $session_id; ?>;
        if (cinema_id == "1" && session_id == "1") {
            showtimeString = "<?php echo $row['NS1']?>";
        } else if (cinema_id == "1" && session_id == "2") {
            showtimeString = "<?php echo $row['NS2']?>";
        }else if (cinema_id == "2" && session_id == "2") {
            showtimeString = "<?php echo $row['SS2']?>";
        }else if (cinema_id == "2" && session_id == "1") {
            showtimeString = "<?php echo $row['SS1']?>";
        }



        if (cinema_id == '1'){
            cinema = "NorthSpine";
        } else if (cinema_id == '2'){
            cinema = "SouthSpine";
        }
        document.getElementById('CinemaPlace').value = cinema;
        document.getElementById('showtimeString').value = showtimeString;
    }

</script>
<script src="home.js"></script>





</body>
</html>