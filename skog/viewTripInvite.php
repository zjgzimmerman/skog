<?php 
	include './includes/session.php';
	include './includes/functions/uidToName.php';
	include './includes/functions/uidToUsername.php';
	include './includes/dbconnect.php';
	include './includes/functions/isInvited.php';
	include './includes/functions/hasAccepted.php';

	//Make sure checklist ID variable was passed
	if (! isset($_GET["tripId"]))
		{echo "trip ID not found";}
	//Setting session and get variables to local variables
	$uid = $_SESSION["uid"];
	$tripID = $_GET["tripId"];

	//Make sure user was invited to trip, then get trip information
	if (isInvited($uid, $tripID))
	{
		$query = "SELECT * FROM Trip WHERE TripID = $tripID;" ;
		$result = $mysqli->query($query);
		include './includes/dberror.php';
		if (  $result->num_rows == 0)
		{
			echo "Error retrieving trip";
			exit;
		}
		$list = $result->fetch_assoc();
	}
	else
	{
		echo "Not invited to trip";
		echo "<br><a href='./main.php'>Back</a>";
		exit;
	}
	
	if (hasAccepted($uid, $tripID))
			{
				$accept =  "<a href='./acceptTrip.php?tripId=$tripID'>Leave trip</a>";
			}
			else
			{
				$accept = "<a href='./acceptTrip.php?tripId=$tripID'>Join trip</a>";
			}
			
	
	function invitedUsers($tid)
	{
		include './includes/dbconnect.php';
		include_once './includes/functions/hasAccepted.php';
		//****Code to get invited users****
		$inviteQuery = "SELECT * FROM tripInvite WHERE tripID=$tid;";
		$users = $mysqli->query($inviteQuery);
		include './includes/dberror.php';
		//****************************
		if ($users->num_rows > 0)
		{
			//Found invited users
			//Iterate through invited users
			while ($row = mysqli_fetch_assoc($users))
			{
				$name = uidToUsername($row['userID']);
				if (hasAccepted($row['userID'], $tid))
				{ 
					echo "<span id='accept'>$name has accepted</span><br>"; 
				}
				else
				{ 
					echo "<span id='noAccept'>$name has not accepted</span><br>"; 
				}
			}
		}
		else
		{
			//no invitations
			echo "<br>No users invited<br>";
		}
		$mysqli->close();
	}
	
	//Function to print out all the messages for the trip
	function printMessages($tid)
	{
		include './includes/dbconnect.php';
		
		//****Code to get messages****
		$messageQuery = "SELECT * FROM messages WHERE tripID=$tid ORDER BY time ASC;";
		$messages = $mysqli->query($messageQuery);
		if ($mysqli->error)
			{ echo "Database error retrieving messages: ".$mysqli->error; exit;}
		//****************************
		if ($messages)
				{
					//Found a checklist result
					//Iterate through checklists and output the results as a link to the checklist
					while ($row = mysqli_fetch_assoc($messages))
					{
						$name = uidToName($row['userID']);
						$username = uidToUsername($row['userID']);
						$text = $row['messageText'];
						$time = $row['time'];
						echo "$time<br>";
						echo "<b>Message from: (".$username.") ".$name."<br></b><br>";
						echo "$text</br><hr>";
					}
				}
				else
				{
					//no messages
					echo "<br>No messages posted<br>";
				}
	}
	
	function printChecklist($tid)
	{
		include './includes/dbconnect.php';
		$query="SELECT c.title, c.content FROM checklist c JOIN Trip t ON c.checkID = t.CheckID WHERE TripID = $tid";
		$result = $mysqli->query($query);
		
		if ( $row = mysqli_fetch_assoc($result))
		{
			echo "<strong><u>".$row["title"]."</u></strong><br>";
			echo nl2br($row["content"]);
		}
		else
		{
			echo "No checklist";
		}
	}
	
	//Close connection 
	$mysqli->close();
?>
<html>
	<head>
	<? include './includes/htmlhead.php'; ?>
	</head>
	
	<body>
		<div id="content">
		<div id="main">
			<? include './includes/header.php'; ?>
			<h1><? echo $list["tripName"]; ?></h1><br>
			<?echo "$accept";?><br>
			<strong>Start Date:</strong> <? echo date( 'F \- d \- Y' , strtotime($list["StartDate"])); ?><br>
			<strong>End Date:</strong> <? echo date( 'F \- d \- Y' , strtotime($list["EndDate"])); ?><br>
			<h2>Location</h2>
			<strong>Address:</strong> <? echo $list["parkAddress"]." ".$list["ZipCode"]; ?><br>
			<strong>Additional Information:</strong> <? echo $list["Location"]; ?>
			
			<? if (! is_null($list["map"]))
			{ echo '<br><a href="./downloadMap.php?tripId='.$tripID.'">Download Map</a>'; } ?>
			<h2>Trip Information</h2>
			<? echo $list["TripInfo"] ?><br><br>
			<strong>ICE Contact:</strong> <? echo $list["ICEContact"] ?><br>
			<strong>Website:</strong> <? echo $list["ParkSite"] ?><br><br>
			<h2>Checklist</h2>
			<? printChecklist($tripID); ?>
			<h2>Invited users</h2>
			<? invitedUsers($tripID); ?>
			
			<br><a href="./main.php">Back</a>

			<h2>Messages</h2><br><hr>
			<? printMessages($tripID);?>
			<hr>
			<h2>Post a message</h2>		
			<form name="messageForm" action="postMessage.php" method="POST">
				<textarea rows="10" cols="30" name="messageText" maxlength="50000" required></textarea><br>
				<input type="submit" value="Post" class="button">
				<input type="hidden" name="tripId" value="<?php echo $tripID; ?>">
			</form>
		</div>
		<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>

