<?php
    session_start();
    if (isset($_SESSION['user']) or !isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }
    require_once('../base.php');
    require_once("../database.php");
    $products = getProductwithBrands();
    if (isset($_SESSION['admin'])) {
        $table = 'admin';
    } else {
        $table = 'manager';
    }
    $a = getAllData($table, $_SESSION["id"]);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Center</title> 
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
    <body>
        <?php require 'templates/navbar.php';?>
        <div class="user_account_container">
            <div class="user_content">
                <img class="profile" src="../../fahmi/profile.jpg" alt="profil">
                <p>Nama : <?php echo $a[0][strtoupper($table)."_NAME"];?></p>
                <p>Email : <?php echo $a[0][strtoupper($table)."_EMAIL"];?> </p>
                <p>Password : ****** </p>
                <a href="edit_admin.php">Edit Profil</a>
                <a href="logout.php">Keluar</a>
            </div>
        </div>
        <?php require '../../assets/inc/footer.inc'; ?>
    </body>
</html>