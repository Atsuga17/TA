<?php
	require("../../base.php");
	require("../../database.php");
	session_start();
	if (!isset($_SESSION['admin'])) {
		header("Location: ../index.php");
		exit();
	}
	$brands = getTableData('brand');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
		<title>Admin - AddProduct</title>
	</head>
	<body>
		<?php require '../../../assets/inc/navbar.inc'; ?>
		<div class="content">
			<div class="form-container">
				<h1>Tambah Produk</h1>
				<form action="tambah_produk.php" method="POST" enctype="multipart/form-data">
					<?php
						$table = 'product';
						$inc = '../../../assets/inc/productForm.inc';
						require '../../../assets/inc/adManVal.inc';
			            $errors = array();
			            if (isset($_POST['submit'])) {
			                validornot($errors, [$_POST, $_FILES]);
			                if ($errors) {
					            include $inc;
					        } else {
					            addProduct([$_POST, $_FILES]);
					            echo "<h1>Tambah Produk berhasil !</h1>";
					            header('location: index.php');
					            exit();
					        }
			            } else {
			                include $inc;
			            }
					?>
					<div class="form-field">
						<input type="submit" name="submit" value="Tambah Produk">
						<a href="index.php">Batal</a>
					</div>
				</form>
			</div>
		</div>
		<?php require '../../../assets/inc/footer.inc'; ?>
	</body>
</html>