<?php 
	session_start();
	require('connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'post') {
		if (empty($_POST['name']) || empty($_POST['quote'])) {
			$_SESSION['validate'] = "Please enter your name and a quote.";
			header('location: index.php');
		} else {
			$_SESSION['validate'] = "";
			if (isset($_POST['name']) && isset($_POST['quote']) ) {
				$query_post = "INSERT INTO quotes (name, quote, created_at, updated_at)
					VALUES('{$_POST['name']}', '{$_POST['quote']}', NOW(), NOW())";
				run_mysql_query($query_post);
				header('location: main.php');
			}
		}
	}
?>