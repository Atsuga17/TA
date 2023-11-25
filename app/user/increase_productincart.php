<?php
require_once("../base.php");
require_once("../database.php");
session_start();
$user = $_SESSION['id'];
$a = GetCartID($user);
// var_dump($a);
plus_productincart($a[0]["CART_ID"],$_GET['pro']);
?>