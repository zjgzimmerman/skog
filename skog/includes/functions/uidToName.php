<?php
	function uidToName($uid)
	{
		include './includes/dbconnect.php';
		$query = "SELECT fName, lName FROM members WHERE id=$uid";
		$result = $mysqli->query($query);
		if ($row = mysqli_fetch_assoc($result))
		{
			return $row['fName']." ".$row['lName'];
		}
		else
		{
			return false;
		}
	}

?>
