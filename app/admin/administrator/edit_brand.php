<?php
	require_once('../../base.php');
	require_once('../../database.php');
	session_start();
	if (!isset($_SESSION['admin'])) {
		header("Location: ../index.php");
		exit();
	}
	$brands = getTableData('brand');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$brand = getAllData('brand', $id);
	} elseif (isset($_POST['id'])) {
		$id = $_POST['id'];
		$brand = getAllData('brand', $id);
	} else {
		header("location: manajemen_brand.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
		<title>Admin - Brand - Edit</title>
	</head>
	<body>
		<?php require '../../../assets/inc/navbar.inc'; ?>
		<div class="content">
			<div class="form-container">
				<h1>Edit Brand</h1>
				<form action="edit_brand.php" method="POST">
					<div class="form-field">
                        <input type="hidden" name="id" value="<?php echo $brand[0]['BRAND_ID']; ?>">
                    </div>
					<?php
						$inc = '../../../assets/inc/brandForm.inc';
						require '../../../assets/inc/adManVal.inc';
			            $errors = array();
			            if (isset($_POST['submit'])) {
			                validornot($errors, [$_POST]);
			                if ($errors) {
					            include $inc;
					        } else {
					            editBrand([$_POST]);
					            echo "<h1>Edit Produk berhasil !</h1>";
					            header('location: manajemen_brand.php');
					        }
			            } else {
			                include $inc;
			            }
					?>
					<div class="form-field">
						<input type="submit" name="submit" value="Edit Brand">
						<a href="manajemen_brand.php">Batal</a>
					</div>
				</form>
			</div>
		</div>
		<?php require '../../../assets/inc/footer.inc'; ?>
	</body>
</html>