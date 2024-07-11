<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Seat Selection</title>
    <link rel="stylesheet" href="cqstyle.css">

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
        background-color: #ff5252;
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


$db = new mysqli('localhost', 'cq', 'cq123', 'cq');

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



  $db1 = new PDO('mysql:host=localhost;dbname=cq', 'cq', 'cq123');

  function getSeatsStatus($db1) {
      $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : "";
      $cinema_id = isset($_POST['cinema_id']) ? $_POST['cinema_id'] : "";
      $session_id = isset($_POST['session_id']) ? $_POST['session_id'] : "";
      
      // 使用准备好的语句来安全地检索座位状态
      $stmt = $db1->prepare("SELECT seat_id, status FROM seat_status WHERE movie_id = :movie_id AND cinema_id = :cinema_id AND session_id = :session_id");
      
      $stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
      $stmt->bindParam(':cinema_id', $cinema_id, PDO::PARAM_INT);
      $stmt->bindParam(':session_id', $session_id, PDO::PARAM_INT);
  
      $stmt->execute();
  
      // 以关联数组的形式检索数据，其中 seat_id 是键，status 是值
      return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
  }
  
  // 传递正确的movie_id、cinema_id 和 session_id
  $_POST['movie_id'] = 1; // 你需要设置合适的值
  $_POST['cinema_id'] = 1; // 你需要设置合适的值
  $_POST['session_id'] = 1; // 你需要设置合适的值
  
  $seatsStatus = getSeatsStatus($db1);
  
  // 输出座位状态
  

?>




    <div id="wrapper">
        <header>
            <img src="logo.png" width="700px" height="200px">
        </header>

        <table>
            <tr>
              <td><a href="aboutus.html"><b>About Us</b></a></td>
              <td><a href="viewbookingdetails.html"><b>View Booking Details</b></a></td>
              <td><b>Sign in/Register</b></td>
            </tr>
          </table>


    <div id="movie">
    <div id="MoviePoster">
        <img id="posterImage" src="<?php echo $row['MoviePoster'] ?>.jpg" alt="Movie Poster" style="width: 500px; height: 450px;">
    </div>

    <form id="seatsForm" action="bookSeats.php" method="post">
<div id="seatingArea">
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
    </div>
    <input type="hidden" id="selectedSeatsInput" name="selectedSeats" value="">
    <input type="button" onclick="submitSeats()" value="Submit" style="width=25%">
    </form>
</div>
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
        for (var i = 0; i < selectedSeats.length; i++) {
            seatIds.push(selectedSeats[i].getAttribute('data-seat-id'));
        }
        document.getElementById('selectedSeatsInput').value = seatIds.join(',');
        document.getElementById('seatsForm').submit();
    }

    
    </script>
</body>
</html>
