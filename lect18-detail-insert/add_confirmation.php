<?php
// Make sure that the form data is submitted to this page
var_dump($_POST);
$isInserted = false;

// Make sure that the REQUIRED fields have been passed to this page
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {

		$error = "Please fill out all required fields.";
}
else {
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$password = "uscItp2021!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $password, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Take care of optional fields
	if(isset($_POST["album"]) && !empty($_POST["album"])) {
		$album_id = $_POST["album"];
	}
	else {
		$album_id = "null";
	}

	if(isset($_POST["composer"]) && !empty($_POST["composer"])) {
		$composer = "'" . $_POST["composer"] . "'";
	}
	else {
		$composer = "null";
	}
	if(isset($_POST["bytes"]) && !empty($_POST["bytes"])) {
		$bytes = $_POST["bytes"];
	}
	else {
		$bytes = "null";
	}

	// Sanitize user input for track
	// real_escape_string() takes care of special characters like ',; so that it doesn't affect the SQL statement. It adds escape characters to the special characters
	$track_name = $mysqli->real_escape_string($_POST["track_name"]);

	$sql = "INSERT INTO tracks(name, media_type_id, genre_id, milliseconds, unit_price, album_id, composer, bytes)
	VALUES('" . $track_name ."',"
	. $_POST["media_type"] . ", "
	. $_POST["genre"] . ", "
	. $_POST["milliseconds"] . ", "
	. $_POST["price"] . ", "
	. $album_id . ", "
	. $composer . ", "
	. $bytes . ");";

	// Display the sql statement to make sure it looks good
	echo "<hr>" . $sql . "<hr>";

	// If all looks good, run the query!
	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// When we insert a record, we're not gonna get results back.
	// How to check if insert was succesful?
	// 1. Check the database
	// 2. Use $mysqli->affected_rows. It returns the number of rows inserted, updated or deleted by the last SQL query
	// Should return 1 since we only want 1 record to be inserted!!
	echo "Num rows inserted: " . $mysqli->affected_rows;

	// Use this as a flag
	if($mysqli->affected_rows == 1) {
		$isInserted = true;
	}

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if( isset($error) && !empty($error)) : ?>
				<div class="text-danger">
					<?php echo $error; ?>
				</div>
			<?php elseif($isInserted) : ?>
				<div class="text-success">
					<span class="font-italic">
						<?php echo $_POST["track_name"]?>
					</span> was successfully added.
				</div>
			<?php endif;?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>