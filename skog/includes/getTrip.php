<?php

	//Function to get trip information and return an associtave array
	//Input is trip ID, and the user id is retrieved from the session variable
	function getTrip($tripId)
	{
		include './includes/dbconnect.php';
		//Check to see if the session user id variable is set, if not issue an error and stop execution
		if (isset($_SESSION["uid"]))
		{ $uid = $_SESSION["uid"]; }
		else
		{ echo "No user ID found"; exit; }
		
		//Create query
		$query = "SELECT * FROM Trip WHERE tripId = $tripId AND userId = $uid";
		//send query
		$result = $mysqli->query($query);

		//Check for an error and check for an unexpected number of rows
		if ($mysqli->error)
		{ echo "Database Error: ".$mysqli->error; exit; }
		if ($result->num_rows != 1)
		{ echo "Database returned unexpected number of rows"; exit; }

		$output = $result->fetch_assoc();
		return $output;

	}

?>
