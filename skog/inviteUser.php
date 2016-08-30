<?php
	include './includes/dbconnect.php';
	include './includes/functions/isInvited.php';
	//Invite user script for the viewTrip page
	$uid = $_GET['userId'];
	$tid = $_GET['tripId'];
	$query = "INSERT INTO tripInvite (tripID, userID) VALUES ($tid, $uid)";
	if (isInvited($uid, $tid))
	{
		echo "User already invited.";
		header("location:./viewTrip.php?tripId=$tid&error=1");
		echo "<br><a href='./viewTrip.php?tripId=$tid'>Back</a>";
	}
	else
	{
		$mysqli->query($query);
		include './includes/dberror.php';
		echo "User invited";
		header("location:./viewTrip.php?tripId=$tid");
		echo "<br><a href='./viewTrip.php?tripId=$tid'>Back</a>";
	}

?>
