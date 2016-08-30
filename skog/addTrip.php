<?php
	//Include files to start and change session and start database connection
	include './includes/session.php';
	include './includes/dbconnect.php'; 
	include './includes/functions/prepareInput.php';

	//Prepare variables to be put into the database
	$uid = $_SESSION["uid"];
	$tripName = prepareInput($_POST["title"]);
	$startDate = $_POST["startDate"];
	$endDate = $_POST["endDate"];
	$location = prepareInput($_POST["location"]);
	$address = prepareInput($_POST["address"]);
	$zip = prepareInput($_POST["zip"]);
	$parkSite = prepareInput($_POST["parkSite"]);
	$ice = prepareInput($_POST["ice"]);
	$tripInfoText = prepareInput($_POST["tripInfoText"]);
	$checklist = $_POST["checklist"];
	
	//Check the size of the file passed, if 0 then no file was passed
	if ($_FILES['parkMap']['size'] != 0)
	{
		//A map file was passed, get the information about the file and put it in the database
		$parkMap = mysqli_real_escape_string($mysqli, file_get_contents($_FILES['parkMap']['tmp_name']));
		$mapName = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['name'] );
		$mapType = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['type'] );
		$mapSize = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['size'] );
		
		$query="INSERT INTO Trip (userID, tripName, StartDate, EndDate, Location, parkAddress, ZipCode, ParkSite, map, mapName, mapType, mapSize, ICEContact, TripInfo, CheckID ) VALUES ($uid, '$tripName', '$startDate', '$endDate', '$location', '$address', '$zip', '$parkSite', '$parkMap', '$mapName', '$mapType', '$mapSize', '$ice', '$tripInfoText', '$checklist')";
	}
	else
	{
		//No map passed, issue query without map info
		$query="INSERT INTO Trip (userID, tripName, StartDate, EndDate, Location, parkAddress, ZipCode, ParkSite, ICEContact, TripInfo, CheckID ) VALUES ($uid, '$tripName', '$startDate', '$endDate', '$location', '$address', '$zip', '$parkSite', '$ice', '$tripInfoText', '$checklist')";

	}
	//submit the query to the databse
	$mysqli->query($query);
	if ($mysqli->error)
	{
		//error with database
		echo "Database Error:".$mysqli->error;
	}
	else
	{
		//No errors
		echo "Trip created successfully";
		header('location:./main.php');
	}
	$mysqli->close();
	echo '<br><a href="main.php">Back</a><br>';

?>
