<?php
// if (isset($_GET['error'])) {
//     echo '<script>alert("Invalid username or password. ");</script>';
//     unset($_SESSION['error']);
// }
?>

<?php 

include "homelogin.php";

$loggedIn = isset($_SESSION['validuser']);

$destinationURL = $loggedIn ? 'bookingdetails.php' : 'checkbooking.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Movie Booking</title>
  <meta charset="utf-8">
  <!-- <script type="text/javascript" src="detectpricechange.js"></script>  -->
  <link rel="stylesheet" href="home.css">
</head>

<body>
  <header>
    <img src="easymoviesbooking.png" alt="header" height="150" width="500">
  </header>

  <div id="navigation">
    <ul>
      <li><a href="aboutus.php">About Us</a></li>
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

  <br><br>

  <div class="slideshow-container">
    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <a href="movies&showtime.php?MovieName=Titanic">
        <img src="TitanicPoster.jpg"" style="width:100%">
      </a>
      <!-- <div class="text">Trolls</div> -->
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <a href="movies&showtime.php?MovieName=Avatar">
        <img src="AvatarPoster.jpg" style="width:100%">
      </a>
      <!-- <div class="text">Taylor Swift The Eras Tour</div> -->
    </div>

    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <a href="movies&showtime.php?MovieName=Inception">
        <img src="InceptionPoster.jpg" style="width:100%">
      </a>
      <!-- <div class="text">Marvel</div> -->
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>
  </div>
  <br>

  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

  <div class="movie-container">
    <div class="movie">
      <a href="movies&showtime.php?MovieName=Titanic">
        <img src="TitanicPoster.jpg" alt="Movie 1">
      </a>
      <h3>Titanic</h3>
      <a href="movies&showtime.php?MovieName=Titanic" class="buyticket"> Buy Ticket
      </a>
    </div>

    <div class="movie">
      <a href="movies&showtime.php?MovieName=Avatar">
        <img src="AvatarPoster.jpg" alt="Movie 2">
      </a>
      <h3>Avatar</h3>
      <a href="movies&showtime.php?MovieName=Avatar" class="buyticket"> Buy Ticket
      </a>
    </div>

    <div class="movie">
      <a href="movies&showtime.php?MovieName=Inception">
        <img src="InceptionPoster.jpg" alt="Movie 3">
      </a>
      <h3>Inception</h3> 
      <a href="movies&showtime.php?MovieName=Inception" class="buyticket">Buy Ticket
      </a>
    </div>
  </div>



  <div class="footer">
    <footer>
      ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any form
      without our written permission.
    </footer>
  </div>
  <script src="home.js"></script>
  <!-- <script type="text/javascript" src="homeinvalidlogin.js"></script>  -->


</body>