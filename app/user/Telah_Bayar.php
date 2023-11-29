<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $listpesanan = getOrderandPayment($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="BB_body">
	<?php include("../../assets/inc/navbar.inc"); if (count($listpesanan)>0){?>

	<div class="table_order">
    <?php foreach($listpesanan as $order){ if ($order["PAYMENT_STATUS"] == 1){?>
		<table class="container">
			<tr>
				<th>Status Pembayaran</th>
				<th>Tanggal Pemesanan</th>
				<th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>No. Rekening</th>
				<th></th>
			</tr>
			<tr>
				<td>
					<div class="payment_status">
						<?php if ($order["PAYMENT_STATUS"] == 1){
							echo "Telah Dibayar";
						}else{
							echo "Belum Dibayar";
						} ?>
					</div>
				</td>
				<td>
					<div class="order-time">
					<?= $order["ORDER_TIME"]; ?>
					</div>
				</td>
				<td>
					<div class="total">
					<?= $order["TOTAL"]; ?>
					</div>
				</td>
                <td>
                    <div class="metode_TB">
                        <?= $order["BANK_NAME"];?>
                    </div>
                </td>
                <td>
                    <div class="norek_TB">
                        <?= $order["NOMOR_REKENING"];?>
                    </div>
                </td>
				<td>
					<a href="order_detail_telahdibayar.php?p=<?= $order["ORDER_ID"]; ?>">
						Detail
					</a>
				</td>
				<td class="del_order"><a class="x_order" href="removeOrder.php?id=<?= $order["ORDER_ID"]; ?>">&#x292c;</a></td>
			</tr>
		</table>
		<?php }?>
	<?php }} ?>
	</div>

	<?php include("../../assets/inc/footer.inc");?>

</body>
</html>