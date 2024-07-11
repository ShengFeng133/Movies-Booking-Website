<?php

$db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}

session_start();

if (isset ($_POST['email']) && isset ($_POST['password'])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM customerdetails WHERE email = '$email' AND password = '$password'";
    $result = $db->query($query);

    if ($result) {
        $row = $result->fetch_assoc();

        if ($row) {
            $username = $row['username'];

            $_SESSION['validuser']=$username;
            $_SESSION['password']=$password;

            header("Location: home.php");
            
        } else {

            echo '<script>alert("Invalid email or password. Please try again."); window.location.href = "home.php";</script>';            

        }
    } 

    
}
$db->close();
// }
?>
