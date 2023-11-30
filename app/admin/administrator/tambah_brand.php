<?php
	require_once('../../base.php');
	require_once('../../database.php');
	session_start();
	if (!isset($_SESSION['admin'])) {
		header("Location: ../index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
		<title>Admin - AddBrand</title>
	</head>
	<body>
		<?php require '../../../assets/inc/navbar.inc'; ?>
		<div class="content">
			<div class="form-container">
				<h1>Tambah Brand</h1>
				<form action="tambah_brand.php" method="POST" enctype="multipart/form-data">
					<?php
						$table = 'brand';
						$inc = '../../../assets/inc/brandForm.inc';
						require '../../../assets/inc/adManVal.inc';
			            $errors = array();
			            if (isset($_POST['submit'])) {
			                validornot($errors, [$_POST, $_FILES]);
			                if ($errors) {
					            include $inc;
					        } else {
					            addBrand([$_POST, $_FILES]);
					            echo "<h1>Tambah Brand berhasil !</h1>";
					            header('location: manajemen_brand.php');
					            exit();
					        }
			            } else {
			                include $inc;
			            }
					?>
					<div class="form-field">
						<input type="submit" name="submit" value="Tambah Brand">
						<a href="manajemen_brand.php">Batal</a>
					</div>
				</form>
			</div>
		</div>
		<?php require '../../../assets/inc/footer.inc'; ?>
	</body>
</html>