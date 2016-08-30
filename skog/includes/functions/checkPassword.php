<?php
	//Function to check if a password for a user is correct
	//Input is the user identification number and the unhashed password
	//output is true or false
	function checkPassword($uid, $password)
	{
		include './includes/dbconnect.php';
		//hash incoming password
		$password = md5($password);
		$query = "SELECT * FROM members WHERE id = $uid AND password='$password'";
		$result = $mysqli->query($query);
		//If there is a result then the password is correct
		if ($result->num_rows == 1)
		{	
			//results from query returned
			return true;
		}
		else
		{
			//No results from query returned
			return false;
		}

	}
?>
