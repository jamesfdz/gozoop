<?php
	session_start();

	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		session_unset();
		header("location: index.php");
	}

?>