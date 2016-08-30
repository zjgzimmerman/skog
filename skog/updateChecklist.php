<?php
	//Include files to start and change session and start database connection
	include './includes/session.php';
	include './includes/dbconnect.php'; 
	if ($_POST["checkId"] != '')
	{
		$checkId = $_POST["checkId"];
	}
	else
	{
		echo "No checklist ID found";
		exit;
	}
	$uid = $_SESSION["uid"];
	//Create then submit the query to the databse
		$query="UPDATE checklist SET title='".$_POST["title"]."', content='".$_POST["checkText"]."' WHERE userId = ".$uid." AND checkId = ".$checkId;
	$mysqli->query($query);
	if ($mysqli->error)
	{
		//error with database
		echo "Database Error:".$mysqli->error;
	}
	else
	{
		//No errors
		echo "Checklist updated successfully";
		header("location:./viewChecklist.php?checkId=$checkId");
	}
	echo '<br><a href="main.php">Back</a><br>';

?>
