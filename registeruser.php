<?php

@ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'project');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
  $username=$_POST['username'];
  $phone=$_POST['phone'];
  $password=$_POST['password'];
  $email=$_POST['email'];

  

if (($username!=null) && ($phone!=null) && ($password!=null) && ($email!=null))
$query = "insert into customerdetails (username, phone, password, email)
values ('$username', '$phone', '$password', '$email')";       

  
  $result = $db->query($query);

  if (!$result)
  echo

  $db->close();
  header('Location: home.php');
  exit();
?>

