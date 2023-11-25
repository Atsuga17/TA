<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<title>Register</title>
</head>
<body>
	<div class="form-container">
		<h1>Sign Up</h1>
		<form action="register.php" method="POST">
			<?php
				$inc = '../../assets/inc/user/register.inc';
				require '../../assets/inc/regVal.inc';
				require_once('../base.php');
    			require_once("../database.php");
	            $errors = array();
	            if (isset($_POST['submit'])) {
	                validornot($errors, $_POST, $inc);
	                if ($errors) {
			            include $inc;
			        } else {
			            add($_POST);
			            echo "<h1>Registrasi berhasil !</h1>";
			            echo 'Anda akan diarahkan ke <a href="login.php">Halaman login</a>';
			            header("refresh:3;url=login.php");
			            exit();
			        }
	            } else {
	                include $inc;
	            }
			?>
		</form>
	</div>
</body>
</html>