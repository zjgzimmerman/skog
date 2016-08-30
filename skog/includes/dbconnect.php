<?php
//Hostname, username, password, database
$mysqli = new mysqli("localhost", "dbuser", "2jVxD6AvD6P8VAGK", "skog");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
