<?php
/* 
	Author: 5h6nn0n
	Admin/orders Page 1 of 3
	File: index.php 
*/

// connect to database
require_once('../../inc/db_connect.php'); 

$action = filter_input(INPUT_POST, 'action');

if(!isset($order_id)) 
{
	$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
}
// query all orders to view
$queryAllOrders = 'SELECT * FROM orders 
				   ORDER BY orderID';
$statement1 = $db->prepare($queryAllOrders);
$statement1->execute();
$orders = $statement1->fetchAll();
$statement1->closeCursor();

?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Final Project</title>
	<link rel = "stylesheet"type="text/css" href = "../../main.css">
</head>

<body>
	<header>
		<h1>All Orders </h1>
	</header>
	
	<main>
<!--- Table to show all orders -->
		<h1>Order List</h1>
		<br>
		<table>
		<tr> 
			<th>Order-ID</th>
			<th>User-ID</th>
			<th>Order-Date</th>
			<th>Card-Type</th>
			<th>Card-Number</th>
			<th>Card-Exp</th>
			<th>Shipping-Charged</th>
		</tr>
		<?php foreach ($orders as $order) :	?>		
		<tr>
			<td> <?php echo $order["orderID"]; ?> </td>
			<td> <?php echo $order["userID"]; ?> </td>
			<td> <?php echo $order["orderDate"]; ?> </td>
			<td> <?php echo $order["cardType"]; ?> </td>
			<td> <?php echo $order["cardNumber"]; ?> </td>
			<td> <?php echo $order["cardExpires"]; ?> </td>
			<td> $<?php echo $order["shipCost"]; ?> </td>
			<td>
				<form action = "addLineForm.php" method = "post">

				<input type="hidden" name="order_id" 
						value="<?php echo $order['orderID']; ?>">

				<input type= "submit" name = "action" value = "Add Items" >
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
		
	<p><a href="http://localhost/project/index.php">Admin homepage</a></p>
	</main>

<footer>
	<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
</footer>
</body>
</html>