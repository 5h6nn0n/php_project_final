<!-- login.php -->
<?php
/* 
	Home Page 3 of 4
	File: login.php
*/

require_once './inc/db_connect.php';

// Check if the user is already logged in
$status = session_status();
if ($status == PHP_SESSION_NONE) 
{
    session_start();
}

/************* ACCOUNT LOGIN *************/

if ($action = "Log me in") 
{
	// if an existing session is active, jump to it
	if (isset($_SESSION['user']) || isset($_SESSION['admin'])) 
	{
		header('Location: index.php'); // Redirects to home if logged in
		exit();
	}
	// Check if the login form was submitted
	$login = filter_input(INPUT_POST, 'login');

	if (isset($login)) 
	{
		// Retrieve user input (email and password)
		$email = filter_input(INPUT_POST, 'email');
		$password = filter_input(INPUT_POST,'password');

		// check if the provided email exists and matches the password
		
		// query for registered user credentials to verify
		$queryVerifyUsers = 'SELECT userID, userName, password 
							 FROM users 
							 WHERE userEmail = :email';
		$statement = $db->prepare($queryVerifyUsers);
		$statement->bindParam(':email', $email);
		$statement->execute();
		$user = $statement->fetch();
	
		// query for administrator credentials to verify
		$queryVerifyAdmin = 'SELECT adminID, adminName, password 
							 FROM administrators 
							 WHERE adminEmail = :email';
		$statement = $db->prepare($queryVerifyAdmin);
		$statement->bindParam(':email', $email);
		$statement->execute();
		$admin = $statement->fetch();
		
		// if the username is found in the database... 
		if (!is_null($user) || !is_null($admin)) 
		{
			// Verify entered password against hashed password
			if (password_verify($password, $user['password'])) 
			{
				// start a user session
				$_SESSION['user'] = array(
					'userID' => $user['userID'],
					'userName' => $user['userName']
				);
				header('Location: index.php'); // successful login
				exit();
			}
			if (password_verify($password, $admin['password']))
			{
				// start an admin session 
				$_SESSION['admin'] = array(
					'adminID' => $admin['adminID'],
					'adminName' => $admin['adminName']
				);
				header('Location: index.php'); // successful login
				exit();
			
			} else {
				$error_message = 'Invalid login credentials 1';	// account error
			}
		} else {
			$error_message = 'Invalid login credentials 2'; // login page error
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Final Project</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
<body>
	<header>
		<h1>Hello! Welcome back</h1>
	</header>

	<main>
		<h1>Login</h1>
		<?php if (isset($error_message)) { ?>
			<p class="error"><?php echo $error_message; ?> </p>
		<?php } ?>
		<form action="" method="POST" >
		<table>
			<tr>
				<td><label for="email">Email:</label></td>
				<td><input type="email" name="email" required></td>
			</tr>
			<tr>
				<td><label for="password">Password:</label></td>
				<td><input type="password" name="password" required></td>
			</tr>
			<tr>
				<td><label></label></td>
				<td><input type="submit" name="login" value="Log me in">
				</td>
			</tr>
		</table>
		<br>
		</form>
		<p><a href="index.php">Back to Main</a></p>
	</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>