<?php
/* 
	Home Page 2 of 4
	File: register.php
*/

// Start the session
session_start();

require_once './inc/db_connect.php';

// Initialize variables
$email = $pass1 = $pass2 = $fullName = $shipping = $billing = '';
$errors = array();
$msg = "";

// Check if the registration form was submitted
$register = filter_input(INPUT_POST, 'register');

if (isset($register)) 
{
    // Validate and sanitize user input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass1 = filter_input(INPUT_POST,'pass1');
    $pass2 = filter_input(INPUT_POST,'pass2');
    $fullName = filter_input(INPUT_POST, 'fullName');
    $shipping = filter_input(INPUT_POST, 'shipping');
    $billing = filter_input(INPUT_POST, 'billing');

	$queryCheckEmail = 'SELECT COUNT(*) FROM users 
	                    WHERE userEmail =:email';
	$stmt = $db->prepare( $queryCheckEmail);
	$stmt->bindValue(':email', $email);
    $stmt->execute();
    $countEmail = $stmt->fetchColumn();
	
    // Check for empty fields
    if (empty($email)) 
	{
        $errors['email'] = 'Email is required';
    }
    if (empty($pass1)) 
	{
        $errors['pass1'] = 'Password is required';
    }
    if (empty($fullName)) 
	{
        $errors['fullName'] = 'Full Name is required';
    }
    // Check if passwords match
    if ($pass1 != $pass2) 
	{
        $errors['pass2'] = 'Passwords do not match';
    }
	if ($countEmail>0) 
	{
		$msg = "An account with this email address already exists";
	}

    // If there are no validation errors, proceed with registration
    else if (empty($errors)) 
	{
        // Hash the password before storing it
        $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);

        // query the new user into the database
        $queryInsertUser = 'INSERT INTO users (userName, userEmail, password, userShipping, userBilling) 
                  VALUES (:userName, :email, :password, :userShipping, :userBilling)';
        $statement = $db->prepare($queryInsertUser);
		$statement->bindParam(':userName', $fullName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':userShipping', $shipping);
        $statement->bindParam(':userBilling', $billing);
        
        if ($statement->execute()) 
		{
            // Registration successful, redirect to login page
            header('Location: login.php');
            exit();
        } else {
            // Registration failed, display an error message
            $errors['registration'] = 'Registration failed. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Final Project</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
<body>
	<header>
		<h1>Account Registration</h1>
	</header>

    <main>
        <h1>Enter your information</h1>
		<p><?php echo $msg; ?></p>
        <?php if (isset($errors['registration'])) : ?>
            <p class="error"><?php echo $errors['registration']; ?></p>
        <?php endif; ?>
        <form method="POST" action="register.php">
		<table>
			<tr>
				<td><label for="email">Email:</label></td>
				<td><input type="email" name="email" id="email" value="<?php echo $email; ?>"></td>
					<?php if (isset($errors['email'])) : ?>
					<p class="error"><?php echo $errors['email']; ?></p>
					<?php endif; ?>
			</tr>
			<tr>
				<td><label for="pass1">Password:</label></td>
				<td><input type="pass1" name="pass1" id="pass1"></td>
					<?php if (isset($errors['pass1'])) : ?>
					<p class="error"><?php echo $errors['pass1']; ?></p>
					<?php endif; ?>
			</tr>
            <tr>
				<td><label for="pass2">Confirm Password:</label></td>
				<td><input type="pass2" name="pass2" id="pass2"></td>
					<?php if (isset($errors['pass2'])) : ?>
					<p class="error"><?php echo $errors['pass2']; ?></p>
					<?php endif; ?>	
			</tr>
            <tr>
				<td><label for="fullName">Full Name:</label></td>
				<td><input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>"></td>
					<?php if (isset($errors['fullName'])) : ?>
					<p class="error"><?php echo $errors['fullName']; ?></p>
					<?php endif; ?>
            </tr>
			<tr>
				<td><label for="address">Shipping Address:</label></td>
				<td><input type="text" name="shipping" id="shipping" value="<?php echo $shipping; ?>"></td>
			</tr>
            <tr>
				<td><label for="address">Billing Address:</label></td>
				<td><input type="text" name="billing" id="billing" value="<?php echo $billing; ?>"></td>
            </tr>
		</table>
        <br>
		<div style="text-align: center;">
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="login.php">Log in here</a></p>
			<p><a href="index.php">Back to home</a></p>
        </div>
		</form>
    </main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
	</footer>
</body>
</html>
