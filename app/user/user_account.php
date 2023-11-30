<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $products = getProductwithBrands();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
	<?php include("../../assets/inc/navbar.inc") ?>
    
    <div class="pesanan_user">
        <h3>Pesanan Saya</h3>
        <div class="pesanan_user_inner">
            <a href="Belum_Bayar.php">
            <div class="icon">
                <img src="../../assets/images/icon/dompet.png" alt="Gambar belum termuat">
                <span>Belum Bayar</span>
            </div>
            </a>
            <a href="Telah_Bayar.php">
            <div class="icon">
                <img src="../../assets/images/icon/box.png " alt="Gambar belum termuat">
                <span>Dikemas</span>
            </div>
            </a>
            <a href="Kelola_Metode_Pembayaran.php">
            <div class="icon">
                <img src="../../assets/images/icon/card.png" alt="Gambar belum termuat">
                <span>Kelola Metode Pembayaran</span>
            </div>
            </a>
        </div>
    </div>
    <div class="user_account_container">
            <!--<div class="user_menu">
                <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                </ul>
            </div> -->
            <?php $a = getAllData('user', $_SESSION["id"]);?>
            <div class="user_content">
                <img class="profile" src="../../fahmi/profile.jpg" alt="Gambar belum termuat">
                <p>Nama : <?php echo $a[0]["USER_NAME"];?></p>
                <p>Email : <?php echo $a[0]["USER_EMAIL"];?> </p>
                <p>Alamat : <?php echo $a[0]["USER_ADDRESS"];?> </p>
                <p>Nomor Telepon : <?php echo $a[0]["USER_PHONE"];?> </p>
                <p>Password : ****** </p>
                <a href="edit.php">Edit Profil</a>
                <a href="logout.php">Keluar</a>
            </div>
        </div>
        <?php include("../../assets/inc/footer.inc");?>
    </body>
</html>