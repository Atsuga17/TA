<?php
    if (isset($_SESSION['admin'])) { ?>
        <div class="admin-sidebar">
            <a href="index.php">Produk</a><br>
            <a href="manajemen_cust.php">Customer</a><br>
            <a href="manajemen_brand.php">Brand</a><br>
            <a href="../admin_account.php">Profil</a><br>
        </div>
    <?php } else { ?>
        <div class="admin-sidebar">
            <a href="index.php">Semua Transaksi</a><br>
            <a href="belum_bayar.php">Transaksi Belum Dibayar</a><br>
            <a href="sudah_bayar.php">Transaksi Sudah Dibayar</a><br>
            <a href="../admin_account.php">Profil</a><br>
        </div>
    <?php }
?>