<?php
/*
	Author: 5h6nn0n
	Admin/profile Page 1 of 5 
	File: admin/profile/index.php
*/

require_once('../../inc/db_connect.php');

// Get all users
$queryAllUsers = 'SELECT * FROM users
				   ORDER BY userID';
$statement = $db->prepare($queryAllUsers);
$statement->execute();
$users= $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Final project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css" />
</head>

<body>
	<header>
		<h1>User Profiles</h1>
	</header>
<main>
    <h1>User List</h1>
        <!-- display a table of users -->
    <h2>All Users</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Name</th>
			<th>Billing Address</th>
            <th>Shipping Address</th>					
		</tr>
		<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo $user['userID']; ?></td>
			<td><?php echo $user['userEmail']; ?></td>
			<td><?php echo $user['userName']; ?></td>
			<td><?php echo $user['userBilling']; ?></td>
			<td><?php echo $user['userShipping']; ?></td>
			<td>
				<form action = "updateUserForm.php" method = "get">
					<input type="hidden" name = "user_id" 
					value= "<?php echo $user['userID']; ?>">
					
					<input type="submit" name="action" value="Update">
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="addUserForm.php">Add New User</a></p>
	<p><a href="http://localhost/project/index.php">Back to home</a></p>
</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>