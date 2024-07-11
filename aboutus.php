<?php 
include "homelogin.php";

$loggedIn = isset($_SESSION['validuser']);

$destinationURL = $loggedIn ? 'bookingdetails.php' : 'checkbooking.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Layout Page</title>
    <link rel="stylesheet" href="cqstyle.css">
    <link rel="stylesheet" href="home.css">
    <style>
        /* 样式整个页面的基本布局 */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* 头部样式 */
        header {
            background-color: #f1f1f1;
            text-align: center;
            padding: 20px;
        }

        /* 内容区域样式 */
        #content {
            display: flex;
            justify-content: space-around; /* 平均分布各部分 */
            padding: 20px;
        }

        /* 单个区块样式 */
        .section-middle {
            border: 3px solid #72693e; /* 边框 */
            padding: 20px;
            width: 40%; /* 占父容器的30%宽度 */
            box-sizing: border-box; /* 边框和内边距包含在宽度内 */
            border-radius: 5px; /* 这会使方格成为圆形 */
            display: flex; /* This enables flexbox */
            justify-content: center; /* This centers the child elements horizontally */
            align-items: center; /* This centers the child elements vertically */
            flex-direction: column; /* This stacks the child elements vertically */
        }


        .section-middle img {
        width: 80%;
        height: 80%;
    /* If you want to ensure the image doesn't exceed the section boundaries */
        max-width: 100%;
        max-height: 100%;
}

        .section-side {
            border: 3px solid #72693e; /* 边框 */
            padding: 20px;
            width: 20%; /* 占父容器的30%宽度 */
            box-sizing: border-box; /* 边框和内边距包含在宽度内 */
            border-radius: 5px; /* 这会使方格成为圆形 */
            display: flex; /* This enables flexbox */
            align-items: center; /* This centers the child elements vertically */
            flex-direction: column; /* This stacks the child elements vertically */
        }





        /* 表格样式 */
        table {
            width: 100%; /* 表格宽度占满整个容器 */
            margin-top: 20px; /* 与头部间隔 */
        }

        table td {
            text-align: center; /* 单元格文本居中 */
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <header>
            <img src="logo.png" width="500px" height="150px">
        </header>

        <!-- <table>
            <tr>
                <td><a href="aboutus.html"><b>About Us</b></a></td>
                <td><a href="viewbookingdetails.html"><b>View Booking Details</b></a></td>
                <td><b>Sign in/Register</b></td>
            </tr>
        </table> -->

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

        <div id="content">
            <div class="section-side">
                <p style="font-size: 25px;">The first cinema is located near the Lee Wee Nam Library, and its design is reminiscent of a library. Students can unwind by watching movies after a day of studying. </p>
                <img src="aboutus1.png" alt="Image Description" style="width: 100%; height: 60%;"> 
            </div>

            <div class="section-middle">
                <img src="aboutus3.png" alt="Image Description" > 
                <p style="font-size: 25px;">The EasyMovieBooking website was created by Chen Qi and Ng Sheng Feng to enhance the movie-watching experience at two cinemas in NTU.</p>
            </div>

            <div class="section-side">
                <p style="font-size: 25px;">The second cinema is located near the Hive, and its design is reminiscent of a hive. Students can unwind by watching movies after finishing their tutorials in the Hive.</p>
                <img src="aboutus2.png" alt="Image Description" style="width: 100%; height: 60%;"> 
            </div>
        </div>
    </div>
    <div class="footer">
    <footer>
      ©2023 Easy Movie Booking Pte Ltd. All rights reserved. No part of this website may be reproduced in any form
      without our written permission.
    </footer>
  </div>
    <script src="home.js"></script>

</body>
</html>
