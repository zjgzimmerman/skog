<?php
	include_once './includes/session.php';
		echo '<div id="header">';
		echo '<span id="loggedIn"> Logged in as <a href="./editAccount.php">'.$_SESSION["username"].'</a></span>';
		//echo '<span id="mainLogo">SKOG</span>';
		echo '<a href="./logout.php" id="logout">Logout</a>';
		echo '<br><br>';
	echo '</div>';
?>
