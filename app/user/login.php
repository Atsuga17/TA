<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<title>Login</title>
</head>
<body>
	<div class="form-container">
		<h1>Login</h1>
		<form action="login.php" method="POST">
			<?php
				$inc = '../../assets/inc/user/login.inc';
				require '../../assets/inc/logVal.inc';
				require_once('../base.php');
    			require_once("../database.php");
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