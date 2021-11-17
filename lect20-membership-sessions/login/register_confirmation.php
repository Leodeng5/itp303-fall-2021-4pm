<?php

require '../config/config.php';

// Server-side validation is the second line of defense. Doing another check to make sure all required inputs are given
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the database
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Query the database if this username or email already exists in the users table
	$statement_registered = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
	$statement_registered->bind_param("ss", $_POST["username"], $_POST["email"]);
	$executed_registered = $statement_registered->execute();
	if(!$executed_registered) {
		echo $mysqli->error;
	}

	// Getting number of results with prepared statements
	$statement_registered->store_result();
	$numrows = $statement_registered->num_rows;

	$statement_registered->close();

	// If we get ANY result back, it means this username or email is taken!
	if( $numrows > 0) {
		$error = "Username or email has been already taken. Please choose another one.";
	}
	else {
		// Hash the password
		$password = hash("sha256", $_POST["password"]);

		// Add this information as a new record into the newly created users table
		$statement = $mysqli->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
		$statement->bind_param("sss", $_POST["username"], $_POST["email"], $password);
		$executed = $statement->execute();
		if(!$executed) {
			echo $mysqli->error;
		}
		$statement->close();
	}

	$mysqli->close();
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>