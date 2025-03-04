<?php
/*
	Author: 5h6nn0n
	Admin/orders Page 2 of 3
	File: addLineForm.php 
*/

// connect to database
require_once('../../inc/db_connect.php');

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

// query select order details
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
		<h1>Order Manager</h1>
	</header>

    <main>
	<h1>Order List</h1>
	<table>	
		<h2> Order Items for orderID: 
		<?php echo $order_id; ?></h2>
		<tr>
			<th>Line#</th>
			<th>Order#</th>
			<th>Item#</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Quantity</th>
		</tr>
		<?php foreach ($orderitem as $item) :  ?>
		<tr>
			<td><?php echo $item['lineID'];?></td>
            <td><?php echo $item['orderID'];?></td>
            <td><?php echo $item['itemID'];?></td>
            <td><?php echo $item['linePrice'];?></td>
            <td><?php echo $item['discount'];?></td>
            <td><?php echo $item['quantity'];?></td>
		</tr>   
		<?php endforeach;  ?>  
	</table>
	<br>
  
	<h1>Add Order Items for order ID: 
    <?php echo $order_id; ?></h1>
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
			<input type="submit" value="Add Item"><br>
        </form>
	</table>
	<br>
	<p><a href="index.php">Back to Items List</a></p>

</main>
<footer>
	<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
</footer>

</body>
</html>	