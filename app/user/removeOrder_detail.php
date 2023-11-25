<?php
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
session_start();
removeOrder_detail($_GET['id']);
?>