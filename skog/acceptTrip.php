<?php
	include './includes/session.php';
	include './includes/functions/hasAccepted.php';
	include './includes/dbconnect.php';
	$tid = $_GET["tripId"];
	$uid = $_SESSION["uid"];
	if (hasAccepted($uid, $tid))
	{
		$query = "UPDATE tripInvite SET accepted=0 WHERE userID=$uid AND tripID=$tid;";
		$mysqli->query($query);
		include './includes/dberror.php';
		echo "Trip no longer accepted";
	}
	else
	{
		$query = "UPDATE tripInvite SET accepted=1 WHERE userID=$uid AND tripID=$tid;";
		$mysqli->query($query);
		include './includes/dberror.php';
		echo "Trip accepted";
	}
	header("location:./viewTripInvite.php?tripId=$tid");
	echo '<br><a href="./main.php">Back</a>'
	
?>
