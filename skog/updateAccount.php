<?php

	include './includes/session.php';
	include './includes/dbconnect.php';
	include './includes/functions/prepareInput.php';
	include './includes/functions/regEx.php';

	$uid = $_SESSION['uid'];
	$firstName = prepareInput($_POST['fName']);
	$lastName = prepareInput($_POST['lName']);
	$email = prepareInput($_POST['email']);
	$backButton = '<a href="./editAccount.php">Back</a>';
	
	//****Validate input with preg_match****
	if (! preg_match($emailReg, $email))
	{ echo "Invalid Email Address<br>".$backButton; header('location:./editAccount.php?error=2'); exit;}
	if (! preg_match($nameReg, $firstName))
	{ echo "Invalid Name<br>".$backButton; header('location:./editAccount.php?error=1'); exit;}
	if (! preg_match($nameReg, $lastName))
	{ echo "Invalid Name<br>".$backButton; header('location:./editAccount.php?error=1'); exit;}
	//**************************************
	

	$query="UPDATE members SET fName='$firstName', lName='$lastName', Email='$email' WHERE id=$uid ;";
	$mysqli->query($query);
	if ($mysqli->error)
	{
		//error with database
		echo "Database Error:".$mysqli->error;
	}
	else
	{
		//No errors
		echo "User information updated succesfully.";
		header('location:./editAccount.php');
	}

	$mysqli->close();
?>
<br><a href="./main.php">Back</a>
