<?php
	require_once('base.php');
	require_once('database.php');
	if (isset($_SESSION['admin'])) {
		header('location: admin/administrator/index.php');
		exit();
	} elseif (isset($_SESSION['manager'])) {
		header('location: admin/manager/index.php');
		exit();
	}elseif (isset($_SESSION['user'])) {
		header('location: user/index.php');
		exit();}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<title>Login</title>
</head>
<body>
	<div class="form-container">
		<h1>Login</h1>
		<form action="index.php" method="POST">
			<?php
				$inc = '../assets/inc/form-login.inc';
				require '../assets/inc/logVal.inc';
				require_once('base.php');
    			require_once("database.php");
	            $errors = array();
	            if (isset($_POST['submit'])) {
	            	validornot($_POST, $errors, $inc);
	            } else {
	                include $inc;
	            }
			?>
		</form>
	</div>
</body>
</html>