<?php

include './includes/dbconnect.php';
include './includes/functions/prepareInput.php';
// login information from form
$username=prepareInput($_POST['username']); 
$password=prepareInput($_POST['password']); 
//hash password
$password = md5($password);
//Query to get results for username/password 
$query="SELECT * FROM members WHERE username='$username' AND password='$password'";
//Run query
$result = $mysqli->query($query);
if ($mysqli->error)
{ echo $mysqli->error; exit; }

// If result matched $username and $password, table row must be 1 row
if($userInfo = $result->fetch_assoc())
{
	// Register session variables
	session_start();
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password; 
	$_SESSION["uid"] = $userInfo["id"];
	$_SESSION["fname"] = $userInfo["fName"];
	$_SESSION["lname"] = $userInfo["lName"];
	$_SESSION["email"] = $userInfo["email"];
	//redirect to main.php
	//or admin.php if the user is an admin
	if ($userInfo["id"] == 0)
	{header("location: ./admin.php");}
	else
	{header('location:main.php');}
}
else 
{
	echo "Incorrect Username or Password";
	echo '<a href="./index.php">Back</a>';
	header('location:index.php?invalid=1');
}
?>
