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
		$products = getAllData('product', $id);
		$old = $products[0]["PRODUCT_IMG"];
	} elseif (isset($_POST['id'])) {
		$id = $_POST['id'];
		$products = getAllData('product', $id);
		$old = $products[0]["PRODUCT_IMG"];
	} else {
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
		<title>Admin - Edit Product</title>
	</head>
	<body>
		<?php require '../../../assets/inc/navbar.inc'; ?>
		<div class="content">
			<div class="form-container">
				<h1>Edit Produk</h1>
				<form action="edit_produk.php" method="POST" enctype="multipart/form-data">
					<div class="form-field">
                        <img src="../../../assets/images/products/<?php if (isset($_POST['old'])) {echo $_POST['old'];} else {echo $old;} ?>" alt="product">
                        <input type="hidden" name="old" value="<?php if (isset($_POST['old'])) {echo $_POST['old'];} else {echo $old;} ?>">
                        <input type="hidden" name="id" value="<?php echo $products[0]['PRODUCT_ID']; ?>">
                    </div>
					<?php
						$inc = '../../../assets/inc/productForm.inc';
						require '../../../assets/inc/adManVal.inc';
			            $errors = array();
			            if (isset($_POST['submit'])) {
			                validornot($errors, [$_POST, $_FILES]);
			                if ($errors) {
					            include $inc;
					        } else {
					            editProduct([$_POST, $_FILES]);
					            echo "<h1>Edit Produk berhasil !</h1>";
					            header('location: index.php');
					        }
			            } else {
			                include $inc;
			            }
					?>
					<div class="form-field">
						<input type="submit" name="submit" value="Edit Produk">
						<a href="index.php">Batal</a>
					</div>
				</form>
			</div>
		</div>
		<?php require '../../../assets/inc/footer.inc'; ?>
	</body>
</html>