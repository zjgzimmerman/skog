<?php
	include './includes/dbconnect.php';
	include './includes/functions/prepareInput.php';
	include './includes/functions/regEx.php';
	
	//Get form variables and prepare the input
	//(remove mysql special chars and strip slashes)
	$user = prepareInput($_POST["username"]);
	$password = prepareInput($_POST["password"]);
	$passwordConfirm = prepareInput($_POST["passwordConfirm"]);
	$fName = prepareInput($_POST["fName"]);
	$lName = prepareInput($_POST["lName"]);
	$email = prepareInput($_POST["email"]);
	$backButton = '<a href="./newUser.php">Back</a>';
	

	//****Validate input with preg_match****
	if (! preg_match($emailReg, $email))
	{ echo "Invalid Email Address<br>".$backButton; header('location:newUser.php?error=2');}
	if (! preg_match($userReg, $user))
	{ echo "Invalid username<br>".$backButton; header('location:newUser.php?error=3'); }
	if (! preg_match($nameReg, $fName))
	{ echo "Invalid Name<br>".$backButton; header('location:newUser.php?error=4'); }
	if (! preg_match($nameReg, $lName))
	{ echo "Invalid Name<br>".$backButton; header('location:newUser.php?error=4'); }
	if (! preg_match($passReg, $password))
	{ echo "Invalid password<br>".$backButton; header('location:newUser.php?error=5'); }
	//**************************************

	//Check if username exists in the database already
	if (userExists($user))
	{
		echo "Username already exists<br>";
		header('location:newUser.php?error=1');
	}
	else
	{
		//User doesn't exist, create user
		if ($password == $passwordConfirm)
		{
			//Passwords match, continue creating user
			insertUser($user, $fName, $lName, $email, md5($password));
		}
		else
		{
			//Password doesn't match
			header('location:newUser.php?error=6');
		}
	}




//*******Additional Functions*********

	//Function to see if the user name already exists in the database
	function userExists($u)
	{
		include './includes/dbconnect.php';
		$dbout = $mysqli->query("SELECT * FROM members WHERE username ='".$u."'"); 
		
		// if the query result is empty, user doesn't exist
		if (is_null($test = $dbout->fetch_assoc()))
			{
				return false;
			}
		else 
			{
				return true;
			}
		$mysqli->close();
	}


	//Function to add a new user into the database, input needs to be sanitized and validated beforehand
	//And password hashed
	function insertUser($username, $firstN, $lastN, $mail, $passHash)
		{
			include './includes/dbconnect.php';
			//Query to insert a new user into the database
			$query = "INSERT INTO members (fName, lName, Email, username, password) VALUES ('".$firstN."', '".$lastN."', '".$mail."', '".$username."', '".$passHash."');";
			$mysqli->query($query);
			if ($mysqli->error)
			{
				echo "Databaes Error:".$mysqli->error;
			}
			else
			{
				echo "<br>User Created";
				header('location:./index.php');
			}
			$mysqli->close();
		}

?>
<a href="./main.php">Back</a>
