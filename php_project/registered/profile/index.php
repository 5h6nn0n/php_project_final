<?php
/* 
	Author: 5h6nn0n
	Registered/profile Page 1 of 3
	File: index.php for profile folder
*/
$status = session_status();

if ($status == PHP_SESSION_NONE) 
{
    session_start();
}
require_once('../../inc/db_connect.php');

if (!isset($user_id)) 
{
	$user_id = $_SESSION['user']['userID'];	
}
// Get user Information
$queryProfile = 'SELECT * FROM users
				 WHERE userID = :user_id
				 ORDER BY userID';
$statement = $db->prepare($queryProfile);
$statement->bindValue(':user_id', $user_id);
$statement->execute();
$users = $statement->fetchAll();
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
		<h1>Registered User Profile</h1>
	</header>

	<main>
		<h1><?php echo $_SESSION['user']['userName']; ?>'s Information</h1>
		<br>
		<table>
		<!-- display a user Information -->

		<?php foreach($users as $user): ?>
		<form action = "updateUserForm.php" method = "post">
		<tr>
			<th>UserID:</th>
			<td><?php echo $_SESSION['user']['userID']; ?></td>
		</tr>
		<tr>
			<th>Profile Name:</th>
			<td><?php echo $user['userName']; ?></td>
		</tr>
		<tr>
			<th>Login Email:</th>
			<td><?php echo $user['userEmail']; ?></td>
		</tr>
		<tr>
			<th>Billing Address:</th>
			<td><?php echo $user['userBilling']; ?></td>
		</tr>
		<tr>
			<th>Shipping Address:</th>
			<td><?php echo $user['userShipping']; ?></td>
		</tr>
		<tr>
		<td><input type="hidden" name = "user_id" 
		value= "<?php echo $_SESSION['user']['userID']; ?>"></td>
		
		<td><input type="submit" name="action" value="Update Profile"></td>
		</tr>
		</form>
		<?php endforeach; ?>
		
		</table>
	<p><a href="http://localhost/project/index.php">Back to home</a></p>
	</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>