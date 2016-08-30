<?php include './includes/session.php'; 
			include './includes/getChecklist.php';
			$result = getChecklist($_GET["checkId"]);
		?>
		
<html>
	<head>
	<? include './includes/htmlhead.php'; ?>
	</head>

	<body>
		<div id="content">
			<? include './includes/header.php'; ?>
			<div id="main">
				<form name="checklist" action="updateChecklist.php" method="post">
					<label>Title:</label> <br><input type="text" name="title" value=" <?php echo $result["title"] ?>" size="40" required ><br>
					<label>Checklist:</label> <br><textarea rows="10" cols="30" name="checkText" maxlength="1000000" required><?php echo $result["content"]; ?></textarea><br>
					<input type="submit" value="Update" class="button">
					<input type="hidden" name="checkId" value="<?php echo $_GET["checkId"] ?>">
				</form>
			<a href="./main.php">Back</a>
			</div>
			<? include './includes/footer.php'; ?>
		</div>
	</body>
	
</html>
