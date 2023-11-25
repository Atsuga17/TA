<?php
require_once("../base.php");
require_once(BASEPATH . "/app/database.php");
$orders = getOrderDetailData($_GET['p']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="order_body">
    <?php include("../../assets/inc/navbar.inc") ?>
    <div class="order_detail">
        <table>
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
            <?php foreach($orders as $order){ $products = getProductfromID($order["PRODUCT_ID"]);?>
            <tr class="row_order_detail">
                <td>
                    <div class="img_order_detail">
                        <div class="img_icon_order_detail">
                            <img src="<?= BASEURL; ?>/assets/images/products/<?= $products["PRODUCT_IMG"]; ?>">
                        </div>
                        <div class="namapro_order_detail">
                            <?= $products["PRODUCT_NAME"]?>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="price_order_detail">
                        <?= $products["PRODUCT_PRICE"]?>
                    </div>
                </td>
                <td>
                    <div class="qty_order_detail">
                        <?= $order["QTY"]?>
                    </div>
                </td>
                <td>
                    <div class="total_order_detail">
                        <?php $sum = $products["PRODUCT_PRICE"]*$order["QTY"]?>
                        <?= "Rp " . number_format($sum, 0, ',', '.'); ?>
                    </div>
                </td>
                <td class="del_order"><a class="x_order" href="removeOrder_detail.php?id=<?= $order["ORDER_DETAIL_ID"] ?>">&#x292c;</a></td>
            </tr>
            <?php }; ?>
        </table>
    </div>

    <?php include("../../assets/inc/footer.inc");?>
</body>
</html>