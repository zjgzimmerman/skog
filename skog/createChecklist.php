<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>

	<body>
		<div id="content">
			<? include './includes/header.php'; ?>
			<div id="main">
				<h2>New Checklist</h2>
				<form name="checklist" action="addChecklist.php" method="post">
					<label>Title:</label><br><input type="text" name="title" size="40" required><br>
					<label>Checklist:</label><br> <textarea rows="10" cols="30" name="checkText" maxlength="1000000" required></textarea><br>
					<input type="submit" value="Submit" class="button">
				</form>
				<a href="./main.php">Back</a>
			</div>
			<? include './includes/footer.php'; ?>
		</div>
	</body>
	
</html>
