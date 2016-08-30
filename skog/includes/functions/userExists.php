<?php
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


?>