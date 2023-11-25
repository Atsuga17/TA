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
	<!--FONT AWESOME-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<?php include("../../assets/inc/navbar.inc") ?>
    
    <div class="pesanan_user">
        <h3>Pesanan Saya</h3>
        <div class="pesanan_user_inner">
            <a href="Belum_Bayar.php">
            <div class="icon">
                <img src="../../assets/images/icon/dompet.png">
                <span>Belum Bayar</span>
            </div>
            </a>
            <a href="Telah_Bayar.php">
            <div class="icon">
                <img src="../../assets/images/icon/box.png">
                <span>Dikemas</span>
            </div>
            </a>
            <a href="Kelola_Metode_Pembayaran.php">
            <div class="icon">
                <img src="../../assets/images/icon/card.png">
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
                <img class="profile" src="../../fahmi/profile.jpg">
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