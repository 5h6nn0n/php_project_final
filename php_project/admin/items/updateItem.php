<?php
/*
	Author: 5h6nn0n
	Admin/items Page 6 of 6 
	File: updateItem.php
*/

//fetch inputs
$item_id = filter_input(INPUT_GET, 'item_id', FILTER_VALIDATE_INT);
$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_GET, 'code');
$name = filter_input(INPUT_GET, 'name');
$desc = filter_input(INPUT_GET, 'desc');
$price = filter_input(INPUT_GET, 'price');

//validate inputs
if ($item_id == null || $item_id == false || $cat_id == null || 
		$cat_id == false || (($cat_id > 3)&&($cat_id < 0)) || 
		$code == null || $code == false || $name == null || 
		$desc == null || $price == null || $price == false || $price <=0) 
{
    include('../../inc/error.php'); // shows error message page.
	
	// troubleshooting purposes
	echo "The data you've entered: "."<br><br>";
	echo "item-id:     ".$item_id."<br>";
	echo "category-id: ".$cat_id."<br>";
	echo "code:        ".$code."<br>";
	echo "name:        ".$name."<br>";
	echo "description: ".$desc."<br>";
	echo "price:       ".$price."<br><br>";	
}
else 
{
    require_once('../../inc/db_connect.php');

	// update the item attributes
	$queryUpdateItem = 'UPDATE items
						SET categoryID = :cat_id, itemCode = :code, 
						itemName = :name, itemDesc = :desc, itemPrice = :price
						WHERE itemID =:item_id';
				 
    $statement = $db->prepare($queryUpdateItem);
	$statement->bindValue(':item_id', $item_id);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':desc', $desc);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
    
	// syncs the category id variables	
	$category_id = $cat_id;
	
    // Display the Product List page
	echo "Update successful!";
    include('index.php');
}	

?>