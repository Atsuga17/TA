<?php
	require_once('../base.php');
	require_once('../database.php');
	session_start();
	if (isset($_SESSION['user']) or !isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<title>Edit - Admin</title>
</head>
<body>
	<?php require 'templates/navbar.php'; ?>
	<div class="content">
		<div class="form-container">
			<h1>Edit Profil</h1>
			<form action="edit_admin.php" method="POST">
				<?php
					if (isset($_SESSION['admin'])) {
						$table = 'admin';
					} else {
						$table = 'manager';
					}
					$id = $_SESSION['id'];
					$inc = '../../assets/inc/edit.inc';
					require '../../assets/inc/val.inc';
		            $errors = array();
		            if (isset($_POST['submit'])) {
		                validornot($errors, $_POST, $inc, $id, $table);
		                if ($errors) {
				            include $inc;
				        } else {
				            edit($errors, $table, $_POST, $id);
				            echo "<h1>Edit Profil berhasil !</h1>";
				            include $inc;
				        }
		            } else {
		                include $inc;
		            }
				?>
			</form>
		</div>
	</div>
	<?php require '../../assets/inc/footer.inc'; ?>
</body>
</html>