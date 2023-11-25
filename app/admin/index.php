<?php
	require_once('../base.php');
	require_once('../database.php');
	if (isset($_SESSION['admin'])) {
		header('location: administrator/index.php');
		exit();
	} elseif (isset($_SESSION['manager'])) {
		header('location: manager/index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<title>Login - Admin</title>
</head>
<body>
	<div class="form-container">
		<h1>Login Admin</h1>
		<form action="index.php" method="POST">
			<?php
				$inc = '../../assets/inc/login.inc';
				require '../../assets/inc/logVal.inc';
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