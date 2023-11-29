<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $listpesanan = getOrderList($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOYStore</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="BB_body">
	<?php include("../../assets/inc/navbar.inc") ?>

	<div class="table_order">
    <?php foreach($listpesanan as $order){ if ($order["PAYMENT_STATUS"] == 0){?>
		<table class="container">
			<tr>
				<th>Status Pembayaran</th>
				<th>Tanggal Pemesanan</th>
				<th>Total Harga</th>
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
					<?= $order["ORDER_TIME"] ?>
					</div>
				</td>
				<td>
					<div class="total">
					<?= $order["TOTAL"] ?>
					</div>
				</td>
				<td>
					<a href="order_detail.php?p=<?= $order["ORDER_ID"] ?>">
						Detail
					</a>
				</td>
				<td>
					<a href="Checkout.php?id=<?= $order["ORDER_ID"]?>">
						Konfirmasi Pembayaran
					</a>
				</td>
				<td class="del_order"><a class="x_order" href="removeOrder.php?id=<?= $order["ORDER_ID"] ?>">&#x292c;</a></td>
			</tr>
		</table>
		<?php }else{}?>
	<?php } ?>
	</div>
	

	<?php include("../../assets/inc/footer.inc");?>

</body>
</html>