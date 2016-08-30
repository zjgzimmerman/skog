<?php
	function uidToUsername($uid)
	{
		include './includes/dbconnect.php';
		$query = "SELECT username FROM members WHERE id=$uid";
		$result = $mysqli->query($query);
		if ($row = mysqli_fetch_assoc($result))
		{
			return $row['username'];
		}
		else
		{
			return false;
		}
	}

?>
