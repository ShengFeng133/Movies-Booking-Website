<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the home page or any other page after logout
header("Location: home.php"); // Change "index.php" to your actual home page
exit();
?>