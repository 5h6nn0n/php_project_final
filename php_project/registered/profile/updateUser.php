<?php
/*
	Author: 5h6nn0n
	Registered/profile Page 3 of 3 
	File: updateUser.php
*/
//fetch the text box values
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST, 'pass');
$name = filter_input(INPUT_POST, 'name');
$billing = filter_input(INPUT_POST, 'billing');
$shipping = filter_input(INPUT_POST, 'shipping');
$action = filter_input(INPUT_POST, 'action');
 
if(!isset($user_id))
{
	$user_id = filter_input(INPUT_POST, 'user_id');
}
//Validate values
if ($name == null || $email == null || $email == false || 
	$pass == null || $billing ==null || $shipping == null) 
{
	include('../../inc/error.php'); // show error message page, if validation fails.	
}
else 
{ 
	require_once('../../inc/db_connect.php');

	// update the users information
	$queryUpdateUser = 'UPDATE users
		SET userID = :user_id,
			userName = :name, 
			userEmail = :email,
			password = :pass,
			userShipping = :shipping,
			userBilling = :billing
			WHERE userID =:user_id';
		$statement5 = $db->prepare($queryUpdateUser);
	    $statement5->bindValue(':user_id',  $user_id);
	    $statement5->bindValue(':name',  $name);
        $statement5->bindValue(':email', $email);
        $statement5->bindValue(':pass', $pass);
        $statement5->bindValue(':shipping', $shipping);
        $statement5->bindValue(':billing', $billing);
        $statement5->execute();
        $statement5->closeCursor();
     
    // Display the user's profile
	echo "Account successfully updated!";
    include('index.php');
}

?>