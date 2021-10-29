<?php
// ---- STEP 1: Establish database connection
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2021!";
$db = "nayeon_song_db";

// Create a new instance of the mysqli class. 
// Pass in the host, user, pw, db information
// When this instance is created, it also attempts to connect to the database with these credentials
$mysqli = new mysqli($host, $user, $password, $db);

// If there is an error, connect_errno will return some kind of error code
if( $mysqli->connect_errno) {
	echo $mysqli->connect_error;
	// exit() exits the program here. No subsequent code is run.
	exit();
}

// ---- STEP 2: Generate & Submit SQL
$sql = "SELECT * FROM genres;";
// To make sure sql statement looks good, echo it out
echo "<hr>" . $sql . "<hr>";

// submit the query!
// query() method will query the sql statement against the database
// query() will return information about the results (not the full results)
// query() will return FALSE if there is any kind of error querying the db
$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}

// Can query multiple SQL statements
$sql_media = "SELECT * FROM media_types;";
$results_media = $mysqli->query($sql_media);
if(!$results_media) {
	echo $mysqli->error;
	exit();
}


// --- STEP 3: Display results
var_dump($results);

echo "<hr>";
echo "Num of rows: " . $results->num_rows;

echo "<hr>";
// fetch_assoc() is a method that returns the next row of results as an associative array
$result1 = $results->fetch_assoc();
var_dump($result1);
echo "<hr>";
echo $result1["name"];
echo "<hr>";
var_dump( $results->fetch_assoc() );
echo "<hr>";
var_dump( $results->fetch_assoc() );

// Show ALL the results
// fetch_assoc() will return NULL when it reaches the end of the results
while($row = $results->fetch_assoc()) {
	echo "<hr>";
	var_dump( $row );
}

// Once you reach the end of fetch_assoc(), it's over!
echo "<hr>";
var_dump( $results->fetch_assoc() );

// You can reset fetch_assoc() to point to the top of the results using this:
$results->data_seek(0);

// echo "<hr>";
// var_dump( $results->fetch_assoc() );

// ---- STEP 4: Close the connection
$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>

	<?php
		// This was the way to generate option tags before, but now instead of using the below way, we can use the alternative php syntax
		// while($row = $results->fetch_assoc()) {
		// 	// Create option tags
		// 	echo "<option value='" . $row["genre_id"] . "'>" . $row["name"] . "</option>";
		// }
	?>
	<!-- While running thorugh each genre result, create a <option> tag and add genre id and name -->
	<?php while($row = $results->fetch_assoc()) : ?>
		<option value="<?php echo $row["genre_id"]?>"> 
			<?php echo $row["name"]; ?> 
		</option>
	<?php endwhile;?>

	<!-- <option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
<select name="media_type" id="media-type-id" class="form-control">
	<option value="" selected>-- All --</option>

	<?php while($row = $results_media->fetch_assoc()) : ?>
		<option value="<?php echo $row["media_type_id"]?>"> 
			<?php echo $row["name"]; ?> 
		</option>
	<?php endwhile;?>

	<!-- <option value='1'>MPEG audio file</option>
	<option value='2'>Protected AAC audio file</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>