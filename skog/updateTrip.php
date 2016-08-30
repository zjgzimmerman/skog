<?php
	//Include files to start and change session and start database connection
	include './includes/session.php';
	include './includes/dbconnect.php'; 
	include './includes/functions/prepareInput.php';

	//Prepare variables to be put into the database
	$tid = $_POST["tripId"];
	$uid = $_SESSION["uid"];
	$tripName = prepareInput($_POST["title"]);
	$startDate = $_POST["startDate"];
	$endDate = $_POST["endDate"];
	$location = prepareInput($_POST["location"]);
	$address = prepareInput($_POST["address"]);
	$zip = prepareInput($_POST["zip"]);
	$parkSite = prepareInput($_POST["parkSite"]);
	$checklist = $_POST["checklist"];
	$ice = prepareInput($_POST["ice"]);
	$tripInfoText = prepareInput($_POST["tripInfoText"]);
	//Check the size of the file passed, if 0 then no file was passed
	if ($_FILES['parkMap']['size'] != 0)
	{
		//A map file was passed, get the information about the file and put it in the database
		$parkMap = mysqli_real_escape_string($mysqli, file_get_contents($_FILES['parkMap']['tmp_name']));
		$mapName = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['name'] );
		$mapType = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['type'] );
		$mapSize = mysqli_real_escape_string($mysqli, $_FILES['parkMap']['size'] );
		$query="UPDATE Trip SET  tripName='$tripName', StartDate='$startDate',, EndDate= '$endDate', Location='$location', parkAddress='$address', ZipCode='$zip', ParkSite='$parkSite', map='$parkMap', mapName='$mapName', mapType='$mapType', mapSize='$mapSize', ICEContact='$ice', TripInfo='$tripInfoText' CheckID='$checklist', WHERE tripID=$tid;";
	}
	else
	{
		//No map passed, issue query without map info
		$query="UPDATE Trip SET  tripName='$tripName', StartDate='$startDate', EndDate= '$endDate', Location='$location', parkAddress='$address', ZipCode='$zip', ParkSite='$parkSite', ICEContact='$ice', TripInfo='$tripInfoText', CheckID='$checklist' WHERE tripID=$tid;";

	}
	//Create then submit the query to the databse
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
		header("location:./viewTrip.php?tripId=$tid");
	}
	echo '<br><a href="main.php">Back</a><br>';

?>
