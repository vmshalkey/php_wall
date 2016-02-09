<?php 
	session_start();
	require('connection.php');
//navigate to registration page from login page.
	if(isset($_POST['action']) && $_POST['action'] == 'go_to_reg') {
		$_SESSION['validate'] = "";
		header('location: registration.php');
	}

//navigate to login page from registration page.
	if(isset($_POST['action']) && $_POST['action'] == 'go_to_login') {
		$_SESSION['validate'] = "";
		header('location: login.php');
	}

//for registration page
	if(isset($_POST['action']) && $_POST['action'] == 'register') {
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password'])) {
			$_SESSION['validate'] = "Please enter a user email and a password.";
			header('location: registration.php');
		} else if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) === false) {
			$_SESSION['validate'] = "Please enter a valid email address as your username.";
			header('location: registration.php');
		} else if ($_POST['password'] != $_POST['confirm_password']) {
			$_SESSION['validate'] = "Passwords do not match.";
			header('location: registration.php');	
		} else {
			if (isset($_POST['username']) && isset($_POST['password']) ) {
				$query_unique = "SELECT * FROM users WHERE username = '{$_POST['username']}'";
				$user = fetch_all($query_unique);
				if(!empty($user)) {
					$_SESSION['validate'] = "That username is already registered.";
					header('location: registration.php');
				} else {
					$_SESSION['validate'] = "Registration successful! Please login.";
					$query_reg = "INSERT INTO users (username, password, created_at, updated_at)
						VALUES('{$_POST['username']}', '{$_POST['password']}', NOW(), NOW())";
					run_mysql_query($query_reg);
					header('location: login.php');
				}
			}
		}
	}

//for login page
	if(isset($_POST['action']) && $_POST['action'] == 'login') {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$_SESSION['validate'] = "Please enter a user email and a password.";
			header('location: login.php');
		} else if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) === false) {
			$_SESSION['validate'] = "Please enter a valid email address as your username.";
			header('location: login.php');
		} else {
			if (isset($_POST['username']) && isset($_POST['password']) ) {
				$query_login = "SELECT * FROM users WHERE username = '{$_POST['username']}'";
				$user = fetch_all($query_login);
				if(!empty($user)) {
					$_SESSION['validate'] = "";
					foreach ($user as $info) {
						if($info['password'] == $_POST['password']) {
							$_SESSION['user_id'] = $info['id'];
							header('location: profile.php');
						} else if ($info['password'] != $_POST['password']) {
							header('location: login.php');
							$_SESSION['validate'] = "Incorrect password.";
						}
					}
				} else if (empty($user)) {
					$_SESSION['validate'] = "That username does not exist.";
					header('location: login.php');
				} 
			}
		}
	}

//on profile page...logs user out and returns back to login page.
	if(isset($_POST['action']) && $_POST['action'] == 'log_out') {
		session_destroy();
		header('location: login.php');
	}


?>