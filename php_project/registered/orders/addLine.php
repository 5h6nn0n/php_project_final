<?php
/*
	Author: 5h6nn0n
	Registered/orders Page 5 of 5
	Filename: addLine.php 
*/

// Get the order data from addLineForm.php
$item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$line_id = filter_input(INPUT_POST, 'line_id', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'action');

if(!isset($order_id))
{
	$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
}

// if user selects add an item to order
if ($action = "Add Item" && $quantity != null)
{
	// Validate the inputs
	if ($item_id == null || $item_id == false || $item_id <=0
		|| $quantity == null || $quantity == false || $quantity <=0) 
	{
		include('../../inc/error.php'); // show error message page, if validation fails.
		// for troubleshooting purposes
		echo "The data you've enetered: <br><br>";
		echo "Item ID: ".$item_id."<br><br>";
		echo "quantity: ".$quantity."<br><br>";
	} 
	else 
	{
		require_once('../../inc/db_connect.php');
	
		$queryAllItems= 'SELECT * FROM items 
						 WHERE itemID = :item_id';
		$statement4 = $db->prepare($queryAllItems);
		$statement4->bindValue(':item_id', $item_id);
		$statement4->execute();
		$line = $statement4->fetchAll();
		$statement4->closeCursor();

		foreach ($line as $item) 
		{	
			$itemPrice = $item['itemPrice'];
			$discount = $quantity * $item['itemSale'];
			$linePrice = ($itemPrice * $quantity) - $discount;
		}
	
		// Add the order item to the database  
		$query2 = 'INSERT INTO orderItems
						(orderID, itemID, linePrice, discount, quantity)
				   VALUES
						(:order_id, :item_id, :linePrice, :discount, :quantity)';
		$statement5 = $db->prepare($query2);
		$statement5->bindValue(':order_id', $order_id);
		$statement5->bindValue(':item_id', $item_id);
		$statement5->bindValue(':linePrice', $linePrice);
		$statement5->bindValue(':discount', $discount);
		$statement5->bindValue(':quantity', $quantity);
		$statement5->execute();
		$statement5->closeCursor();
	
		// select aggregate function for order total amount
		$queryOI = 'SELECT sum(linePrice)
					FROM orderItems
					WHERE orderID = :order_id';
		$statement2 = $db->prepare($queryOI);
		$statement2->bindValue(':order_id', $order_id);
		$statement2->execute();
		$OI = $statement2->fetch();
		$orderTotal = $OI[0];
		$statement2->closeCursor();

		// updates the order total after adding an item
		$query3 = 'UPDATE orders 
				SET orderID = :order_id,
				orderTotal = :orderTotal
				WHERE orderID = :order_id';
		$statement6 = $db->prepare($query3);
		$statement6->bindValue(':orderTotal', $orderTotal);
		$statement6->bindValue(':order_id', $order_id);
		$statement6->execute();
		$statement6->closeCursor();

		// Display the order table page confirmation 
		echo "<h3>Success! The item has been added to your order.</h3>";
		echo "<h2>Your new order total is: $".$orderTotal."</h2><br>";
		include('addLineForm.php');
	} 
}

// if user selects cancel an item from order
if ($action = "Cancel Item" && $line_id != null) 
{
	// Validate the inputs
	if ($line_id == null || $line_id == false || $order_id == null || $order_id == false) 
	{
		include('../../inc/error.php'); // show error message page, if validation fails.
		echo "Line ID: ".$line_id."<br><br>";
		echo "Order ID: ".$order_id."<br><br>";
	} 
	else 
	{
		require_once('../../inc/db_connect.php');	
		
		$deleteItem = 'DELETE FROM orderItems
						WHERE lineID = :line_id';
		$statement9 = $db->prepare($deleteItem);
		$statement9->bindValue(':line_id', $line_id);
		$statement9->execute();
		//$lastLine = $db->lastInsertId();     
		$statement9->closeCursor(); 
		
		// select aggregate function for order total amount
		$queryOI = 'SELECT sum(linePrice)
					FROM orderItems
					WHERE orderID = :order_id';
		$statement2 = $db->prepare($queryOI);
		$statement2->bindValue(':order_id', $order_id);
		$statement2->execute();
		$OI = $statement2->fetch();
		$orderTotal = $OI[0];
		$statement2->closeCursor();

		// updates the order total after adding an item
		$query3 = 'UPDATE orders 
				SET orderID = :order_id,
				orderTotal = :orderTotal
				WHERE orderID = :order_id';
		$statement6 = $db->prepare($query3);
		$statement6->bindValue(':orderTotal', $orderTotal);
		$statement6->bindValue(':order_id', $order_id);
		$statement6->execute();
		$statement6->closeCursor();
				
		// message for selective deletion of an item
		echo "<h3>Success! Your refund is processing.</h3>";
		echo "<h2>Your new order total is: $".$orderTotal."</h2><br>";
		include('addLineForm.php');

		if ($orderTotal < 1 || $orderTotal = null) {
			
			$deleteOrder = 'DELETE FROM orders
						WHERE orderID = :order_id';
			$statement8 = $db->prepare($deleteOrder);
			$statement8->bindValue(':order_id', $order_id);
			$statement8->execute();
			$statement8->closeCursor();
		} 
	}
}
else 
{
	echo " "; // blank space
}

?>


