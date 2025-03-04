<?php
/*
	Author: 5h6nn0n
	Guest/items page 5 of 8
    Filename: emptyCart.php
*/

// opens the session 
session_start();

// clears the session
unset($_SESSION['shoppingCart']);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css" />
</head>

<body>
	<header>
		<h1>Shopping Cart</h1>
	</header>
	
	<main>

		<?php if(empty($_SESSION["shoppingCart"])) { ?>
 
			<h1> Your Cart is now empty ! </h1>
 
		<?php } ?>
 
		<br/><br/>
		<a href="index.php">Keep Shopping</a> 
 
	</main>
 
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>	
 