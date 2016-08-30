<?php
	include './includes/session.php';	
	include './includes/functions/prepareInput.php';

	$searchTerm = prepareInput($_POST['searchTerm']);
	$tripID = $_POST['tripId'];
	$uid = $_SESSION['uid'];
	
	function printUsers($search, $uid, $tid)
	{
		include './includes/dbconnect.php';
		$query = "SELECT * FROM members WHERE username LIKE '%$search%' AND id <> 0 AND id <> $uid";
		$result = $mysqli->query($query);

		while($row = mysqli_fetch_assoc($result))
		{
			echo '<a href="./inviteUser.php?userId='.$row['id'].'&tripId='.$tid.'">'.$row['username'].'</a><br>';
		}
	}
?>
<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>

	<body>
		<div id="content">
			<div id="main">
				<? include './includes/header.php'; ?>
				<h2>User Search</h2>
					<? printUsers($searchTerm, $uid, $tripID) ?>
				<br><a href='./viewTrip.php?tripId=<? echo $tripID; ?>'>Back</a><br>
			</div>
			<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>
