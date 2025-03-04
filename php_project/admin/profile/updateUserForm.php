<?php
/*
	Author: 5h6nn0n
	Admin/profile Page 4 of 5 
	File: updateUserForm.php
*/

// input validation
if(!isset($user_id))
{
	$user_id = filter_input(INPUT_GET, 'user_id');

	if($user_id == null)
	{
		echo "Error";
	} 
	else 
	{
		require('../../inc/db_connect.php');

		$queryAllUsers = 'SELECT * FROM users
						  WHERE userID = :user_id';
		$statement3 = $db->prepare($queryAllUsers);
		$statement3->bindValue(':user_id', $user_id);
		$statement3->execute();
		$user = $statement3->fetch();
		$statement3->closeCursor();
	}
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
		<h1>Profile Manager</h1>
	</header>
    <main>
		<h1>Update User in Database</h1>
		<h2>User to Update: <?php echo $user_id ?></h2>
		<table>
        <form action="updateUser.php" method="get"
              id="update_user_form">
            <tr>
				<td><label>Full Name:</label></td>
				<td><input type="text" name="name"
					value="<?php echo $user['userName'];?>"></td>
			</tr>
            <tr>
				<td><label>Email:</label></td>
				<td><input type="text" name="email"
					value="<?php echo $user['userEmail'];?>"></td>
			</tr>
            <tr>
				<td><label>Password:</label></td>
				<td><input type="text" name="pass"
					value="<?php echo $user['password'];?>"></td>
			</tr>		
			<tr>
				<td><label>Billing Address:</label></td>
				<td><input type="text" name="billing"
					value="<?php echo $user['userBilling'];?>"></td>
			</tr>	
			<tr>
				<td><label>Shipping Address:</label></td>
				<td><input type="text" name="shipping"
					value="<?php echo $user['userShipping'];?>"></td>
			</tr>
			<input type="hidden" name="user_id" 
				value="<?php echo $user['userID'];?>"><br>
			
			<input type="submit" value="Update User"><br>
        </form>
		</table>
        <p><a href="index.php">Back to User List</a></p>
    </main>
    <footer>
	        <p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>