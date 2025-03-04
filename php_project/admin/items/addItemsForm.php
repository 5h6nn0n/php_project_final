<?php
/*
	Author: 5h6nn0n
	Admin/items Page 3 of 6 
	File: addItemsForm.php
*/

// connect to database 
require('../../inc/db_connect.php');

// to display in a dropdown list 
$queryAllCategories = 'SELECT * FROM categories
					   ORDER BY categoryID';
$statement4 = $db->prepare($queryAllCategories);
$statement4->execute();
$categories = $statement4->fetchAll();
$statement4->closeCursor();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Final Project</title>
		<link rel="stylesheet" type="text/css" href = "../../main.css">
	</head>
<body>
    <header>
		<h1>Item Manager</h1>
	</header>

    <main>
        <h1>Add items to the database</h1>
		
		<table>
			<form action="addItem.php" method="get" id="add_item_form">
			<tr>
				<td><label>Category:</label></td>
				<td>
				<select name="category_id">
					<?php foreach ($categories as $category) : ?>
					<option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
					</option>
					<?php endforeach; ?>
				</select>
				</td>
			</tr>
			<tr>
				<td><label>Code:</label></td>
				<td><input type="text" name="code"></td>
			</tr>
			<tr>
				<td><label>Name:</label></td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td><label>Description:</label></td>
				<td><input type="text" name="desc"></td>
			</tr>
            <tr>
				<td><label>Price:</label></td>
				<td><input type="text" name="price"></td>
			</tr>
            <tr>
				<td><label>&nbsp;</label></td>
				<td><input type="submit" value="Add Items"></td>
			</tr>
			</form>
		</table>
		 <p><a href="index.php">Back to Items List</a></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>