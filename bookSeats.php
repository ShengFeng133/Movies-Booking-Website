<?php

$host = "localhost";
$username = "cq";
$password = "cq123";
$database = "cq";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movie_id = $_POST['movie_id'];
$cinema_id = $_POST['cinema_id'];
$session_id = $_POST['session_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedSeats = explode(',', $_POST['selectedSeats']);
    foreach ($selectedSeats as $seatId) {
        
        $stmt = $conn->prepare("SELECT * FROM seat_status WHERE seat_id = ? AND status = 'free' AND movie_id = ? AND cinema_id = ? AND session_id = ?");
        $stmt->bind_param("siii", $seatId, $movie_id, $cinema_id, $session_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $seat = $result->fetch_assoc();

        if ($seat) {
            
            $updateStmt = $conn->prepare("UPDATE seat_status SET status = 'booked' WHERE seat_id = ? AND movie_id = ? AND cinema_id = ? AND session_id = ?");
            $updateStmt->bind_param("siii", $seatId, $movie_id, $cinema_id, $session_id);
            $updateStmt->execute();
            
        } else {
            
            
            echo "Error: Seat $seatId is already booked.";
            exit;
        }
    }
    
}


$conn->close();

?>
