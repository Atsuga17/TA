<?php
    require("../../base.php");
    require("../../database.php");
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: ../index.php");
        exit();
    }
    $custs = getTableData('user');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
        <title>Admin - Customer</title>
    </head>
    <body>
        <?php require '../../../assets/inc/navbar.inc'; ?>
        <div class="content">
            <h1>DAFTAR CUSTOMER</h1>
            <?php if (count($custs) > 0) { ?>
                <div class="card-container">
                    <?php foreach ($custs as $cust) : ?>
                        <div class="card">
                            <div class="cardImg" style="background-image:url(../../../assets/images/default.jpeg); background-size:cover;background-position:center;">
                            </div>
                            <div class="cardInfo">
                                <?= "Usename : ".$cust["USER_ID"] ?>
                            </div>
                            <div class="cardInfo">
                                <?= "Nama : ".ucwords($cust["USER_NAME"]) ?>
                            </div>
                            <div class="cardInfo">
                                <?= "Email : ".ucwords($cust["USER_EMAIL"]) ?>
                            </div>
                            <div class="cardInfo">
                                <?= "No. Tlp : ".ucwords($cust["USER_PHONE"]) ?>
                            </div>
                            <div class="cardInfo">
                                <?= "Alamat : ".ucwords($cust["USER_ADDRESS"]) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else {
                echo "<h2>Tidak ada customer yang dapat ditampilkan</h1>";
            } ?>
        </div>
        <?php require '../../../assets/inc/footer.inc'; ?>
    </body>
</html>