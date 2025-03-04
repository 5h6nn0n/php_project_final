<?php
/*
	Author: 5h6nn0n
	Registered/profile Page 2 of 3 
	File: updateUserForm.php
*/
if(!isset($user_id))
{
	$user_id = filter_input(INPUT_POST, 'user_id');

	if($user_id == null)
	{
		include('../../inc/error.php'); 
		echo "No user found";
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
		<h1>Account Information</h1>
	</header>

    <main>
		<h1>Update User Profile</h1>
		<h2>User to Update: <?php echo $user_id ?></h2>

		<table>
        <form action="updateUser.php" method="post"
              id="update_user_form">
            
            <tr>
				<th>Profile Name:</th>
				<td><input type="text" name="name"
					value="<?php echo $user['userName'];?>"></td>
			</tr>
            <tr>
				<th>Login Email:</th>
				<td><input type="text" name="email"
					value="<?php echo $user['userEmail'];?>"></td>
			</tr>

            <tr>
				<th>Password:</th>
				<td><input type="text" name="pass"
					value="<?php echo $user['password'];?>"></td>
			</tr>		
			<tr>
				<th>Billing Address:</th>
				<td><input type="text" name="billing"
					value="<?php echo $user['userBilling'];?>"></td>
			</tr>	
			<tr>
				<th>Shipping Address:</th>
				<td><input type="text" name="shipping"
					value="<?php echo $user['userShipping'];?>"></td>
			</tr>
			<tr>
			<td><input type="hidden" name="user_id" 
				value="<?php echo $user['userID'];?>"></td>
			
			<td><input type="submit" value="Accept Changes"></td>
			</tr>
        </form>
		</table>
        <p><a href="index.php">Back to Profile</a></p>
    </main>
	
    <footer>
	        <p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>