<?php 
	session_start();
	require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quoting Dojo | Your Profile</title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<div>
		<h1>Profile</h1>
		<div id="profile">
			<?php  
				if(isset($_SESSION['user_id'])) {
					$query_profile = "SELECT * FROM users WHERE users.id = '{$_SESSION['user_id']}'";
					$result = fetch_all($query_profile);
					foreach ($result as $row) { ?>
						<div class="user_info">
							<p>Username: <?= $row['username']; ?></p>
							<p>Password: <?= $row['password']; ?></p>
							<p>Registered on: <?= $row['created_at']; ?></p>
						</div>
					<?php } 
				}
			?>
		</div>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="log_out">
			<input type="submit" value="Log Out">
		</form>
	</div>
</body>
</html>