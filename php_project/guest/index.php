<!DOCTYPE HTML>
<!---- main page that redirects to other homes  --->

<?php 
/*
    Filename: index.php for guest folder
*/
   $status = session_status();
// check if there is a pre-existing session
if ($status == PHP_SESSION_NONE) 
{
    session_start(); //initiate session if none
}

if(!isset($guestID)) 
{
	// randomized identifier for each new guest session
	$guestID = substr(str_replace('.','', uniqid('', true)), 0, 4);
}
// unique session id
 $_SESSION['guest'] = $guestID;

?>
<html>
<head>
	<title>Final Project </title>
	<link rel = "stylesheet" href = "../main.css">
</head>

<body>
	<header>
		<h1> Welcome, Guest!</h1>
	</header>
	
	<main>
		<h1> Guest User Pages </h1>
		<br><p>Your Temporary ID: <?php echo $_SESSION['guest']; ?></p><br>
		<nav>
			<ul>
				<li>
					<a href = "items/index.php"> Browse All Items </a>
				</li>				
				<li>
			<p><a href="http://localhost/project/index.php">Back to homepage</a></p>
				</li>				
			</ul>
		</nav>
	</main>
	
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>