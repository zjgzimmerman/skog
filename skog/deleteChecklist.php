<?php
	include './includes/dbconnect.php';
	include './includes/session.php';

	$checkID = $_GET["checkId"];
	$uid = $_SESSION["uid"];
	$query="DELETE FROM checklist WHERE checkId = $checkID AND userId = $uid";
	$mysqli->query($query);
	if ($mysqli->error)
	{
		echo "Database Error: ".$mysqli->error;
	}
	else
	{
		echo "Checklist deleted";
		header("location:./main.php");
	}
	echo '<br><a href="./main.php">Back</a><br>';
	
?>
