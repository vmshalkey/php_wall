<?php 
	session_start();
	require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quoting Dojo | Main</title>
	<style type="text/css">
		.posts {
			border-bottom: 1px solid black;
		}
	</style>
</head>
<body>
	<h1>Here are all the awesome quotes!</h1>
	<a href="index.php"><button>Add a Quote!</button></a>
	<div id="display">
		<?php  
			$query_display = "SELECT * FROM quotes ORDER BY quotes.created_at DESC";
			$result = fetch_all($query_display);
			foreach ($result as $row) { ?>
				<div class="posts">
					<p>"<?= $row['quote']; ?>"</p>
					<p>-<?= $row['name']. " at " .$row['created_at']; ?></p>
				</div>
			<?php } 
		?>
	</div>
</body>
</html>