<?php
	//Code for the message form on viewTrip.php
	//Takes in uid from session and tripId from POST
	//Inserts message into database
	include './includes/session.php';
	include './includes/dbconnect.php';
	include './includes/functions/prepareInput.php';
	include './includes/functions/isInvited.php';
	
	//Get information, user id from session, trip id from post, and the message
	$uid = $_SESSION['uid'];
	$tripID = $_POST['tripId'];
	$message = prepareInput($_POST['messageText']);
	//Query to insert message into database
	$query = "INSERT INTO messages (tripID, userID, messageText) VALUES ( $tripID, $uid, '$message');";
	$mysqli->query($query);
	if ($mysqli->error)
	{ echo "Database Error: ".$mysqli->error; exit;}
	else
	{
		if (isInvited($uid, $tripID))
		{ echo 'Message posted<br><a href="./viewTripInvite.php?tripId='.$tripID.'">Back</a>'; 
			header("location:./viewTripInvite.php?tripId=$tripID");
		}
		else
		{ echo 'Message posted<br><a href="./viewTrip.php?tripId='.$tripID.'">Back</a>'; 
			header("location:./viewTrip.php?tripId=$tripID");
		}
	}


?>
