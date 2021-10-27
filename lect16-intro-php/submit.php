<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
<!-- Display Test Output Here -->
<?php
	// Write PHP in between <?php block

	// echo displays strings out to the browser
	echo "Hello World!";

	// can use html tags within echo
	echo "<hr>";
	echo "<strong>Hello World!</strong>";

	// Variables
	// Loosely typed - do not have to declare a data type
	$name = "Tommy";
	$age = 21;

	echo "<hr>";
	echo $name;

	// Concatentation in PHP uses period (.)
	echo "<hr>";
	echo "My name is " . $name; 

	// With double quotes, you can utilize variable interpolation and do something liek this:

	echo "<hr>";
	echo "My name is $name";

	// Can also use single quotes for strings, but variable interpolation does not work
	echo "<hr>";
	echo 'My name is $name';

	// Date/time
	// You can set a timezone with a built in PHP method
	date_default_timezone_set("America/Los_Angeles");

	// date() returns the current date/time as a string in the format that is given
	// 1st param: the format of the date/time we want (https://www.php.net/manual/en/datetime.format.php)
	echo "<hr>";
	echo date("m-d-y H:i:s T");

	// Arrays in PHP
	$colors = ["red", "blue", "purple"];
	echo "<hr>";
	echo $colors[0];
	echo "<hr>";
	// For loop to iterate through arrays
	for($i = 0; $i < sizeof($colors); $i++) {
		echo $colors[$i] . ", ";
	}

	// Associative arrays are very useful in PHP
	// Associative arrays are similar to dictionaires or hash maps 
	// They store key value pairs. The key is always a string
	$courses = [
		"ITP 303" => "Full-Stack Web Development",
		"ITP 404" => "Advanced Front-End Web Development",
		"ITP 405" => "Advanced Back-end Web Development"
	];

	// Grab values by string key
	echo "<hr>";
	echo $courses["ITP 303"];

	// You can't simply display an array using echo
	//echo $courses;

	echo "<hr>";
	// Can iterate through an associative array using foreach loop
	foreach($courses as $courseNumber => $courseName) {
		echo $courseNumber . ": " .$courseName;
		echo "<br>";
	}

	echo "<hr>";
	// A lot of times, we only the values in an assoc array
	foreach($courses as $courseName) {
		echo $courseName;
		echo "<br>";
	}

	echo "<hr>";

	// This method displays more information about any variable, such as their data type and length;
	var_dump($courses);

	// SUPERGLOBALS
	echo "<hr>";
	// $_SERVER is a superglobal variable that holds an associative array of a bunch of information about the server / environment
	var_dump($_SERVER);
	// Because it's an assoc array, I can grab any value I want
	echo "<hr>";
	echo $_SERVER["HTTP_SEC_CH_UA"];

	// $_GET and $_POST store information that is passed to this page from the previous page via form submission
	echo "<hr>";
	echo "GET: ";
	var_dump($_GET);

	echo "<hr>";
	echo "POST: ";
	var_dump($_POST);
?>


</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
<?php
	// isset() checks if this variable exists or not
	// empty() checks is there is a value set for this variable or not.
	if(  isset($_POST["name"]) && !empty($_POST["name"])) {
		echo $_POST["name"];
	}
	else {
		// class text-danger is coming from bootstrap
		echo "<div class='text-danger'>Not provided.</div>";
	}
?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(  isset($_POST["email"]) && !empty($_POST["email"])) {
						echo $_POST["email"];
					}
					else {
						// class text-danger is coming from bootstrap
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if( isset($_POST["subscribe"]) && !empty($_POST["subscribe"])) {
						// Foreach loop to iterate
						foreach ( $_POST["subscribe"] as $sub ) {
							echo $sub . ", ";
						}
					}
					else {
						// class text-danger is coming from bootstrap
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>