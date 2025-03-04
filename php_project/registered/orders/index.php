<?php
/*
	Author: 5h6nn0n
	Registered/orders Page 1 of 5
    Filename: index.php for orders folder
*/
	
// index for orders/registered
$status = session_status();
if ($status == PHP_SESSION_NONE) 
{
    session_start();
}
require_once("../../inc/db_connect.php"); 

$action = filter_input(INPUT_GET, 'action');

if (!isset($user_id)) 
{
	$user_id = $_SESSION['user']['userID'];	
}
if(!isset($order_id)) 
{
	$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
}

//query all orders placed by the user  
$queryAllorders = 'SELECT * FROM orders 
					WHERE userID = :user_id
				   ORDER BY orderID';
$statement1 = $db->prepare($queryAllorders);
$statement1->bindValue(':user_id', $user_id);
$statement1->execute();
$orders = $statement1->fetchAll();
$statement1->closeCursor();

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>
		Final Project
	</title>
	<link rel = "stylesheet" href = "../../main.css">
</head>
<body>
	<header>
		<h1>Your Order History</h1>
	</header>
	<main>
<!--- Table to show orders -->
	<h1>Order List</h1>
	<table>
		<tr> 
			<th>OrderID</th>
			<th>UserID</th>
			<th>Order Date</th>
			<th>Card Type</th>
			<th>Card Number</th>
			<th>Card Expiration</th>
			<th>Order Total</th>
		</tr>
		<?php foreach ($orders as $order_table) :	?>		
		<tr>
			<td> <?php echo $order_table["orderID"]; ?> </td>
			<td> <?php echo $order_table["userID"]; ?> </td>
			<td> <?php echo $order_table["orderDate"]; ?> </td>
			<td> <?php echo $order_table["cardType"]; ?> </td>
			<td> <?php echo $order_table["cardNumber"]; ?> </td>
			<td> <?php echo $order_table["cardExpires"]; ?> </td>
			<td> <?php echo $order_table["orderTotal"]; ?> </td>
			<td>
				<form action = "addLineForm.php" method = "post">

				<input type="hidden" name="order_id" 
						value="<?php echo $order_table['orderID']; ?>">
				<input type="hidden" name="user_id" 
						value="<?php echo $user_id; ?>">
				<input type= "submit" name = "action" value = "Edit" >
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="http://localhost/project/index.php">Back to home</a></p>
	</main>
	<footer>
	        <p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>