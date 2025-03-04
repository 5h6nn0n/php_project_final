<!--
	Author: 5h6nn0n
	Admin/profile Page 2 of 5 
	File: addUserForm.php
-->

<!DOCTYPE html>
<html>

<head>
    <title>Final Project</title>
    <link rel="stylesheet" type="text/css" href="../../main.css">
</head>
<body>
    <header>
		<h1>Profile Manager</h1>
	</header>
    <main>
        <h1>Add User to Database</h1>
		<table>
        <form action="addUser.php" method="post"
              id="add_user_form">
            <tr>
				<td><label>Full Name:</label></td>
				<td><input type="text" name="name"></td>
			</tr>
            <tr>
				<td><label>Email Address:</label></td>
				<td><input type="text" name="email"></td>
			</tr>
            <tr>
				<td><label>Password:</label></td>
				<td><input type="text" name="pass"></td>
			</tr>
			<tr>
				<td><label>Billing Address:</label></td>
				<td><input type="text" name="bill"></td>
			</tr>
			 <tr>
				<td><label>Shipping Address:</label></td>
				<td><input type="text" name="ship"></td>
			</tr>
\			<tr>
				<td><label>&nbsp;</label></td>
				<td><input type="submit" name = "action" value="Add User">
				</td>
			</tr>
        </form>
		</table>
		<p>*All Fields are Required</p>
        <p><a href="index.php">Back to User List</a></p>
    </main>
    <footer>
		<p>&copy; <?php echo date("Y"); ?> Shan's Shop, Inc.</p>
    </footer>
</body>
</html>