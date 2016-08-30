
<?php
	include_once './includes/session.php';
	$uid = $_SESSION["uid"];
	function selectChecklists($uid)
	{
		include './includes/dbconnect.php';
		$query = "SELECT title, checkID FROM checklist WHERE userID=$uid;";
		$result = $mysqli->query($query);
		include './includes/dberror.php';
		while ($row = mysqli_fetch_assoc($result))
		{
			$title = $row["title"];
			echo "<option value='".$row['checkID']."'>".$row["title"]."</option>";
		}
		
	}
?>

<html>
	<head>
	<? include './includes/htmlhead.php'; ?>
	</head>

	<body>
		
		<div id="content">
		<? include './includes/header.php';?>
		<div id="main">
		<h2>New Trip</h2>
		<form name="trip" id="tripForm" action="addTrip.php" method="post" enctype="multipart/form-data">
			<label>Title: </label><br> <input type="text" name="title" size="40" required><br>
			<label>Start Date:</label><br> <input type="date" name="startDate" size="40" required><br>
			<label>End Date:</label><br> <input type="date" name="endDate" size="40" required><br>
			<label>Location:</label> <br><input type="text" name="location" size="40" required><br>
			<label>Address:</label><br> <input type="text" name="address" size="40" ><br>
			<label>Zip:</label> <br><input type="text" name="zip" size="40" ><br>
			<label>Park Website:</label><br> <input type="text" name="parkSite" size="40" ><br>
			<label>Park Map:</label><br> <input type="file" name="parkMap"><br>
			<label>ICE Contact:</label><br> <input type="text" name="ice" size="40"  required><br>
			<label>Checklist:</label><br><select name="checklist"><option value=0>None</option><? selectChecklists($uid); ?></select><br><br>
			<label>Addtional Trip Information:</label><br> <textarea rows="10" cols="30" name="tripInfoText" maxlength="1000000" ></textarea><br>
			<input type="submit" value="Submit" class="button">
			<a href="./main.php">Back</a>
			</div>
			<? include './includes/footer.php';?>
			</div>
		</form>
	</body>
	
</html>
