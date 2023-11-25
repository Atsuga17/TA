<?php
	require_once("../base.php");
	require_once(BASEPATH . "/app/database.php");
	session_start();
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
	$a = $_SESSION['id'];
	Pesan($a);
?>
