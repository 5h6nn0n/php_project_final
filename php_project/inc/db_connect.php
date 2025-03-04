<?php
	$dsn1 = 'mysql:host=localhost;dbname=shans_shop';
    $username1 = 'mgs_user';
    $password1 = 'pa55word';
   	
    try {
        $db = new PDO($dsn1, $username1, $password1);
		echo '<p> You are connected to the database.</p>';
    } 
	catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo  'Connection error.:$error_message';
    }
	
?>