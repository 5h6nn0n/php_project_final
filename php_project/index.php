<?php
/* 
	Home Page 1 of 4
	File: index.php
*/

// starts a new session
$status = session_status();

if ($status == PHP_SESSION_NONE) 
{
    session_start();
}

// database connection
require_once './inc/db_connect.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Final Project</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
<body>
    <main>   
        <!-- Display login/logout link -->
        <?php
        if (isset($_SESSION['user'])) 
		{
			echo "<h1> Registered User Pages </h1>";
			echo "Hello, ";
			echo $_SESSION['user']['userName']."!";
		?>		
		<br><br>
		<div>
			<p>
				<a href = "registered/items/index.php"> View Items </a>
			</p>
			<p>
				<a href="registered/orders/index.php"> View Orders </a>
			</p>
			<p>
				<a href = "registered/profile/index.php"> View Profile </a>
			</p>
			<p>
				<a href = "registered/items/viewCart.php"> View Cart </a>
			</p>
		</div>
		</br></br>
		<!-- User is logged in, display a logout link -->
        <p><a href="logout.php">Logout</a></p>
			

		<?php
		}
        else if (isset($_SESSION['admin'])) 
		{
			echo "<h1> Administrator User Pages </h1>";
			echo "Hello, ";
			echo $_SESSION['admin']['adminName']."!";
		?>		
		<br><br>
		<div>
			<p>
				<a href = "admin/items/index.php"> View Items </a>
			</p>
			<p>
				<a href="admin/orders/index.php"> View Orders </a>
			</p>
			<p>
				<a href = "admin/profile/index.php"> View Profile </a>
			</p>
		</div>
		</br></br>
		<!-- User is logged in, display a logout link -->
        <p><a href="logout.php">Logout</a></p>

        <?php } else {
			echo "<h1>Welcome to Online Portal</h1>";
			echo "<h2>Select a user type</h2>";
            // User is not logged in, display a login link
		?>
		<p><a href="login.php">Login as User</a></p> 
		<p><a href="guest/index.php">Proceed as Guest</a></p>
		<div style="text-align: center;">
            <p>Don't have an account? <a href="register.php">Sign up here</a></p>
        </div>
        <?php } 
		?>
    </main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>
