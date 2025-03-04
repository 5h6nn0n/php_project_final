<?php
/*
	Author: 5h6nn0n
	Guest/items Page 6 of 8
    Filename: addOrderForm.php 
*/

// check session status 
$status = session_status();
if ($status == PHP_SESSION_NONE) 
{
    session_start(); // open a session if none exists
}
require('../../inc/db_connect.php');

// select all orders 
$queryAllOrders = 'SELECT * FROM orders
				   ORDER BY orderID';                 
$statement2 = $db->prepare($queryAllOrders);
$statement2->execute();
$orders = $statement2->fetch();
$statement2->closeCursor();


// filter variables
if(!isset($guest_id)) 
{
	$guest_id = $_SESSION['guest']; // current guest session
}
if(!isset($order_id)) 
{
	$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
}
if(!isset($cartID)) 
{
	$cartID = filter_input(INPUT_POST, 'cartID', FILTER_VALIDATE_INT);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css">
</head>

<body>
    <header><h1>Orders</h1></header>

    <main>
		<h1>Add Order</h1>
		<table>
			<form action="addOrder.php" method="post" id="add_order_form">
			
			<tr>
				<td><label>Guest ID</label></td>
				<td><p><?php echo $guest_id; ?></p></td>
			</tr>
			<tr>
				<td><label>Card Type:</label></td>
				<td><select name="cardType">
					<option value="Visa">
						<?php echo "Visa"; ?>
					</option>
					<option value="Mastercard">
						<?php echo "Mastercard"; ?>
					</option>
					<option value="American Express">
						<?php echo "American Express"; ?>
					</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Card Number:</label></td>
				<td><input type="text" name="cardNumber"></td>
			</tr>
			<tr>
				<td><label>Card Expiration:</label> </td>
				<td><input type="text" name="cardExpires"></td>
			</tr>
			<tr>
				<td><label>Shipping Address:</label> </td>
				<td><input type="text" name="ship_id" ></td>
			</tr>
			<tr>	
				<td><label>Billing Address:</label> </td>
				<td><input type="text" name="bill_id" ></td>
			</tr>
			
			<input type="hidden" name="order_id"
				value="<?php echo $order['order_id']; ?>" ><br>
			
            <input type="submit" value="Place Order"><br>
			</form>
		</table>
		<p><a href="http://localhost/project/guest/items/viewCart.php">Back to Cart</a></p>
	</main>
    <footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>	
			  
			  
			  