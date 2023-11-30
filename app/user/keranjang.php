<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $products = getCartDetail($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOYStore</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
	<?php include("../../assets/inc/navbar.inc"); $a = [];?>
	
    <div class="daftarkeranjang">
        <?php if (count($products) == 0){?>
            <h1>Keranjang Anda Kosong</h1>
        <?php } else {?>
        <table class="tabelkeranjang">
            <tr>
                <th>
                    Produk
                </th>
                <th>
                    Harga
                </th>
                <th>
                    Jumlah
                </th>
                <th>
                    Total
                </th>
            </tr>
            <?php foreach($products as $products){?>
            <tr class="row_product">
                <td>
                    <div class="img_in_cart">
                        <div class="img_icon">
                            <img src="<?= BASEURL; ?>/assets/images/products/<?= $products["PRODUCT_IMG"]; ?>">
                        </div>
                        <div class="keterangan_produk_keranjang">
                            <p><?= $products["PRODUCT_NAME"]?></p>
                            <p class="stock_incart">Stock : <?= $products["PRODUCT_STOCK"]?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="cart_price">
                        <?= $products["PRODUCT_PRICE"]?>
                    </div>
                </td>
                <td>
                    <a href="increase_productincart.php?pro=<?= $products["PRODUCT_ID"] ?>">&plus;</a>
                    <div class="cart_qty">
                        <?= $products["Jumlah"]?>
                    </div>
                    <a href="decrease_productincart.php?pro=<?= $products["PRODUCT_ID"] ?>">&minus;</a>
                </td>
                <td>
                    <div class="cart_total">
                        <?php $iC = GetCartID($_SESSION['id']); $sum = $products["PRODUCT_PRICE"]*getTotalSomeProductinCart($products["PRODUCT_ID"], $iC[0]["CART_ID"]); $a[] = $sum;?>
                        <?= "Rp " . number_format($sum, 0, ',', '.'); ?>
                    </div>
                </td>
            </tr>
            <?php }; ?>
        </table>
        <div class="OrderCart">
            <div class="price_total_in_cart">
                <h2>Total</h2>
                <?php
                    $total = 0;
                    foreach($a as $num){
                        $total = $total + $num;
                    }
                    echo "Rp " . number_format($total, 0, ',', '.');
                ?>
            </div>
            <div class="order_button_in_cart_outer">
                <a href="order.php">
                    <div>
                        <p>ORDER</p>
                    </div>
                </a>
            </div>
        </div>
        <?php }?>
    </div>

	<?php include("../../assets/inc/footer.inc");?>

</body>
</html>