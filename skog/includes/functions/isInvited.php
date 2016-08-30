<?php
	//Function to check if a user has been invited on a trip
	//Takes in a user id, and a trip id
	//returns a true or false
	function isInvited ($uid, $tripId)
	{
		include './includes/dbconnect.php';
		$query="SELECT * FROM tripInvite WHERE tripID=$tripId AND userID=$uid";
		$result = $mysqli->query($query);
		if ($mysqli->error)
			{ echo "Database Error: ".$mysqli->error; }
		if ($result->num_rows)
		{
			return true;
		}
		else
		{
			return false;
		}
		$mysqli->close();
	}
?>