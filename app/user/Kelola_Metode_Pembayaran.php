<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}
    $alertsuccess="";
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
                        if (empty($error)){
                            // Proceed with the form processing since there are no errors
                            $alertsuccess = "Form submitted successfully!";
                            AddPaymentMethod($_POST["BankName"], $_POST["rekening"], $_SESSION['id']);
                        }
                    }
                    
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
                <div class="bankname_mp">
                    <label for="selectmethod">Pilih Metode :</label>
                    <select name="BankName" id="selectmethod">
                        <!-- <option value="" selected disabled></option> -->
                        <option value="Mandiri">Bank Mandiri</option>
                        <option value="Bank Rakyat Indonesia (BRI)">BRI</option>
                        <option value="Bank Negara Indonesia (BNI)">BNI</option>
                        <option value="Bank Central Asia (BCA)">BCA</option>
                        <option value="Bank Mega">Bank Mega</option>
                        <option value="Bank Mega">DANA</option>
                        <option value="Bank Mega">OVO</option>
                        <option value="Bank Mega">GOJEK</option>
                    </select>
                </div>
                <div class="card_number">
                        <input placeholder="Card Number" type="text" name="rekening"><small><?php echo $error["rekening"] ?? ''?></small>
                </div>
                <input class="submitmetode" type="submit" name="submit" value="Tambah">
            </div>
        </form>
        <div class="alert">
            <?= $alertsuccess ?>
        </div>
        </div>
    </div>
    </div>
    <?php include("../../assets/inc/footer.inc");?>

</body>
</html>