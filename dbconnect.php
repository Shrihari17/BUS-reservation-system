<?php
	//connect to mysql database
	$servername="localhost";
	$username="root";
	$password="Shrihari2003";
	$database="bus";
	$db=mysqli_connect($servername,$username,$password,$database);

	if(!$db){
		die("Error in connection".mysqli_connect_error());
	}

	
	// Your MySQLi query
	$query = "SELECT * FROM bookings";
	
	// Execute the query
	$result = mysqli_query($db, $query);
	
	// Check for errors
	if (!$result) {
		// Print the error message
		echo "Error: " . mysqli_error($db);
		// You can also log the error, or handle it in other ways
	}
	
	



?>
