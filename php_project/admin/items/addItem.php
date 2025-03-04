<?php
/* 
	Author: 5h6nn0n
	Admin/items Page 4 of 6 
	File: addItem.php
*/

require_once('../../inc/db_connect.php');

// Get the item data
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_GET, 'code');
$name = filter_input(INPUT_GET, 'name');
$desc = filter_input(INPUT_GET, 'desc');
$price = filter_input(INPUT_GET, 'price', FILTER_VALIDATE_FLOAT);

	// queries a count of all item codes
	$queryItems = 'SELECT COUNT(*) FROM items 
	               WHERE itemCode =:code';
		$stmt = $db->prepare( $queryItems);
		$stmt->bindValue(':code', $code);
        $stmt->execute();
        $countcode = $stmt->fetchColumn();

// validate inputs
if ($category_id == null || $category_id == false || $code == null || 
		$code == false || $name == null || $desc == null || 
		$price == null || $price == false || $price <= 0) 
{
	include('../../inc/error.php'); // shows error message page.
	// troubleshooting purposes
	echo "The data you've entered: "."<br><br>";
	echo "category-id: ".$category_id."<br>";
	echo "code:        ".$code."<br>";
	echo "name:        ".$name."<br>";
	echo "description: ".$desc."<br>";
	echo "price:       ".$price."<br><br>";
	
	//validate itemCode as a uniqueIndex.	
	if ($countcode > 0)
	{
		echo "The item code must be a unique value.";
	}
}
else 
{
    // Add the item to the database  
    $query2 = 'INSERT INTO items
                 (categoryID, itemCode, itemName, itemDesc, itemPrice)
              VALUES
                 (:category_id, :code, :name, :desc, :price)';
    $statement = $db->prepare($query2);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':desc', $desc);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();

    // Display the Item List page
    include('index.php');
}
?>