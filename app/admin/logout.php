<?php
	session_start();
	if (isset($_SESSION['admin'])) {
		unset($_SESSION['admin']);
	} else {
		unset($_SESSION['manager']);
	}
	unset($_SESSION['id']);
	header("location: ../index.php");
	exit();
?>