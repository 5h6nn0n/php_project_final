<?php
/*
	Author: 5h6nn0n
	Registered/orders Page 2 of 5
    Filename: addOrderForm.php 
*/
$status = session_status();
if ($status == PHP_SESSION_NONE) 
{
    session_start();
}
require('../../inc/db_connect.php');


// select all orders 
$queryAllOrders = 'SELECT * FROM orders
				   ORDER BY orderID';                 
$statement2 = $db->prepare($queryAllOrders);
$statement2->execute();
$orders = $statement2->fetch();
$statement2->closeCursor();
// select all users 
$queryAllUsers = 'SELECT * FROM users
				  ORDER BY userID';
$statement3 = $db->prepare($queryAllUsers);
$statement3->execute();
$users = $statement3->fetchAll();
$statement3->closeCursor();

// filter variables
if(!isset($user_id)) 
{
	$user_id = $_SESSION['user']['userID']; // current user session
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
				<td><label>User ID:</label>	</td>
				<td><p><?php echo $user_id; ?></p></td>
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
			<input type="hidden" name="user_id"
				value="<?php echo $user_id; ?>" ><br>
			
			<input type="hidden" name="order_id"
				value="<?php echo $order['order_id']; ?>" ><br>
			
            <input type="submit" value="Place Order"><br>
			</form>
		</table>
		<p><a href="http://localhost/project/registered/items/viewCart.php">Back to Cart</a></p>
	</main>
    <footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>	
			  
			  
			  