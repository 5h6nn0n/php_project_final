<?php
/*
	Author: 5h6nn0n
	Guest/items Page 8 of 8
	Filename: confirmation.php 
*/

$status = session_status();
// check session status 
if ($status == PHP_SESSION_NONE) 
{
// open a session if none exists
    session_start(); 
}
// connect to database
require_once('../../inc/db_connect.php');


if(!isset($guest_id)) 
{
	$guest_id = $_SESSION['guest']; // current guest session
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css">
</head>

<body>
    <header><h1>Order Confirmation</h1></header>

    <main>
		<h1>Order #<?php echo $lastOrder; ?></h1>
		<div> Guest <?php echo $guest_id; ?>:
			Thank you for shopping with us!	
			Your order is on the way.
		</div>
		<br><br>
				
		<p><a href="http://localhost/project/guest/items/viewCart.php">Back to Cart</a></p>
		<p><a href="http://localhost/project/guest/index.php">Guest Home</a></p>
	</main>
	
    <footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>	
			  
			  
			  