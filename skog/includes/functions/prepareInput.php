<?php
	//Function that takes a string, then strips out any mysql special characters, strips slashes, then trims whitespace
	//then returns the string
	function prepareInput ( $input )
	{
		include './includes/dbconnect.php';
		$output = stripslashes($input);
		$output = mysqli_real_escape_string($mysqli, $output);
		$output = trim($output);
		$mysqli->close();
		return $output;
	}
?>