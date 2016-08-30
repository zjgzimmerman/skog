<?php
	//Initializing error variable
	$error = "";
	//Check if there is a value in the GET error variable
	//if so, check the error code and issue the proper message
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == 1)
		{ $error = "<span class='error'>Username already taken</span><br>"; }
		if ($_GET['error'] == 2)
		{ $error = "<span class='error'>Email address invalid</span><br>"; }
		if ($_GET['error'] == 3)
		{ $error = "<span class='error'>Username invalid</span><br>"; }
		if ($_GET['error'] == 4)
		{ $error = "<span class='error'>Name invalid</span><br>"; }
		if ($_GET['error'] == 5)
		{ $error = "<span class='error'>Password invalid</span><br>"; }
			if ($_GET['error'] == 6)
		{ $error = "<span class='error'>Passwords do not match</span><br>"; }
	}
?>

<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>
	<body>
		<div id="content">
			<div id="main">
				<h1>New User</h1>
				<? echo $error; ?>
				<form name="newUserForm" action="addNewUser.php" method="post">
					<label>Username:</label><br> <input type="text" name="username" maxlength="15" required><br>
					<label>Password:</label><br> <input type="password" name="password" maxlength="40" required><br>
					<label>Confirm Password:</label><br> <input type="password" name="passwordConfirm" maxlength="40" required><br>
					<label>First Name:</label><br> <input type="text" name="fName" maxlength="30" required><br>
					<label>Last Name:</label><br> <input type="text" name="lName" maxlength="30" required><br>
					<label>Email:</label><br> <input type="text" name="email" maxlength="50" required><br>
					<input type="Submit" value="Submit" class="button">
				</form>	
				<a href="./index.php">Back</a>
			</div>
			<? include './includes/footer.php'; ?>
		</div>
	</body>
</html>
