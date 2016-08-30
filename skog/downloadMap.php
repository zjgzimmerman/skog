<?php
	include './includes/session.php';
	include './includes/dbconnect.php';
	//Take in tripId as a GET variable then download the map
	$tripID = $_GET['tripId'];
	//query to get map data and associated information
	$query = "SELECT map, mapName, mapType, mapSize FROM Trip WHERE TripID=".$tripID.";";
	$result = $mysqli->query($query);
	if ($mysqli->error)
	{
		//error with database
		echo "Database Error:".$mysqli->error;
	}
	else
	{
		//No errors
		if ($result)
		{
			$row = mysqli_fetch_assoc($result);
			//Headers to tell the browser what kind of file it is
			header("Content-Type: ". $row['mapType']);
			header("Content-Length: ". $row['mapSize']);
			header("Content-Disposition: attachment; filename=". $row['mapName']);
			//output the data to be downloaded
			echo $row['map'];
		}
		else
		{
			echo "Invalid trip ID";
		}
	}
	echo '<a href="./main.php">Back</a>';
	


?>
