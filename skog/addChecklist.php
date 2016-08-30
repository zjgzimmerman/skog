<?php
	//Include files to start and change session and start database connection
	include './includes/session.php';
	include './includes/dbconnect.php'; 



	$uid = $_SESSION["uid"];
	//Create then submit the query to the databse
	$query="INSERT INTO checklist (userID, title, content) VALUES ($uid, '".$_POST["title"]."', '".$_POST["checkText"]."')";
	$mysqli->query($query);
	if ($mysqli->error)
	{
		//error with database
		echo "Database Error:".$mysqli->error;
	}
	else
	{
		//No errors
		echo "Checklist created successfully";
		header('location:./main.php');
	}
	echo '<br><a href="main.php">Back</a><br>';

?>
