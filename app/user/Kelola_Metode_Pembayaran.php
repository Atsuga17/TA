<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    require('../base.php');
    require("../database.php");
    $payment = showUserPaymentData($_SESSION['id']);
?>
                <?php
                    $pattern = array(
                        'rekening' => "/^([0-9]{10,20})+$/",
                        'CVV' => "/^([0-9]{3,3})+$/",
                        'exp' => "/^(0[1-9]|1[0-2])\/(\d{2})$/"
                    );
                    
                    function MPpregMatch($value, $pattern) {
                        return preg_match($pattern, $value);
                    }
                    
                    if (isset($_POST['submit'])) {
                        $error = array();
                        // var_dump($error);
                        foreach ($_POST as $name => $value) {
                            if (!isset($_POST[$name]) || $_POST[$name] === "") {
                                $error[$name] = "Mohon Diisi Terlebih Dahulu";
                            } else {
                                if (isset($pattern[$name])) {
                                    if (MPpregMatch($value, $pattern[$name])) {
                                        // Valid input
                                    } else {
                                        // Invalid input
                                        if ($name === 'rekening') {
                                            $error[$name] = "Format salah (harus numerik)";
                                        } else if ($name === 'exp') {
                                            $error[$name] = "Format salah (harus MM/YY)";
                                        } else if ($name === 'CVV') {
                                            $error[$name] = "Format salah (hanya numerik)";
                                        }
                                    }
                                }
                            }
                        }
                    
                        // Check if there are errors
                        if (!empty($error)) {
                            // Handle errors here (display or log)
                             // For example, printing errors for demonstration
                        } else {
                            // Proceed with the form processing since there are no errors
                            // Perform further actions or redirection here
                            echo "Form submitted successfully!";
                        }
                    }
                    
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
	<?php include("../../assets/inc/navbar.inc");?>
    <div id="container_mp">
    <?php if (count($payment) > 0){?>
        <div class="metodepembayaran">
        <h1>Metode Pembayaran yang di simpan : </h1>
            <?php foreach($payment as $pay){?>
                <div class="img_mp"></div>
                <div class="ket_mp"><?= $pay["BANK_NAME"]?> : <?= $pay["NOMOR_REKENING"]?></div>
                <a href="#"></a>
            <?php }?>
        </div>
    <?php } else{?>
        <div class="metodepembayaran">
        <h1>Belum Ada Metode Pembayaran</h1>
        </div>
    <?php }?>

    <div class="tambahkan_mp_outer">
    <div class="garis_mp"></div>
        <div class="tambahkan_mp_inner">
        <h3>Tambahkan Metode Pembayaran :</h3>
            <form action="Kelola_Metode_Pembayaran.php" method="post">
            <div class="kelola_mp">
                <div class="card_number">
                    <div class="inputinkmp">
                        <input placeholder="Card Number" type="text" name="rekening"><small><?php echo $error["rekening"] ?? ''?></small>
                    </div>
                </div>
                <div class="card_detail">
                    <div class="inputinkmp_exp">
                        <input placeholder="Expiration (MM/YY)" type="text" name="exp"><small><?php echo $error["exp"] ?? ''?></small>
                    </div>
                    <div class="inputinkmp_cvv">
                        <input placeholder="CVV" type="text" name="CVV"><small><?php echo $error["CVV"] ?? ''?></small>
                    </div>
                </div>
                <div class="card_name">
                    <div class="inputinkmp_name">
                        <input placeholder="Name On Card" type="text" name="nama"><small><?php echo $error["nama"] ?? ''?></small>
                    </div>
                </div>
                <input class="inputinkmp" type="submit" name="submit" value="Tambahkan">
        </div>
        </form>
    </div>
    </div>
    </div>
    <?php include("../../assets/inc/footer.inc");?>

</body>
</html>