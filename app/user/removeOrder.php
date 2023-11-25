<?php
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
session_start();
removeOrder($_GET['id']);
?>