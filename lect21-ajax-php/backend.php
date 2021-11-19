<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// To send a response back to frontend, use echo
	//echo "hello world";

	// You cannot echo out an associative array. Only strings.
	// echo $php_array;
	// Fortunately you can convert php associative array to json formatted string very easily
	//echo json_encode($php_array);

	// Can receive parameters passe from the frontend (GET)
	//$name = $_GET["name"];
	//$age= $_GET["age"];

	// Can receive parameters passed from the frontend (POST)
	//$name = $_POST["name"];
	//$age= $_POST["age"];

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2021!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	$mysqli->set_charset('utf8');

	//Using Prepared statements

	// Handle the wildcard
	$searchTerm = "%" . $_GET["term"] . "%";
	$statement = $mysqli->prepare("SELECT * FROM tracks WHERE name LIKE ? LIMIT 10");
	$statement->bind_param("s", $searchTerm);
	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
		exit();
	}

	// How prepared statement gets results
	$results = $statement->get_result();
	$mysqli->close();

	// Now can do $results->fetch_assoc() to get the first result

	// Create a separate array to store our results
	$results_array = [];

	// Run through all the results from the database and push each result into our newly created array
	while($row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Send results as json formatted string
	echo json_encode($results_array);


?>