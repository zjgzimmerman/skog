<?php
	include './includes/dbconnect.php';
	$uid = $_GET["userId"];
	$tid = $_GET["tripId"];

	$query = "DELETE FROM tripInvite WHERE userID=$uid AND tripID=$tid;";
	
	if (isset($uid) and isset($tid))
	{
		$mysqli->query($query);
		include './includes/dberror.php';
		header("location:./viewTrip.php?tripId=$tid");
	}
	else
	{
		echo "Proper variables not sent";
	}
	
	

?>
