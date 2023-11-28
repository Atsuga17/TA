<?php
	define("BASEURL", "http://localhost/TA/TA");
	define("BASEPATH", $_SERVER["DOCUMENT_ROOT"]."/TA/TA");
	function connect($host, $db, $user, $password) {
			$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
		try {
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
			return new PDO($dsn, $user, $password, $options);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	return define("DB", connect('localhost', 'store', 'root', ''));
?>