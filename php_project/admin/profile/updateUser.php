<?php
/* 
	Author: 5h6nn0n
	Admin/profile Page 5 of 5 
	File: updateUser.php
*/

// fetch the text box values
$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_GET, 'pass');
$name = filter_input(INPUT_GET, 'name');
$billing = filter_input(INPUT_GET, 'billing');
$shipping = filter_input(INPUT_GET, 'shipping');
$action = filter_input(INPUT_GET, 'action');
 
if(!isset($user_id))
{
	$user_id = filter_input(INPUT_GET, 'user_id');
}
// validate the values
if ($name == null || $email == null || $email == false || 
	$pass == null || $billing == null || $shipping == null) 
{
	include('../../inc/error.php'); // shows error message page.
}
else 
{ 
	require_once('../../inc/db_connect.php');

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
     
    // Display the User List page
	echo "Account successfully updated!";
    include('index.php');
}

?>