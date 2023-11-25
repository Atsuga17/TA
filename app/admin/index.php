<?php
	require_once('../base.php');
	require_once('../database.php');
	if (isset($_SESSION['admin'])) {
		header('location: administrator/index.php');
		exit();
	} elseif (isset($_SESSION['manager'])) {
		header('location: manager/index.php');
		exit();
	} else {
		header('location: ../index.php');
	}
?>