<?php
/*
	Author: 5h6nn0n
	Admin/items Page 5 of 6 
	File: updateItemForm.php
*/

if(!isset($item_id))
{
	$item_id = filter_input(INPUT_GET, 'item_id');

	if($item_id == null)
	{
		$error = "Error";
		echo $error;
	}
	else 
	{
		require('../../inc/db_connect.php');

		$queryItems = 'SELECT * FROM items
					   WHERE itemID = :item_id';                 
		$statement5 = $db->prepare($queryItems);
		$statement5->bindValue(':item_id', $item_id);
		$statement5->execute();
		$item = $statement5->fetch();
		$statement5->closeCursor();

		$queryAllCat = 'SELECT * FROM categories
						ORDER BY categoryID';
		$statement6 = $db->prepare($queryAllCat);
		$statement6->execute();
		$category = $statement6->fetchAll();
		$statement6->closeCursor();
	}
}
if(!isset($cat_id)) 
{
	$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
}

?>

<!DOCTYPE html>
<html>

	<head>
		<title>Final Project</title>
		<link rel="stylesheet" type="text/css" href="../../main.css">
	</head>

<body>
    <header>
		<h1>Item Manager</h1>
	</header>

    <main>
		<h1>Update an Existing Item</h1>
		<h2>Item # to Update: <?php echo $item_id ?></h2>
        <table>
			<tr>
				<td>
					<form action="updateItem.php" method="get" id="update_item_form">
					<label>Category ID:</label>
				</td>
				<td>
					<select name="cat_id">
					<?php foreach($category as $cat) : ?>
					<option value = "<?php echo $cat['categoryID']; ?> ">
						<?php echo $cat['categoryName']; ?>
					</option>			
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label>Item Code:</label>
				</td>	
				<td> 
					<input type="text" name="code" 
					value="<?php echo $item['itemCode'];?>" > 
				</td>
			</tr>
			<tr>
				<td> 
					<label>Item Name:</label>
				</td>
				<td>
					<input type="text" name="name" 
					value="<?php echo $item['itemName'];?>" >
				</td>
			</tr>
			<tr>
				<td> 
					<label>Description:</label> 
				</td>
				<td> 
					<input type="text" name="desc" 
					value="<?php echo $item['itemDesc'];?>" >
				</td>
			</tr>
			<tr>
				<td> 
					<label>Item Price:</label> 
				</td>
				<td> 
					<input type="text" name="price" 
					value="<?php echo $item['itemPrice'];?>" >
				</td>
			</tr>	
			
			<input type="hidden" name="item_id" value="<?php echo $item['itemID'];?>" ><br>
			
			<input type="submit" value="Update Item"><br>
					</form>
			</tr>
		</table>
		 <p><a href="index.php">Back to Items List</a></p>
	</main>

    <footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>	