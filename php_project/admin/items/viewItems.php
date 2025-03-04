<!DOCTYPE html>
<html>
<!--
	Author: 5h6nn0n
	Admin/items Page 2 of 6 
	File: viewItems.php  
-->
<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href = "../../main.css" />
</head>
<body>
	<header>
		<h1>Item Manager</h1>
	</header>

<main>
    <h1>Item List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of items -->
        <h2><?php echo $category_name; ?></h2>
        <table>
			<tr>
                <th>Code</th>
                <th>Name</th>
				<th>Description</th>
                <th>Price</th>
			</tr>

            <?php foreach ($items as $item) : ?>
            <tr>
                <td><?php echo $item['itemCode']; ?></td>
                <td><?php echo $item['itemName']; ?></td>
                <td><?php echo $item['itemDesc']; ?></td>
                <td class="right"><?php echo "$".$item['itemPrice']; ?></td>
                	
				<td>
					<form action = "updateItemForm.php" method = "get">
			               
					<input type="hidden" name="item_id" 
						value="<?php echo $item['itemID']; ?>">
						
					<input type="hidden" name="category_id" 
						value="<?php echo $item['categoryID']; ?>">

					<input type= "submit" name = "action" 
						value = "Update Item" >
					</form>
				</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="addItemsForm.php">Add New Item</a></p>
        <p><a href="http://localhost/project/index.php">Admin homepage</a></p>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
</footer>

</body>
</html>