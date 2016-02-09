<?php 
	session_start();
	require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quoting Dojo | Add a Quote!</title>
	<style type="text/css">

	</style>
</head>
<body>
	<h1>Quoting Dojo</h1>
	<form action="process.php" method="post">
		<h2>Your Name: </h2><input type="text" name="name">
		<h2>Your Quote: </h2><textarea name="quote" rows="5" cols="50"></textarea>
		<input type="hidden" name="action" value="post">
		<input type="submit" value="Add My Quote!">
	</form>
	<a href="main.php"><button>See All Quotes!</button></a>
	<div id="validate">
		<?php
			if(isset($_SESSION['validate'])) {
				echo '<p>' .$_SESSION['validate']. '</p>';
			} ?>
	</div>
</body>
</html>