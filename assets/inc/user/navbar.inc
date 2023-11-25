    <div class="">
        <?php $brands = getBrands();?>
        <div class="navbar">
            <div class="leftnavbar">
                <a href="index.php" class="logo"><img class="img-logo" src="../../fahmi/img-logo.jpeg.jpg"></a>
            </div>
            <nav class="rightnavbar">
                <ul>
                    <li><a href="/">Brands</a>
                        <div class="dropdown-content">
                            <?php foreach($brands as $brand){?>
                                <a href="#"><?= $brand["BRAND_NAME"];?></a>
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
    <div class="banner"></div>