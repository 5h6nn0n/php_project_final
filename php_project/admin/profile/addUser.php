<?php
/*
	Author: 5h6nn0n
	Admin/profile Page 3 of 5 
	File: addUser.php
*/

// connect to database
require('../../inc/db_connect.php');

//fetch the text box values
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST, 'pass');
$pass = password_hash($pass, PASSWORD_DEFAULT);
$name = filter_input(INPUT_POST, 'name');
$bill = filter_input(INPUT_POST, 'bill');
$ship = filter_input(INPUT_POST, 'ship');
$action = filter_input(INPUT_POST, 'action');

// to make sure that the account email is unique
$queryCheckEmail = 'SELECT COUNT(*) FROM users 
	                WHERE userEmail =:email';
		$stmt = $db->prepare( $queryCheckEmail);
		$stmt->bindValue(':email', $email);
        $stmt->execute();
        $countEmail = $stmt->fetchColumn();
			
// validate the values
if ($name == null || $email == null || $email == false ||
        $pass == null || $bill == null || $ship == null) 
{
    echo "Incomplete data. Check all fields and try again.";
    include('addUserForm.php');	
}
else if ($action == 'Add User') 
{
	// check for unique index validation
	if ($countEmail>0) 
	{ 
		echo "An account with this email address already exists";
		include('addUserForm.php');
	}
	// Insert new customer , new Address, update customer
	else 
	{	  
	// Add the product to the database  
		$queryInsertCustomer = 'INSERT INTO users
				(userName, userEmail, password, userShipping, userBilling)
			VALUES
				(:name, :email, :pass, :ship, :bill)';
		$statement2 = $db->prepare($queryInsertCustomer);
		$statement2->bindValue(':name', $name);
		$statement2->bindValue(':email', $email);
		$statement2->bindValue(':pass', $pass);
		$statement2->bindValue(':ship', $ship);
		$statement2->bindValue(':bill', $bill);
	    $statement2->execute();
        $lastCust = $db->lastInsertId();
		$statement2->closeCursor();

		echo "Account successfully created!";
		include('index.php');
	}
}
		
?>

