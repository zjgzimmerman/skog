<?php
	include_once './includes/session.php';
	
	if (isset($_GET['sure']))
	{
		//Start DB connection and get uid from session
		include './includes/dbconnect.php';
		$uid = $_SESSION['uid'];
		
		//Delete user info in members
		$query = "DELETE FROM members WHERE id=$uid";
		$mysqli->query($query);
		include './includes/dberror.php';
		
		//Delete user's checklists
		$query = "DELETE FROM checklist WHERE userID=$uid";
		$mysqli->query($query);
		include './includes/dberror.php';
		
		//Delete user's messages
		$query = "DELETE FROM messages WHERE userID=$uid";
		$mysqli->query($query);
		include './includes/dberror.php';
		
		//Delete user's trips
		$query = "DELETE FROM Trip WHERE userID=$uid";
		$mysqli->query($query);
		include './includes/dberror.php';
		
		//Delete user's invites
		$query = "DELETE FROM tripInvite WHERE userID=$uid";
		$mysqli->query($query);
		include './includes/dberror.php';
		
		//Go to index
		header("location:./index.php");
	}
?>

<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
		<title>Delete Account</title>
	</head>
	
	<body>
		<div id="content">
		<? include './includes/header.php'; ?>
			<div id="main">
				<h1>Delete Account</h1>
				<div id="confirm">
					<h2 align="center">Are you sure?</h2><br>
					<a href="./deleteAccount.php?sure=1">Yes</a><br>
					<a href="./editAccount.php">No</a>
				</div>
			</div>
		<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>