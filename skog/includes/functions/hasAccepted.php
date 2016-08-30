<?php
	//Function that takes in a user 
	function hasAccepted ($uid, $tid)
	{
		include './includes/dbconnect.php';
		$query = "SELECT accepted FROM tripInvite WHERE userID=$uid AND tripID=$tid";
		$result = $mysqli->query($query);
		$row = mysqli_fetch_assoc($result);
		if ($row['accepted'] )
			return true;
		else
			return false;
		
		$mysqli->close();
	}

?>
