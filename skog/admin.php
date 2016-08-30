<?php
	if (isset($_POST["search"]))
	{
		include './includes/functions/prepareInput.php';
		include './includes/dbconnect.php';
		$search = prepareInput($_POST["search"]);
		$query = "SELECT * FROM members WHERE username LIKE '%$search%' AND id <> 0";
		$result = $mysqli->query($query);
	}
	
	//A user number has been passed, delete that user
	if (isset($_GET["user"]))
	{
		//Start DB connection and get uid from session
		include './includes/dbconnect.php';
		$uid = $_GET["user"];
		
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
		header("location:./admin.php");
	}
	
?>

<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>
	
	<body>
		<div id="content">
			<? include './includes/header.php' ?>
			<div id="main">
			<h2>Delete User</h2>
			<form name="deleteUser" action="./admin.php" method="POST">
				<label>Search users:<label><br><input type="text" name="search">
				<input type="submit" value="Search" class="button">
			</form><br>
			<?
				if (isset($_POST["search"]))
				{
					
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "<a href='admin.php?user=".$row['id']."'>".$row['username']."</a>";
					}
					if ($result->num_rows == 0)
					{ echo "No users found"; }
				}
			?>
			</div>
			<? include './includes/footer.php' ?>
		</div>
	</body>
</html>