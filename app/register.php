<?php
	require_once('base.php');
	require_once('database.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL ?>/assets/css/style.css">
	<title>Register</title>
</head>
<body>
	<div class="form-container">
		<h1>Sign Up</h1>
		<form action="register.php" method="POST">
			<?php
				$inc = BASEPATH.'/assets/inc/register.inc';
				$reg =  BASEPATH .'/assets/inc/regVal.inc';
				require $reg;
	            $errors = array();
	            if (isset($_POST['submit'])) {
	                validornot($errors, $_POST, $inc);
	                if ($errors) {
			            include $inc;
			        } else {
			            add($_POST);
			            echo "<h1>Registrasi berhasil !</h1>";
			            echo 'Anda akan diarahkan ke <a href="index.php">Halaman login</a>';
			            header("refresh:3;url=index.php");
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