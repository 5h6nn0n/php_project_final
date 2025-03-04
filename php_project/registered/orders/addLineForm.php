<?php
/*
	Author: 5h6nn0n
	Registered/orders Page 3 of 5
	Filename: addLineForm.php 
*/
// first time start new session 
$status = session_status();

if($status == PHP_SESSION_NONE)
{
    //There is no active session
    session_start();
}
// connect to database
require_once('../../inc/db_connect.php');

if(!isset($user_id))
{
	$user_id = filter_input(INPUT_POST, 'user_id');
}
if(!isset($order_id))
{
	$order_id = filter_input(INPUT_POST, 'order_id');
}
if(!isset($item_id))
{
	$item_id = filter_input(INPUT_POST, 'item_id');
}

// query the items in each order
$queryItems = 'SELECT * FROM items
               WHERE itemID = :item_id';                 
$statement2 = $db->prepare($queryItems);
$statement2->bindValue(':item_id', $item_id);
$statement2->execute();
$items = $statement2->fetch();
$statement2->closeCursor();

// query selected order details
$queryOrderItems = 'SELECT * FROM orderItems 
					WHERE orderID = :order_id
					ORDER BY lineID';
$statement3 = $db->prepare($queryOrderItems);
$statement3->bindValue(':order_id', $order_id);
$statement3->execute();
$orderitem = $statement3->fetchAll();
$statement3->closeCursor();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css">
</head>

<body>
    <header>
		<h1>Order Items List</h1>
	</header>

    <main>
	<h3>Order placed by <?php $user_id; ?></h3>
	<table>	
		<form action="addLine.php" method="post">

		<h2> Order Items for orderID: 
		<?php echo $order_id; ?></h2>
		<tr>
			<th>Order#</th>
			<th>Item#</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Quantity</th>
		</tr>
		<?php foreach ($orderitem as $item) :  ?>
		<tr>
            <td><?php echo $item['orderID'];?></td>
            <td><?php echo $item['itemID'];?></td>
			<td><?php echo $item['linePrice'];?></td>
            <td><?php echo $item['discount'];?></td>
            <td><?php echo $item['quantity'];?></td>

		<td><input type="hidden" name="user_id"
				value="<?php echo $user_id; ?>" >
			
			<input type="hidden" name="order_id"
				value="<?php echo $item['orderID']; ?>" >
			
			<input type="hidden" name="item_id"
				value="<?php echo $item['itemID']; ?>" >
				
			<input type="hidden" name="line_id"
				value="<?php echo $item['lineID']; ?>" >
			
            <input type="submit" name="action" value="Cancel Item"></td>
		</tr>
			</form>	
				<?php endforeach;  ?>  
			
	</table>
	<br>
  
	<h2>Add Order Items for order ID: 
    <?php echo $order_id; ?></h2>

    <table>
		<form action="addLine.php" method="post"
              id="add_order_items">
		<tr>		  
			<td><label><?php echo "Item ID: "; ?></label></td>
			<td><input type="text" name="item_id" ></td>
		</tr>
		<tr>
			<td><label><?php echo "Quantity "; ?></label></td>
			<td><input type="text" name="quantity"></td>		   
		</tr>	   
			<input type="hidden" name="order_id" 
					value="<?php echo $order_id;?>" >
		    <input type="hidden" name="user_id" 
					value="<?php echo $user_id;?>" >
			<input type="submit" name="action" value="Add Item"><br>
        </form>
	</table>
	<br>
	<p><a href="index.php">Back to Order History</a></p>
</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>	