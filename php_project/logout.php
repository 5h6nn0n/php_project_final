<?php
/* 
	Home Page 4 of 4
	File: logout.php
*/

// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: login.php");
exit();
?>
