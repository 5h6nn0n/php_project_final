<!--
	Author: 5h6nn0n
	Registered/items page 2 of 5
    Filename: viewItems.php
-->

<!DOCTYPE HTML>

<html>

<head>
	<title>Final Project	</title>
	<link rel = "stylesheet" href = "../../main.css">
</head>

<body>
	<header>
		<h1>View Items </h1>
	</header>
	<br>
	<main>
	
<!--- section 1 -- dropdown list of categories -->

		<h2> List of Categories </h2>
		<p> <?php echo $msg1; ?> </p>
		<form action = "index.php" method = "get" >
			<select name="cat_id">
				<?php foreach($categories as $cat_list) : ?>
				<option value = " <?php echo $cat_list["categoryID"]; ?> ">
						<?php echo $cat_list["categoryName"]; ?>
				</option>;				
				<?php endforeach; ?>
			</select>
            <input type="submit" name= "action" value="List Select">
		</form>
<br><br>	
	
<!--- section 2 -- Table to show all items in that category -->

<?php if(isset($cat_id)) { ?>
	<table>
		<?php foreach ($categories as $cat_table) { 
				if ($cat_id == $cat_table["categoryID"]) {
				echo "<tr><th><h2>"."Items of category: ".$cat_table["categoryName"]."</h2></th></tr>";
		} }
		?>		

		<?php foreach ($items as $item_table) : ?>
		<tr>
			<td> <?php echo $item_table["itemName"]; ?> </td>
				
			<td><form action = "index.php" method = "get">
			
				<input type= "hidden" name = "item_id" 
					value = "<?php echo $item_table["itemID"]; ?> "> 
				<input type= "hidden" name = "cat_id" 
					value = "<?php echo $item_table["categoryID"]; ?> "> 
				<input type= "submit" name = "action" 
					value = "View Details" >
				</form>
			</td>
		</tr>
		<?php endforeach;  ?>
	</table>
<?php } else { echo "Please select a category to view items";  } ?>
<br>

<!--- section 3 -- view details of the item selected from table  --->
	
<?php if ($action == "View Details") { ?>
<?php if(isset($item_id)) { ?>

	<p> <?php echo $err_msg1; ?> </p>
	<table>
		<form action = "addToCart.php" method = "post">
		
		<?php  foreach($items as $detail) :
			if ($item_id == $detail["itemID"]) 
			{
				$item_cat = $detail["categoryID"] - 1;
				$itemCat = $categories[$item_cat]; // 1 row 
	
				echo "<h2>ID of Selected Item: ".$detail['itemID']."</h2>";
			?>
		<tr>
			<label><th>Category</th></label>
			<td><?php  echo $itemCat["categoryName"]; ?></td>
		</tr>
		<tr>
			<label><th>Code</th></label>
			<td><?php  echo $detail["itemCode"]; ?></td>
		</tr>
		<tr>
			<label><th>Item Name</th></label>
			<td><?php  echo $detail["itemName"]; ?></td>
		</tr>
		<tr>
			<label><th>Description</th></label>
			<td><?php  echo $detail["itemDesc"]; ?></td>
		</tr>
		<tr>
			<label><th>Price</th></label>
			<td><?php  echo '$'.$detail["itemPrice"]; ?></td>
		</tr>
		<tr>
			<label><th>Discount</th></label>
			<td><?php  echo '$'.$detail["itemSale"]; ?></td>
		</tr>
		<tr>
			<label><th>Quantity</th></label>
			<td><input type="text" name="quantity"></td>
		</tr>
			<td>
				<input type= "hidden" name = "item_id" 
					value = "<?php echo $detail["itemID"]; ?> "> 
				<input type= "hidden" name = "price" 
					value = "<?php echo $detail["itemPrice"]; ?> ">
				<input type= "hidden" name = "sale" 
					value = "<?php echo $detail["itemSale"]; ?> ">
				<input type= "hidden" name = "name" 
					value = "<?php echo $detail["itemName"]; ?> ">
					
				<input type= "submit" name = "action" value = "Add To Cart" >
		</form>
		</td>		
		<?php } endforeach; ?>
	</table>		
<?php } } ?>
<br><br>	
		<p><a href="viewCart.php">View Cart</a></p>
		<p><a href="http://localhost/project/index.php">Back to home</a></p>
	</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>