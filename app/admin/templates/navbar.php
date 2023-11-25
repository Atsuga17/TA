<?php
    if (isset($_SESSION['user']) or !isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    } else {
        if (isset($_SESSION['admin'])) { ?>
            <div class="">
                <div class="navbar">
                    <div class="leftnavbar">
                        <a href="administrator/index.php" class="logo"><img class="img-logo" src="../../../fahmi/img-logo.jpeg.jpg" alt="logo"></a>
                    </div>
                    <nav class="rightnavbar">
                        <ul>
                            <li><a href="administrator/index.php">Produk</a></li>
                            <li><a href="administrator/manajemen_cust.php">Customer</a></li>
                            <li><a href="administrator/manajemen_brand.php">Brand</a></li>
                            <!--<input type="text" placeholder="Search.."><i class="material-icons">search</i><br>-->
                            <li><a href="admin_account.php">Akun</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } else { ?>
            <div class="">
                <div class="navbar">
                    <div class="leftnavbar">
                        <a href="manager/index.php" class="logo"><img class="img-logo" src="../../../fahmi/img-logo.jpeg.jpg" alt="logo"></a>
                    </div>
                    <nav class="rightnavbar">
                        <ul>
                            <li><a href="manager/index.php">Beranda</a></li>
                            <li><a href="manager/belum_bayar.php">Transaksi Belum Dibayar</a></li>
                            <li><a href="manager/sudah_bayar.php">Transaksi Sudah Dibayar</a></li>
                            <!--<input type="text" placeholder="Search.."><i class="material-icons">search</i><br>-->
                            <li><a href="admin_account.php">Akun</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php }
    }
?>