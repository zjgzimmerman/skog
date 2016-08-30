<?php
	//Code for deleting trip, used on viewTrip.php
	//takes in tripId from GET and uid from session
	//Deletes trip from database along with messages

	include './includes/dbconnect.php';
	include './includes/session.php';
	//Get tripid from GET variable
	$tripID = $_GET['tripId'];
	//get userid from session
	$uid = $_SESSION["uid"];
	$query="DELETE FROM Trip WHERE tripId = $tripID AND userId = $uid";
	$mysqli->query($query);
	if ($mysqli->error)
	{ echo "Database Error: ".$mysqli->error; }
	else
	{ echo "Trip deleted<br>"; }
	//Remove trip messages
	$query="DELETE FROM messages WHERE tripID = $tripID;";
	$mysqli->query($query);
	if ($mysqli->error)
	{ echo "Database Error: ".$mysqli->error; }
	else
	{ echo "Messages deleted<br>"; }
	//Remove trip sharing
	$query="DELETE FROM tripInvite WHERE tripID = $tripID;";
	$mysqli->query($query);
	if ($mysqli->error)
	{ echo "Database Error: ".$mysqli->error; }
	else
	{ echo "Sharing deleted"; }
	echo '<br><a href="./main.php">Back</a><br>';

	header("./main.php");

?>
