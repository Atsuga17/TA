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

    $PayMethod = showUserPaymentData($_SESSION["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOYStore</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="body_checkout">
    <div class="head_form">
        <a href="Belum_Bayar.php">Kembali</a>
        <h3>Checkout</h3>
        <span> </span>
    </div>
    
    <form action="Bayar.php" method="post">
        <div class="alamat_checkout">
            <label for="alamat">Alamat Pengiriman : </label>
            <div class="alamat">
                <?= $user[0]["USER_ADDRESS"];?>
                <?= $user[0]["USER_ADDRESS"];?>
            </div>
        </div>
        <div class="produk_checkout">
            <?php foreach($order_detail as $OD){ $product = getAllData("product",$OD["PRODUCT_ID"]);?>
                <div class="produk_checkout_inner">
                    <div class="gbr">
                        <img src="<?= BASEURL; ?>/assets/images/products/<?= $product[0]["PRODUCT_IMG"]; ?>">
                        <img src="<?= BASEURL; ?>/assets/images/products/<?= $product[0]["PRODUCT_IMG"]; ?>">
                    </div>
                    <div class="ket">
                        <?= $product[0]["PRODUCT_NAME"]?>
                        <?= $product[0]["PRODUCT_PRICE"]?>
                        <?= $product[0]["PRODUCT_NAME"]?>
                        <?= $product[0]["PRODUCT_PRICE"]?>
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
                $total + $total = $product[0]["PRODUCT_PRICE"];
                $total + $total = $product[0]["PRODUCT_PRICE"];
            ?>
            <span>Total</span><span><?= $total?></span>
        </div>
        <div class="metode_checkout">
            <label for="metode">Pilih Metode Pembayaran Anda</label>
            <select name="metode">
                <?php 
                    foreach($PayMethod as $PAYMENT){
                        ?>
                            <option class="metodecheckoutopt" value="<?= $PAYMENT["PAYMENT_METHOD_ID"]?>"><?= $PAYMENT["BANK_NAME"]?></option>
                        <?php
                    }
                ?>
                <!-- <a href="Kelola_Metode_Pembayaran">Tambah Metode Pembayaran</a> -->
            </select>
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