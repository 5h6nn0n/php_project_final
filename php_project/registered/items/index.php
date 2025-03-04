<!--
	Author: 5h6nn0n
	Registered/items page 1 of 5
    Filename: index.php for items folder  
-->
   
<?php
require_once("../../inc/db_connect.php"); 

$action = filter_input(INPUT_GET, 'action');

$msg1 = "";
$err_msg1 = "";
if(!isset($cat_id)) 
{
	$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
	$msg1 = "Selected categoryID: ".$cat_id;
	
	if((is_null($cat_id)) || (!is_int($cat_id)) )
	{
		$err_msg1 = "Error -- must be int and cannot be null";
	}
}
if (!isset($item_id)) {
	$item_id = filter_input(INPUT_GET,'item_id',FILTER_VALIDATE_INT);	
	
	if((is_null($item_id)) || (!is_int($item_id)) )
	{
		$err_msg1 = "Error -- must be int and cannot be null";
	}
}

// 1 -- extract cat id from list select 
// query all categories 
$queryAllcategories = 'SELECT * FROM categories 
							ORDER BY categoryID';
$statement1 = $db->prepare($queryAllcategories);
$statement1->execute();
$categories = $statement1->fetchAll();
$statement1->closeCursor();

// 2 -- product table 
// query items where category 
$queryItems = 'SELECT * FROM items 
				  WHERE categoryID = :cat_id
				  ORDER BY itemID';
$statement2 = $db->prepare($queryItems);
$statement2->bindValue(':cat_id', $cat_id);
$statement2->execute();
$items = $statement2->fetchAll();
$statement2->closeCursor();

// 3 -- select from orderItem 
// query all orderItems 
$queryLines = 'SELECT * FROM orderItems 
					  WHERE itemID = :item_id
							ORDER BY lineID';
$statement3 = $db->prepare($queryLines);
$statement3->bindValue(':item_id', $item_id);
$statement3->execute();
$orderItems = $statement3->fetchAll();
$statement3->closeCursor();


// displays items 
include("viewItems.php");

?>


