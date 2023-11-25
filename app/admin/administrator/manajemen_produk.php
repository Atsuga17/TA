<?php
    require("../../base.php");
    require("../../database.php");
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }
    $products = getProductwithBrands();
    if (isset($_GET['id'])) {
        delete($_GET['id'], 'product');
        header('location: manajemen_produk.php');
    } elseif (isset($_GET['prod'])) {
        $products = getBrandProduct($_GET['prod']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
        <title>Document</title>
    </head>
    <body>
        <div class="content">
            <a href="index.php">Kembali</a>
            <div class="add-product">
                <a href="tambah_produk.php">tambah</a>
            </div>
            <h1>DAFTAR PRODUK</h1>
            <?php if (count($products) > 0) { ?>
                <div class="card-container">
                    <?php foreach ($products as $product) : ?>
                        <div class="card">
                            <div class="cardImg" style="background-image:url(../../../assets/images/products/<?= $product["PRODUCT_IMG"] ?>); background-size:cover;background-position:center;">
                            </div>
                            <div class="cardInfo">
                                <?= ucwords($product["PRODUCT_NAME"]) ?>
                            </div>
                            <div class="cardInfo">
                                <?= "Rp " . number_format($product["PRODUCT_PRICE"], 0, ',', '.'); ?>
                            </div>
                            <div class="cardInfo">
                                <span class="productCardinfo-category"><?= ucwords($product["BRAND_NAME"]) ?></span>
                                <span class="productCardinfo-stock">Stok : <?= $product["PRODUCT_STOCK"] ?></span>
                            </div>
                            <div class="cardInfo">
                                <a href="edit_produk.php?id=<?= $product["PRODUCT_ID"]?>" class="primary-btn">Edit</a> 
                                <a href="manajemen_produk.php?id=<?= $product["PRODUCT_ID"]?>" class="primary-btn">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else {
                echo "<h2>Tidak ada produk yang dapat ditampilkan</h2>";
            } ?>
        </div>
    </body>
</html>