<?php
    if (isset($_SESSION['admin'])) { ?>
        <div class="">
            <div class="navbar">
                <div class="leftnavbar">
                    <a href="index.php" class="logo"><img class="img-logo" src="../../../fahmi/img-logo.jpeg.jpg" alt="logo"></a>
                </div>
                <nav class="rightnavbar">
                    <ul>
                        <li><a href="index.php">Produk</a></li>
                        <li><a href="manajemen_cust.php">Customer</a></li>
                        <li><a href="manajemen_brand.php">Brand</a></li>
                        <!--<input type="text" placeholder="Search.."><i class="material-icons">search</i><br>-->
                        <li><a href="../admin_account.php">Akun</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } elseif (isset($_SESSION['manager'])) { ?>
        <div class="">
            <div class="navbar">
                <div class="leftnavbar">
                    <a href="index.php" class="logo"><img class="img-logo" src="../../../fahmi/img-logo.jpeg.jpg" alt="logo"></a>
                </div>
                <nav class="rightnavbar">
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="belum_bayar.php">Transaksi Belum Dibayar</a></li>
                        <li><a href="sudah_bayar.php">Transaksi Sudah Dibayar</a></li>
                        <!--<input type="text" placeholder="Search.."><i class="material-icons">search</i><br>-->
                        <li><a href="../admin_account.php">Akun</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } elseif (isset($_SESSION['user'])) { ?>
        <div class="">
            <?php $brands = getTableData('brand');?>
            <div class="navbar">
                <div class="leftnavbar">
                    <a href="index.php" class="logo"><img class="img-logo" src="../../fahmi/img-logo.jpeg.jpg" alt="logo"></a>
                </div>
                <nav class="rightnavbar">
                    <ul>
                        <li><a href="brand.php">Brands</a>
                            <div class="dropdown-content">
                                <?php foreach($brands as $brand){?>
                                    <a href="index.php?prod=<?= $brand["BRAND_ID"]?>"><?= $brand["BRAND_NAME"];?></a>
                                <?php } ?>
                            </div>
                        </li>
                        <!--<input type="text" placeholder="Search.."><i class="material-icons">search</i><br>-->
                        <li><a href="Keranjang.php">Keranjang</a></li>
                        <li>
                            <a href="user_account.php">Akun</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php }
?>