<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie Booking</title>
    <meta charset="utf-8">
    <!-- <script type="text/javascript" src="register.js"></script> -->
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <header>
        <img src="easymoviesbooking.png" alt="header" height="150" width="500">
    </header>

    <div class="register-box">
        <a href="home.php">❮ Back To Home</a>
        <h2>Register</h2>
        <form method="post" action="registeruser.php" id="registerform">
            <input type="text" name="username" id="username" placeholder="User Name"><br>
            <input type="text" name="phone" id="phone" placeholder="Phone"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="email" name="email" id="email" placeholder="Email">
            <!-- oninput="validateEmail(this)"
            <p id="email-feedback" style="color: red; display: none;"></p> -->

            <input type="reset" value="Reset">
            <input type="submit" value="Register">
        </form>


    </div>

    <div class="footer">
        <footer>
            ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any form
            without our written permission.
        </footer>
    </div>
    <script type="text/javascript" src="register.js"></script>

</body>