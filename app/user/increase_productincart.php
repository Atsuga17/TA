<?php
	require_once("../base.php");
	require_once("../database.php");
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
	$user = $_SESSION['id'];
	$a = GetCartID($user);
	plus_productincart($a[0]["CART_ID"],$_GET['pro']);
?>