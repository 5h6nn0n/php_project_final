<?php
/* 
	Author: 5h6nn0n
	Admin Page 1 of 6 
	File: index.php 
*/

// connect to database
require_once('../../inc/db_connect.php');

// Get category ID
if (!isset($category_id)) 
{
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
	
    if ($category_id == NULL || $category_id == FALSE) 
	{
        $category_id = 1; // defaulted to 1
    }
}

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
					   ORDER BY categoryID';
$statement1 = $db->prepare($queryAllCategories);
$statement1->execute();
$categories = $statement1->fetchAll();
$statement1->closeCursor();

// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement2 = $db->prepare($queryCategory);
$statement2->bindValue(':category_id', $category_id);
$statement2->execute();
$category = $statement2->fetch();
$category_name = $category['categoryName'];
$statement2->closeCursor();

// Get items for selected category
$queryItems = 'SELECT * FROM items
               WHERE categoryID = :category_id
               ORDER BY itemID';
$statement3 = $db->prepare($queryItems);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$items = $statement3->fetchAll();
$statement3->closeCursor();

// view items page 
include('viewItems.php');
?>
