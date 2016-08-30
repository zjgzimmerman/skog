<?php
	//Function to get the information from a checklist
	//Input is checklistID (user ID is retrieved from the session variable)
	//Returns an associative array of the checklist variable

	function getChecklist ( $CID )
	{
		include './includes/dbconnect.php';
		//check if the session user id variable is set, if not then tell user and stop execution
		if (isset($_SESSION["uid"]))
		{ $uid = $_SESSION["uid"]; }
		else
		{ echo "No user ID found"; exit; }

		//Create query to send to database 
		$query = "SELECT * FROM checklist WHERE checkID = $CID AND userId = $uid";
		//submit query
		$result = $mysqli->query($query);

		//Check if there was an error, or if more/less than 1 row was returned, if so show the appropriate error
		if ($mysqli->error)
		{ echo "Database Error: ".$mysqli->error; exit;}
		if ($result->num_rows != 1)
		{ echo "Database returned unexpected number of rows"; exit; }
		
		$output = $result->fetch_assoc();
		return $output;
	}


?>
