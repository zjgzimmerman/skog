<?php
	include './includes/session.php';
	include './includes/dbconnect.php';
	
	$uid = $_SESSION['uid'];
	$query = "SELECT * FROM members WHERE id=$uid";
	$result = $mysqli->query($query);
	$list = $result->fetch_assoc();

	$mysqli->close();
	
	//Initializing error variable
	$error = "";
	//Check if there is a value in the GET error variable
	//if so, check the error code and issue the proper message
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == 1)
		{ $error = "<span class='error'>Name invalid</span><br>"; }
		if ($_GET['error'] == 2)
		{ $error = "<span class='error'>Email address invalid</span><br>"; }
		if ($_GET['error'] == 3)
		{ $error = "<span class='error'>Password invalid</span><br>"; }
		if ($_GET['error'] == 4)
		{ $error = "<span class='error'>Old password invalid</span><br>"; }
		if ($_GET['error'] == 5)
		{ $error = "<span class='error'>Passwords do not match</span><br>"; }
	}
	
?>
<html>
	<head>
	<? include './includes/htmlhead.php'; ?>
	</head>
	
	<body>
		<div id="content">
		<? include './includes/header.php'; ?>
		<div id="main">
	<h1>Account Settings</h1>
		<? echo $error; ?>
		<form name="accountInfo" action="updateAccount.php" method="post">
			<label>First Name:</label><br><input type="text" name="fName" value="<? echo $list['fName']; ?>" maxlength="30" required><br>
			<label>Last Name:</label><br><input type="text" name="lName" value="<? echo $list['lName']; ?>"maxlength="30" required><br>
			<label>Email:</label><br><input type="text" name="email" value="<? echo $list['Email']; ?>" maxlength="50" required><br>
		<input type="submit" class="button" value="Update">
		</form>
		<br>
		
		<form name="changePassword" action="updatePassword.php" method="post">
			<label>Old Password:</label><br> <input type="password" name="oldPassword" required><br>
			<label>Password:</label><br><input type="password" name="password" maxlength="40" required><br>
			<label>Confirm Password:</label><br><input type="password" name="passwordConfirm" maxlength="40" required><br>
			<input type="submit" class="button" value="Update Password">
		</form>
		<a href="./deleteAccount.php">Delete Account</a><br>
		<a href="./main.php">Back</a>
		</div>
		<? include './includes/footer.php';?>
		</div>
	</body>
	
</html>

