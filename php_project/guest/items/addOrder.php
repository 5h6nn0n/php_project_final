<?php
/*
	Author: 5h6nn0n
	Guest/items Page 7 of 8
	Filename: addOrder.php 
*/
// first time start new session 
$status = session_status();

if($status == PHP_SESSION_NONE)
{
    //There is no active session
    session_start();
}

// Get the order data
$guest_id = filter_input(INPUT_POST, 'guest_id');
$cardType = filter_input(INPUT_POST, 'cardType');
$cardNumber = filter_input(INPUT_POST, 'cardNumber', FILTER_VALIDATE_INT);
$cardExpires = filter_input(INPUT_POST, 'cardExpires');
$ship_id = filter_input(INPUT_POST, 'ship_id');
$bill_id = filter_input(INPUT_POST, 'bill_id');
$orderDate = date("Y-m-d H:i:s");

// Validate inputs
if ($cardType == null || $cardNumber == null || $cardNumber == false || $cardNumber <0 
	|| $cardExpires == null || $cardExpires == false || $cardExpires <0) 
{
	include('../../inc/error.php'); // show error message page, if validation fails.	
	
} else {
	
    require_once('../../inc/db_connect.php');

	// Add the order to the database  
    $query1 = '
			INSERT INTO orders
                 (userID, orderDate, orderTotal, shipCost, cardType, cardNumber, cardExpires, orderShip, orderBill) 
              VALUES
                 (:user_id, :orderDate, :orderTotal, :shipCost, :cardType, :cardNumber, :cardExpires, :ship_id, :bill_id)';
    $statement4 = $db->prepare($query1);
    $statement4->bindValue(':user_id', $guest_id);
	$statement4->bindValue(':orderDate', $orderDate);
	$statement4->bindValue(':orderTotal', $_SESSION["totalDue"]);
	$statement4->bindValue(':shipCost', $_SESSION["shipCost"]);
    $statement4->bindValue(':cardType', $cardType);
    $statement4->bindValue(':cardNumber', $cardNumber);
    $statement4->bindValue(':cardExpires', $cardExpires);
	$statement4->bindValue(':ship_id', $ship_id);
    $statement4->bindValue(':bill_id', $bill_id);
    $statement4->execute();
	$lastOrder = $db->lastInsertId();
    $statement4->closeCursor();


	/* --- ADD LINE ITEMS FROM CART --- */

	foreach ($_SESSION['shoppingCart'] as $cartID => $fromCart):

	// Add each order item to the database  
	$query2 = 'INSERT INTO orderItems
			(orderID, itemID, linePrice, discount, quantity)
		VALUES
			(:order_id, :item_id, :linePrice, :discount, :quantity)';
	$statement5 = $db->prepare($query2);
	$statement5->bindValue(':order_id', $lastOrder);
	$statement5->bindValue(':item_id', $_SESSION['checkout'][$cartID]["item"]);
	$statement5->bindValue(':linePrice', $_SESSION['checkout'][$cartID]["linePrice"]);
	$statement5->bindValue(':discount', $_SESSION['checkout'][$cartID]["discount"]);
	$statement5->bindValue(':quantity', $_SESSION['checkout'][$cartID]["quant"]);
	$statement5->execute();
	$statement5->closeCursor();
	
	 endforeach;
	/* --- END OF LINE ITEMS --- */
	
	
    
	unset($_SESSION['shoppingCart']); // clear shopping cart session once order has been placed 
	unset($_SESSION['checkout']); // clear checkout session once order has been placed 
	// Display the order table page with confirmation message
	echo "<h2>Your order was sucessfully placed!</h2>";
    include('confirmation.php');

}
?>


