<?php
    require("../base.php");
    require("../database.php");
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../index.php");
        exit();
    }
    $brands = getTableData('brand');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
        <title>User - Brand</title>
    </head>
    <body>
        <?php require '../../assets/inc/navbar.inc'; ?>
        <div class="content">
            <h1>DAFTAR BRAND</h1>
            <?php if (count($brands) > 0) { ?>
                <div class="daftar">
                    <?php foreach ($brands as $brand) : ?>
                        <div class="productCardOuter">
                            <div class="productCardInner">
                                <div class="productCardimage" style="background-image:url(../../assets/images/default.jpeg); background-size:cover;background-position:center;">
                                </div>
                                <div class="productCardtitle">
                                    <?= ucwords($brand["BRAND_NAME"]) ?>
                                </div>
                                <div class="addtocart_outer">
                                    <a href="index.php?prod=<?= $brand["BRAND_ID"]?>"><div class="addtocart">Lihat Produk</div></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else {
                echo "<h2>Tidak ada brand yang ditambahkan</h1>";
            } ?>
        </div>
        <?php require '../../assets/inc/footer.inc'; ?>
    </body>
</html>