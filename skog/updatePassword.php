<?php
	include './includes/session.php';
	include './includes/dbconnect.php';
	include './includes/functions/prepareInput.php';
	include './includes/functions/regEx.php';
	include './includes/functions/checkPassword.php';

	$uid = $_SESSION['uid'];
	$oldPassword = prepareInput($_POST['oldPassword']);
	$password = prepareInput($_POST['password']);
	$passwordConfirm = prepareInput($_POST['passwordConfirm']);
	$backButton = '<a href="./editAccount.php">Back</a>';

	
	//Check if password is valid
	if (! preg_match($passReg, $password))
	{ echo "Invalid password<br>".$backButton; header('location:./editAccount.php?error=3'); exit;}
	//Check if old password is correct
	if ( ! checkPassword($uid, $oldPassword))
	{ echo "Old password is incorrect<br>"; header('location:./editAccount.php?error=4'); exit;}

	if ($password == $passwordConfirm)
	{
		//Passwords match, continue updating
		$passHash = md5($password);
		$query = "UPDATE members SET password='$passHash' WHERE id=$uid;";
		$mysqli->query($query);
		
		if ($mysqli->error)
		{
			//error with database
			echo "Database Error:".$mysqli->error;
		}
		else
		{
			//No errors
			echo "Password updated succesfully.";
			header('location:./editAccount.php');
		}

	$mysqli->close();
	}
	else
	{
		//Password doesn't match
		echo "Passwords do not match";
		header('location:./editAccount.php?error=5');
	}
	

?>
<br><a href="./main.php">Back</a>
