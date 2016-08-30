<?php
//Start session and check if user is logged in
//If not, redirect to home
include './includes/session.php';

//Function that automatically prints out links for available trips
//The option parameter specifies if the trips are current (1) or past (2)
function printTrips($option)
 {
	//Initiate database instance
	include './includes/dbconnect.php';
	//Get user id from the session variable
	$uid = $_SESSION["uid"];
	
	//If the user is an admin then send them back to the admin page
	if ($uid == 0)
	{ header('location:./admin.php'); }
	
	
	//Run query to get all user trips
	//the option variable specifies if the results should be current or past lists
	if ($option == 1)
	{
		$tripQuery = "SELECT * FROM Trip WHERE userID = $uid AND EndDate > CURRENT_DATE() ORDER BY StartDate ASC";
	}
	elseif ($option == 2)
	{
		$tripQuery = "SELECT * FROM Trip WHERE userID = $uid AND EndDate < CURRENT_DATE() ORDER BY StartDate ASC";
	}
	$result = $mysqli->query($tripQuery);
	
	if ($result->num_rows != 0)
	{
		//Found a trip result
		//Iterate through trips and output the results as a link to the trip
		while ($row = mysqli_fetch_assoc($result))
		{
			$title = $row["tripName"];
			$tripId = $row["TripID"];
			echo "<b><a href='./viewTrip.php?tripId=$tripId'>".$title." </a></b></br>";
		}
	}
	else
	{
		//no trip results
		if ($option == 1)
		{
			echo "No trips created<br>";
		}
	}
 }


 //Function that automatically prints out links for available checklists
 function printChecklists()
 {
	//Initiate database variable
	include './includes/dbconnect.php';
	//Get user id from the session variable
	$uid = $_SESSION["uid"];
	//Run query to get all user checklists
	$checkListQuery = "SELECT * FROM checklist WHERE userID = $uid ORDER BY title ASC";
	$result = $mysqli->query($checkListQuery);
	
	if ($result->num_rows != 0)
	{
		//Found a checklist result
		//Iterate through checklists and output the results as a link to the checklist
		while ($row = mysqli_fetch_assoc($result))
		{
			$title = $row["title"];
			$checkId = $row["checkID"];
			echo "<b><a href='./viewChecklist.php?checkId=$checkId'>".$title." </a></b></br>";
		}
	}
	else
	{
		//no checklists results
		echo "No checklists created<br>";
	}
 }
//Function that automatically prints out links for available invited trips
//The option parameter specifies if the trips are current (1) or past (2)
 function printInvitedTrips($option)
 {
	//Initiate database instance
	include './includes/dbconnect.php';
	include_once './includes/functions/hasAccepted.php';
	//Get user id from the session variable
	$uid = $_SESSION["uid"];
	//Run query to get all user checklists
	//Check option to see if they are current or past trips
	if ($option == 1)
	{
		$inviteQuery = "SELECT * FROM tripInvite i INNER JOIN Trip t ON i.tripID = t.tripID WHERE i.userID = $uid AND EndDate > CURRENT_DATE() ORDER BY StartDate ASC";
	}
	elseif ($option == 2)
	{
		$inviteQuery = "SELECT * FROM tripInvite i INNER JOIN Trip t ON i.tripID = t.tripID WHERE i.userID = $uid AND EndDate < CURRENT_DATE() ORDER BY StartDate ASC";
	}
	$result = $mysqli->query($inviteQuery);
	
	if ($result->num_rows)
	{
		//Found a trip result
		//Iterate through checklists and output the results as a link to the checklist
		while ($row = mysqli_fetch_assoc($result))
		{
			$title = $row["tripName"];
			$tripId = $row["TripID"];
			echo "<b><a href='./viewTripInvite.php?tripId=$tripId'>".$title." </a></b> &nbsp &nbsp";
			echo "<br>";
		}
	}
	else
	{
		//no checklists results
		if ($option == 1)
		{
			echo "No trip invitations<br>";
		}
	}
 }
 
 ?> 

<html>
	<head>
		<?php echo "<title>".$_SESSION["fname"]."'s Home</title>"; ?>
		<? include './includes/htmlhead.php'; ?>
	</head>
	<body>
		<div id="content">
			<div id="header">
				<? include './includes/header.php' ?>
			</div>
			<div id="main">
				<a href="createTrip.php">New Trip</a><br>
				<a href="createChecklist.php">New Checklist</a>
				<h2>Trips</h2>
				<? printTrips(1); ?>
				
				</br></br>
				<h2>Trip Invitations</h2>
				<? printInvitedTrips(1); ?><br><br>
				<h2>Checklists</h2>
				<? printChecklists(); ?><br><br>
				<h2>Past Trips</h2>
				<? printTrips(2); ?>
				<? printInvitedTrips(2); ?>
				</br></br>
				
			</div>
			<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>
