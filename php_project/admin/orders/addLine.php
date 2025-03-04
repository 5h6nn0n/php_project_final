<?php
/*
	Author: 5h6nn0n
	Admin/orders Page 3 of 3
	File: addLineForm.php 
*/

// Get the order data
$item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

if(!isset($order_id))
{
	$order_id = filter_input(INPUT_POST, 'order_id');
}

// Validate inputs
if ($item_id == null || $item_id == false || $item_id <=0 ||
	$quantity == null || $quantity == false || $quantity <=0) 
{
	include('../../inc/error.php'); // shows error message page.
	
	// troubleshooting purposes
	echo "The data you've entered: "."<br><br>";
	echo "item-id:  ".$item_id."<br>";
	echo "quantity: ".$quantity."<br>";
} 
else 
{
	require_once('../../inc/db_connect.php');
	
	$queryAllProd= 'SELECT * FROM items 
					WHERE itemID = :item_id';
	$statement4 = $db->prepare($queryAllProd);
	$statement4->bindValue(':item_id', $item_id);
	$statement4->execute();
	$line = $statement4->fetchAll();
	$statement4->closeCursor();

	foreach ($line as $item) 
	{
		$itemPrice = $item['itemPrice'];
		$itemSale = $item['itemSale'];
		$discount = ($quantity * $itemSale);
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

    // Display the order table page
    include('addLineForm.php');
}
?>


