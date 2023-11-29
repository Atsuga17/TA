<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $products = getProductwithBrands();
    if (isset($_GET['prod'])) {
        $products = getBrandProduct($_GET['prod']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOYStore</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="index-user">
	<?php include("../../assets/inc/navbar.inc") ?>
	
    <h1>List Product</h1>
	<div class="daftar">
    <?php foreach ($products as $product) : ?>
        <div class="productCardOuter">
            <div class="productCardInner">
                <div class="productCardimage" style="background-image:url(<?= BASEURL ?>/assets/images/products/<?= $product["PRODUCT_IMG"] ?>); background-size:cover;background-position:center;">

                </div>
                <div class="productdetail">
                    <div class="productCardtitle">
                        <?= ucwords($product["PRODUCT_NAME"]) ?>
                    </div>
                    <div class="productCardprice">
                        <?= "Rp " . number_format($product["PRODUCT_PRICE"], 0, ',', '.'); ?>
                    </div>
                    <div class="productCardinfo">
                        <span class="productCardinfo-category"><?= ucwords($product["BRAND_NAME"]) ?></span>
                        <span class="productCardinfo-stock">Stok : <?= $product["PRODUCT_STOCK"] ?></span>
                    </div>
                    <div class="addtocart_outer">
                        <a href="addproduct.php?pro=<?= $product["PRODUCT_ID"] ?>"><div class="addtocart">Add To Cart</div></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
	</div>

	<?php include("../../assets/inc/footer.inc");?>

</body>
</html>