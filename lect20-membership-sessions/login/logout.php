<?php
	session_start(); // Still need to start a session to destory session
	session_destroy(); // Destroys all existing session variables

	// Typically if you want to store when a user logged out, you would insert a record in the database the time they logged out
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Logout</h1>
			<div class="col-12">You are now logged out.</div>
			<div class="col-12 mt-3">You can go to <a href="../song-db">home page</a> or <a href="login.php">log in</a> again.</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

</body>
</html>