<?php include './includes/session.php';

	//Make sure checklist ID variable was passed
	if (! isset($_GET["checkId"]))
		{echo "Variable not found";}
	//Setting session variables to local variables
	$uid = $_SESSION["uid"];

	$checkID = $_GET["checkId"];

	//Include db connection and query the db
	include './includes/dbconnect.php';
	$query = "SELECT * FROM checklist WHERE checkID = $checkID AND userId = $uid" ;
	$result = $mysqli->query($query);

	//if there is an error with the statement, output it
	if ($mysqli->error)
	{ echo "Database Error: ".$mysqli->error; exit;}
	$list = $result->fetch_assoc();
	//Close connection 
	$mysqli->close();





?>
<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>
	
	<body>
		<div id="content">
		<? include './includes/header.php'; ?>
		<div id="main">
		<h2><?php  echo $list["title"];  ?></h2></br></h2>
		    <?php echo nl2br($list["content"]); ?></br>
		<?php echo '<a href="./editChecklist.php?checkId='.$_GET["checkId"].'">Edit</a></br>'; ?>
		<?php echo '<a href="./deleteChecklist.php?checkId='.$_GET["checkId"].'" >Delete</a></br>'; ?>
		<a href="./main.php">Back</a>
		</div>
		<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>
