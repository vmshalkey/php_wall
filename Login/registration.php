<?php 
	session_start();
	require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quoting Dojo | Register</title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<div>
		<h1>Register as a new user below!</h1>
			<form action="process.php" method="post">
				<h2>User Email: </h2><input type="text" name="username">
				<h2>Password: </h2><input type="password" name="password">
				<h2>Confirm Password: </h2><input type="text" name="confirm_password">
				<input type="hidden" name="action" value="register">
				<input type="submit" value="Register New User">
			</form>
			<div id="validate">
				<?php
					if(isset($_SESSION['validate'])) {
						echo '<p>' .$_SESSION['validate']. '</p>';
					} ?>
			</div>
		<form action="process.php" method="post">
			<h3>Already registered?</h3>
			<input type="hidden" name="action" value="go_to_login">
			<input type="submit" value="Register Here">
		</form>
	</div>
</body>
</html>