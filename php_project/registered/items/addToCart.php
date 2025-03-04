<?php
/*
	Author: 5h6nn0n
	Registered/items page 4 of 5
    Filename: addToCart.php
*/

// first time start new session 
$status = session_status();

if($status == PHP_SESSION_NONE)
{
    //There is no active session
    session_start();
}

//start a cart session if there isn't one already
if(empty($_SESSION['shoppingCart']))
{ 
	$_SESSION['shoppingCart'] = array();
}

//identify the submit button
$action = filter_input(INPUT_POST, 'action');

//retrieve the values of the item selected
$itemID = 	filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$itemPrice = filter_input(INPUT_POST, 'price');
$itemSale = filter_input(INPUT_POST, 'sale');
$itemName = filter_input(INPUT_POST, 'name');
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
 
 
//validate inputs.
if ($quantity == null || $quantity == false || ($quantity < 0) || 
		$itemPrice == null || $itemPrice == false) 
{
	include('../../inc/error.php'); // shows error message page.
	// for troubleshooting purposes 
	echo "The quantity you entered: ".$quantity."<br>";
	echo "price: ".$itemPrice."<br>"."sale: ".$itemSale;
	
	
} else {

//selected item details are placed into an array. 
 $select = array( 
					'itemPrice'=> $itemPrice,
					'itemSale'=> $itemSale,
			        'quantity'=> $quantity,
					'itemName'=> $itemName
				);

//Insert into the cart with the itemID as the key to prevent duplicates. 
$_SESSION['shoppingCart'][$itemID] = $select;

include("viewCart.php");

//session_destroy(); // for testing purposes 
}
?>

