<?php
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
session_start();
$a = $_SESSION['id'];
// var_dump($a);
BayarOrder($a, $_POST["metode"], $_POST["rekening"],$_POST["productid"]);
?>
