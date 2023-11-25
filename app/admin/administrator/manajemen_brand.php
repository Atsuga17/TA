<?php
    require("../../base.php");
    require("../../database.php");
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: ../index.php");
        exit();
    }
    $brands = getTableData('brand');
    if (isset($_GET['id'])) {
        delete($_GET['id'], 'brand');
        header('location: manajemen_brand.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
        <title>Admin - Brand</title>
    </head>
    <body>
        <?php require '../../../assets/inc/navbar.inc'; ?>
        <div class="content">
            <div class="add">
                <a class="primary-btn" href="tambah_brand.php">tambah</a>
            </div>
            <h1>DAFTAR BRAND</h1>
            <?php if (count($brands) > 0) { ?>
                <div class="card-container">
                    <?php foreach ($brands as $brand) : ?>
                        <div class="card">
                            <div class="cardImg" style="background-image:url(../../../assets/images/default.jpeg); background-size:cover;background-position:center;">
                            </div>
                            <div class="cardInfo">
                                <?= ucwords($brand["BRAND_NAME"]) ?>
                            </div>
                            <div class="cardInfo">
                                <a href="edit_brand.php?id=<?= $brand["BRAND_ID"]?>" class="primary-btn">Edit</a> 
                                <a href="manajemen_brand.php?id=<?= $brand["BRAND_ID"]?>" class="primary-btn">Hapus</a>
                                <a href="index.php?prod=<?= $brand["BRAND_ID"]?>" class="primary-btn">Lihat Produk</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else {
                echo "<h2>Tidak ada brand yang ditambahkan</h1>";
            } ?>
        </div>
        <?php require '../../../assets/inc/footer.inc'; ?>
    </body>
</html>