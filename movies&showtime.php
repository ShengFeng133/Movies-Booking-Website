
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
        <img id="posterImage" src="<?php echo $row['MoviePoster'] ?>.jpg" alt="Movie Poster" style="width: 500px; height: 450px;">
    </div>

<form id="finishmovies&showtimes" action="seating.php?MovieName=<?php echo $row['MovieName'] ?>" method="post"> 
    <div id="MovieDetails">
        <div id="TitleDescription">
        <h1><?php echo $row['MovieName'] ?></h1>
        <p><?php echo $row['MovieDescription'] ?> </p> 
        </div>
        <br>
        <div id="regionselect">
        <label for="cinemaRegion"><b>Select Cinema Region:</b></label><br>
        <select id="cinemaRegion" onchange="updateShowtimeOptions()">
            <option value="NorthSpine">NorthSpine</option>
            <option value="SouthSpine">SouthSpine</option>
        </select>
        </div>
        <br>
        <div id="showtimeselect">
            <label for="showtime"><b>Select Showtime:</b></label><br>
            <select id="showtime">
            </select><br><br><br>
        </div>
        <input type="hidden" name="movie_id" value="<?php echo $row['MovieID']; ?>" id="movie_id">
        <input type="hidden" name="cinema_id" id="cinema_id" value="">
        <input type="hidden" name="session_id" id="session_id" value="">
        <input type="submit"  value="NEXT" id="showtimesubmit" style="width: 100px;">

    </div>
    </form>
</div>
</div>




    <script>
       function updateShowtimeOptions() {
    const cinemaRegion = document.getElementById('cinemaRegion');
    const showtime = document.getElementById('showtime');
    const cinemaIdInput = document.getElementById('cinema_id');
    const sessionIdInput = document.getElementById('session_id');
    showtime.innerHTML = '';

    if (cinemaRegion.value === 'NorthSpine') {
        addShowtimeOption('<?php echo $row['NS1'] ?>', 1);
        addShowtimeOption('<?php echo $row['NS2'] ?>', 2);
        cinemaIdInput.value = '1'; // 设置影院ID为1
    } else if (cinemaRegion.value === 'SouthSpine') {
        addShowtimeOption('<?php echo $row['SS1'] ?>', 1);
        addShowtimeOption('<?php echo $row['SS2'] ?>', 2);
        cinemaIdInput.value = '2'; // 设置影院ID为2
    }
    
    // 默认选择第一个场次
    sessionIdInput.value = '1'; // 可以根据需求调整
}

function addShowtimeOption(optionText, sessionId) {
    const option = document.createElement('option');
    option.text = optionText;
    option.value = sessionId; // 这里使用场次ID作为值
    document.getElementById('showtime').add(option);
}

// 监听场次选择变化
document.getElementById('showtime').addEventListener('change', function() {
    document.getElementById('session_id').value = this.value;
});

updateShowtimeOptions();
    </script>
        <script src="home.js"></script>

</body>
</html>