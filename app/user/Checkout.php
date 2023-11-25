<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    $total = 0;
    require('../base.php');
    require("../database.php");

    $id = $_GET['id'];
    $user = getAllData('user', $_SESSION["id"]);
    $order_detail = getOrderDetailData($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!--FONT AWESOME-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="body_checkout">
    <div class="head_form">
        <h3>Checkout</h3>
    </div>
    
    <form action="Bayar.php" method="post">
        <div class="alamat_checkout">
            <label for="alamat">Alamat Pengiriman : </label>
            <div class="alamat">
                <?= $user[0]["ADDRESS"];?>
            </div>
        </div>
        <div class="produk_checkout">
            <?php foreach($order_detail as $OD){ $product = getProductfromID($OD["PRODUCT_ID"]);?>
                <div class="produk_checkout_inner">
                    <div class="gbr">
                        <img src="<?= BASEURL; ?>/assets/images/products/<?= $product["PRODUCT_IMG"]; ?>">
                    </div>
                    <div class="ket">
                        <?= $product["PRODUCT_NAME"]?>
                        <?= $product["PRODUCT_PRICE"]?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="pesan_checkout">
            <!-- <label for="pesan">Pesan : </label> -->
            <textarea class="kolom_pesan_checkout" placeholder="Pesan untuk penjual (Opsional)" name="pesan" cols="70" rows="5"></textarea>
        </div>
        <div class="total_checkout">
            <?php
                $total + $total = $product["PRODUCT_PRICE"];
            ?>
            <span>Total</span><span><?= $total?></span>
        </div>
        <div class="metode_checkout">
            <select name="metode">
                <option value="" select disabled>Pilih Metode Pembayaran</option>
                <option value="Mandiri">Bank Mandiri</option>
                <option value="Bank Rakyat Indonesia (BRI)">BRI</option>
                <option value="Bank Negara Indonesia (BNI)">BNI</option>
                <option value="Bank Central Asia (BCA)">BCA</option>
                <option value="Bank Mega">Bank Mega</option>
            </select>
        </div>
        <div class="no_rek">
            <label for="rekening">No. Rekening</label>
            <input type="text" name="rekening">
        </div>
        <div class="rincian_checkout"></div>
        <div class="buatpesanan_checkout">
            <div class="last-total"></div>
            <input class="Buat-Pesanan" type="submit" name="submit" value="Buat Pesanan">
        </div>
        <input type="hidden" name="productid" value="<?= $id?>">
    </form>
</body>
</html>