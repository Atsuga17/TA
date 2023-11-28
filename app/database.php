<?php
	//register user/administrator/manager
	function add($post) {
		if ($post['kunci'] == 'Admin_99') {
			$table = 'admin';
		} elseif ($post['kunci'] == 'Manager_99') {
			$table = 'manager';
		} else {
			$table = 'user';
		}
		$key = strtoupper($table);
		try {
			$statement = DB->prepare("INSERT IGNORE INTO $table (".$key."_ID, ".$key."_EMAIL, ".$key."_NAME, ".$key."_PHONE,".$key."_ADDRESS,".$key."_PASSWORD, ".$key."_PASS) VALUES (:id, :em, :name,:ph,:add, SHA2(:pass, 0), SHA2(:ky, 0))");
			$statement->bindValue(':id', htmlspecialchars($post['id']));
			$statement->bindValue(':em', $post['email']);
			$statement->bindValue(':name', htmlspecialchars($post['nama']));
			$statement->bindValue(':ph', $post['telepon']);
			$statement->bindValue(':add', htmlspecialchars($post['alamat']));
			$statement->bindValue(':pass', $post['password']);
			$statement->bindValue(':ky', $post['kunci']);
			$statement->execute();
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	//edit profil user/administrator/manager
	function edit(&$errors, $table, $post, $id) {
		try {
			$statement = DB->prepare("UPDATE $table SET ".strtoupper($table)."_EMAIL = :em, ".strtoupper($table)."_NAME = :name, ".strtoupper($table)."_ADDRESS = :add, ".strtoupper($table)."_PHONE = :ph WHERE ".strtoupper($table)."_ID = '$id'");
			$statement->bindValue(':em', $post['email']);
			$statement->bindValue(':name', htmlspecialchars($post['nama']));
			$statement->bindValue(':ph', $post['telepon']);
			$statement->bindValue(':add', htmlspecialchars($post['alamat']));
			$statement->execute();
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	//ambil data spesifik dari suatu tabel berdasarkan id
	function getData($data, $table, $id) {
		try{
			$statement = DB->prepare("SELECT $data FROM $table where ".strtoupper($table)."_ID = :id");
			$statement->bindValue(':id',$id);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $err){
			echo $err->getMessage();
		}
	}

	//ambil seluruh data yang ada dalam suatu baris tabel berdasarkan id
	function getAllData($table, $id) {
		try{
			$statement = DB->prepare("SELECT * FROM $table where ".strtoupper($table)."_ID = :id");
			$statement->bindValue(':id',$id);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $err){
			echo $err->getMessage();
		}
	}


	//ambil seluruh data dari suatu tabel
	function getTableData($table) {
		try{
			$statement = DB->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $err){
			echo $err->getMessage();
		}
	}

	//cek email/username dalam database agar tidak terjadi duplikasi pada email/username
	function db_check($field_list, $field_name) {
		if ($field_list['kunci'] == 'Admin_99') {
			$table = 'admin';
		} elseif ($field_list['kunci'] == 'Manager_99') {
			$table = 'manager';
		} else {
			$table = 'user';
		}
		$statement = DB->prepare("SELECT ".strtoupper($table)."_".strtoupper($field_name)." FROM $table");
		$statement->execute();
		foreach ($statement as $row) {
			if ($field_list[$field_name] == $row[strtoupper($table)."_".strtoupper($field_name)]) {
				return false;
			}
		}
		return true;
    }

    //cek ketersediaan email saat edit profil
    function specCheck($data ,$table, $name, $id) {
    	$key = strtoupper($table)."_".strtoupper($name);
    	$stm = DB->prepare("SELECT $key FROM $table");
    	$stm->execute();
    	foreach ($stm as $row) {
    		if ($data != show($table, $name, $id) and $data == $row[$key]) {
    			return false;
    		}
    	}
    	return true;
    }

    //ambil id terakhir yang ditambahkan
    function getLastInsertedId($table) {
	    try {
	        $sql = "SELECT * FROM $table ORDER BY ".strtoupper($table)."_ID DESC LIMIT 1";
	        $stm = DB->prepare($sql);
	        $stm->execute();
	        if ($stm->rowCount() > 0) {
	            $result = $stm->fetch();
	            return $result[strtoupper($table)."_ID"];
	        } else {
	            if ($table == 'brand') {
	                return 'B0000';
	            } elseif ($table == 'product') {
	                return 'P0000';
	            }
	        }
	    } catch (PDOException $err) {
	        echo $err->getMessage();
	    }
	}

	//generate id varchar baru
	function autoGenId($lastId) {
	    $str = substr($lastId, 0, 1);
	    $num = substr($lastId, 1, 4);
	    $newNum = str_repeat("0", 4 - strlen(strval(intval($num) + 1))).strval(intval($num) + 1);
	    return $str.$newNum;
	}

	//tambah brand baru
	function addBrand($post) {
	    try {
	        $lastBrandId = getLastInsertedId('brand');
	        $newBrandId = autoGenId($lastBrandId);
	        $statement = DB->prepare("INSERT IGNORE INTO brand (BRAND_ID, BRAND_NAME) VALUES (:id, :name)");
	        $statement->bindValue(':id', $newBrandId);
	        $statement->bindValue(':name', htmlspecialchars($post['nama']));
	        $statement->execute();
	    } catch (PDOException $err) {
	        echo $err->getMessage();
	    }
	}

	//edit detail brand berdasarkan id
	function editBrand($post) {
		try {
			$id = $post[0]['id'];
	        $statement = DB->prepare("UPDATE brand SET BRAND_NAME = :name WHERE BRAND_ID = '$id'");
	        $statement->bindValue(':name', htmlspecialchars($post[0]['nama']));
	        $statement->execute();
	    } catch (PDOException $err) {
	        echo $err->getMessage();
	    }	
	}

	//tambah produk baru
	function addProduct($post) {
		try {
			$img = $post[1]['gambar']['name'];
			$tmp = $post[1]['gambar']['tmp_name'];
			$dir = "../../../assets/images/products/";
			$new = $img;
			move_uploaded_file($tmp, $dir . $new);
	        $lastProdId = getLastInsertedId('product');
	        $newProdId = autoGenId($lastProdId);
	        $statement = DB->prepare("INSERT IGNORE INTO product (PRODUCT_ID, BRAND_ID, PRODUCT_NAME, PRODUCT_IMG, PRODUCT_STOCK, PRODUCT_PRICE, PRODUCT_DESC) VALUES (:id, :brand, :name, :img, :stock, :price, :desc )");
	        $statement->bindValue(':id', $newProdId);
	        $statement->bindValue(':brand', $post[0]['brand']);
	        $statement->bindValue(':name', htmlspecialchars($post[0]['nama']));
	        $statement->bindValue(':img', $new);
	        $statement->bindValue(':stock', $post[0]['stock']);
	        $statement->bindValue(':price', $post[0]['harga']);
	        $statement->bindValue(':desc', $post[0]['deskripsi']);
	        $statement->execute();
	    } catch (PDOException $err) {
	        echo $err->getMessage();
	    }
	}

	//edit detail produk berdasarkan id
	function editProduct($post) {
		try {
			$id = $post[0]['id'];
			if (!empty($post[1]['gambar']['name'])) {
				$img = $post[1]['gambar']['name'];
				$tmp = $post[1]['gambar']['tmp_name'];
				$dir = "../../../assets/images/products/";
				$new = $img;
				move_uploaded_file($tmp, $dir . $new);
			} else {
				$new = $post[0]['old'];
			}
	        $statement = DB->prepare("UPDATE product SET BRAND_ID = :brand, PRODUCT_NAME = :name, PRODUCT_IMG = :img, PRODUCT_STOCK = :stock, PRODUCT_PRICE = :price, PRODUCT_DESC = :desk WHERE PRODUCT_ID = '$id'");
	        $statement->bindValue(':brand', $post[0]['brand']);
	        $statement->bindValue(':name', htmlspecialchars($post[0]['nama']));
	        $statement->bindValue(':img', $new);
	        $statement->bindValue(':stock', $post[0]['stock']);
	        $statement->bindValue(':price', $post[0]['harga']);
	        $statement->bindValue(':desk', $post[0]['deskripsi']);
	        $statement->execute();
	    } catch (PDOException $err) {
	        echo $err->getMessage();
	    }
	}

	//hapus baris tertentu pada tabel berdasarkan id
	function delete($kode, $table) {
		try {
			$statement = DB->prepare("DELETE FROM $table WHERE ".strtoupper($table)."_ID = :id");
			$statement->bindValue(':id', $kode);
			$statement->execute();
		} catch (PDOException $err) {
			echo "Hapus data gagal";
			echo $err->getMessage();
		}
	}

	//mencocokkan password dan username saat login
    function check($field_list) {
    	if ($field_list['kunci'] == 'Admin_99') {
    		$table = 'admin';
    	} elseif ($field_list['kunci'] == 'Manager_99') {
    		$table = 'manager';
    	} else {
    		$table = 'user';
    	}
    	$key = strtoupper($table);
    	try {
    		$stm = DB->prepare("SELECT * FROM $table WHERE ".$key."_ID = :uname and ".$key."_PASSWORD = SHA2(:pw, 0) and ".$key."_PASS = SHA2(:pass, 0)");
			$stm->bindValue(':uname', $field_list['id']);
			$stm->bindValue(':pw', $field_list['password']);
			$stm->bindValue(':pass', $field_list['kunci']);
			$stm->execute();
			return $stm->rowCount() > 0;
	    } catch(PDOException $err) {
	    	echo $err->getMessage();
		}
    }

    //menampilkan data kolom spesifik dari suatu baris tabel berdasarkan id
    function show($table, $name, $id) {
    	try {
    		$stm = DB->query("SELECT ".strtoupper($table)."_".strtoupper($name)." FROM $table WHERE ".strtoupper($table)."_ID = '$id'");
	    	$db = $stm->fetchAll(PDO::FETCH_ASSOC);
	    	return $db[0][strtoupper($table)."_".strtoupper($name)];
	    } catch(PDOException $err) {
	    	echo $err->getMessage();
		}
    }

    //validasi password saat edit profil
    function edit_check($field_list,  $table, $id) {
    	try {
    		$stm = DB->prepare("SELECT * FROM $table WHERE ".strtoupper($table)."_ID = :id and ".strtoupper($table)."_PASSWORD = SHA2(:pass, 0)");
    		$stm->bindValue(':id', "'$id'");
			$stm->bindValue(':pass', $field_list['old']);
			$stm->execute();
			return $stm->rowCount() > 0;
    	} catch (PDOException $err) {
	    	echo $err->getMessage();
		}
    }
	//ambil list brand
	function getBrands(){
		try{
			$statement = DB->prepare("SELECT * FROM brand");
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $err) {
            echo $err->getMessage();
        }
	}

    //ambil seluruh data produk dengan detail brand
	function getProductwithBrands(){
        try {
            $statement =DB->prepare("SELECT * FROM product JOIN brand ON brand.BRAND_ID = product.BRAND_ID");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
	
	//ambil 2 data dari tabel berbeda
	function getTwoTable($table1, $table2){
        try {
            $statement = DB->prepare("SELECT * FROM `$table1` JOIN `$table2` ON ".$table2.".".strtoupper($table2)."_ID = ".$table1.".".strtoupper($table2)."_ID");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
	}

	//ambil data order sesuai status pembayaran
	function getSpecOrderDetail($table1, $table2, $con){
        try {
            $statement = DB->prepare("SELECT * FROM `$table1` JOIN `$table2` ON ".$table2.".".strtoupper($table2)."_ID = ".$table1.".".strtoupper($table2)."_ID WHERE PAYMENT_STATUS = $con");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
	}

	//filter data sesuai range tanggal order
	function getSpecDateOrderDetail($table1, $table2, $con, $start, $end){
        try {
            $statement = DB->prepare("SELECT * FROM `$table1` JOIN `$table2` ON ".$table2.".".strtoupper($table2)."_ID = ".$table1.".".strtoupper($table2)."_ID WHERE PAYMENT_STATUS = $con AND (ORDER_TIME BETWEEN '$start' AND '$end')");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
	}


    //filter produk produk dari brand tertentu berdasae id brand
    function getBrandProduct($id){
        try {
            $statement =DB->prepare("SELECT * FROM product JOIN brand ON brand.BRAND_ID = product.BRAND_ID WHERE product.BRAND_ID = :id");
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    //end


	function GetCartID($User){
		try{
			$statement = DB->prepare("SELECT CART_ID FROM cart WHERE USER_ID = :user");
			$statement->bindValue(":user",$User);
			$statement->execute();
			// var_dump ($statement->fetchAll(PDO::FETCH_ASSOC));
			if ($statement->rowCount()<1){
				$statement = DB->prepare("INSERT INTO cart(USER_ID) VALUES(:user)");
				$statement->bindValue(":user",$User);
				$statement->execute();
				$statement = DB->prepare("SELECT CART_ID FROM cart WHERE USER_ID = :user");
				$statement->bindValue(":user",$User);
				$statement->execute();
				return $statement->fetchAll(PDO::FETCH_ASSOC);
			}else{
				return $statement->fetchAll(PDO::FETCH_ASSOC);
			}
		} catch (PDOException $err) {
			echo $err->getMessage();
		}

	}

	function getTotalSomeProductinCart($productid, $cartid){
		try{
			$statement = DB->prepare("SELECT * FROM cart_detail WHERE CART_ID = :cID AND PRODUCT_ID = :pID");
			$statement->bindValue(":pID",$productid);
			$statement->bindValue(":cID",$cartid);
			$statement->execute();
			$statement->fetchAll(PDO::FETCH_ASSOC);
			$count = $statement->rowCount();
			return $count;
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	function insertCart($user,$iP)
	{
		try {
			$iC = GetCartID($user);
			// var_dump($iC);
			$st = DB->prepare("UPDATE product SET PRODUCT_STOCK = PRODUCT_STOCK-1 WHERE PRODUCT_ID = :id");
			$st->bindValue(':id', $iP);
			$st->execute();
			
			$statement = DB->prepare("INSERT INTO cart_detail(PRODUCT_ID, CART_ID) VALUES(:idProduk, :idCart)");
			// $statement->bindValue(':idDetail', $iD);
			$statement->bindValue(':idProduk', $iP);
			$statement->bindValue(':idCart', $iC[0]["CART_ID"]);
			$statement->execute();

			$previousPage = $_SERVER['HTTP_REFERER'];
			header("Location: $previousPage");
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	function getCartDetail($user){
		try {
			$statement = DB->prepare("SELECT cd.CART_DETAIL_ID, p.PRODUCT_ID, PRODUCT_NAME, PRODUCT_STOCK, PRODUCT_PRICE, p.PRODUCT_IMG,count(*) as Jumlah 
			FROM cart_detail cd JOIN product p ON cd.PRODUCT_ID = p.PRODUCT_ID JOIN cart c ON c.CART_ID = cd.CART_ID WHERE USER_ID = :user GROUP BY PRODUCT_ID");
			$statement->bindValue(':user', $user);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}
	
	function min_productincart($productid){
		try{
			$st = DB->prepare("UPDATE product SET PRODUCT_STOCK = PRODUCT_STOCK+1 WHERE PRODUCT_ID = :id");
			$st->bindValue(':id', $productid);
			$st->execute();
			
			$statement = DB->prepare("DELETE FROM cart_detail WHERE PRODUCT_ID = :pro LIMIT 1");
			$statement->bindValue(":pro",$productid);
			$statement->execute();

			$previousPage = $_SERVER['HTTP_REFERER'];
			header("Location: $previousPage");
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}
	function plus_productincart($iC,$iP){
		try{
			$st = DB->prepare("UPDATE product SET PRODUCT_STOCK = PRODUCT_STOCK-1 WHERE PRODUCT_ID = :id");
			$st->bindValue(':id', $iP);
			$st->execute();

			$statement = DB->prepare("INSERT INTO cart_detail(PRODUCT_ID, CART_ID) VALUES(:idProduk, :idCart)");
			// $statement->bindValue(':idDetail', $iD);
			$statement->bindValue(':idProduk', $iP);
			$statement->bindValue(':idCart', $iC);
			$statement->execute();

			$previousPage = $_SERVER['HTTP_REFERER'];
			header("Location: $previousPage");
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	function Pesan($user){
		try{ 
			$a = [];
			$products = getCartDetail($user);
			$total = 0;
			foreach($products as $product){
				$iC = GetCartID($_SESSION['id']); $sum = $product["PRODUCT_PRICE"]*getTotalSomeProductinCart($product["PRODUCT_ID"], $iC[0]["CART_ID"]); $a[] = $sum;
			}
			foreach($a as $num){
				$total = $total + $num;
			}

			$status = 0;
			$statement = DB->prepare("INSERT INTO `order` (USER_ID,TOTAL,PAYMENT_STATUS)
			VALUES (:user, :total,:paystatus)");
			$statement->bindValue(":user", $user);
			$statement->bindValue(":total", $total);
			// $statement->bindValue(":otime", NULL);
			$statement->bindValue(":paystatus", $status);
			$statement->execute();
			
			// $GetOrderID = DB->prepare("SELECT * FROM `order` WHERE USER_ID = :user");
			// $GetOrderID->bindValue(":user", $user);
			// $GetOrderID->execute();
			// $GetOrderID->fetch(PDO::FETCH_ASSOC);
			$cart_id=DB->LastInsertId();
			
			foreach($products as $product){
				$a = $product["PRODUCT_ID"];
				$b = $product["Jumlah"];
				$order_detail = DB->prepare("INSERT INTO order_detail(ORDER_ID,PRODUCT_ID,QTY)
				VALUES (:orderid, :proid, :qty)");
				$order_detail->bindValue(":orderid",$cart_id);
				$order_detail->bindValue(":proid",$a);
				$order_detail->bindValue(":qty",$b);
				$order_detail->execute();
			}

			$c = GetCartID($user);
			var_dump($c);

			$cD_Del = DB->prepare("DELETE FROM cart_detail WHERE CART_ID = :CARTID");
			$cD_Del->bindValue(":CARTID",$c[0]["CART_ID"]);
			$cD_Del->execute();

			$cart = DB->prepare("DELETE FROM cart WHERE USER_ID = :user");
			$cart->bindValue(":user", $user);
			$cart->execute();

			header("location:" . BASEURL . "/app/user/Belum_Bayar.php");
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}

	function getOrderList($user){
		try{
			$statement = DB->prepare("SELECT * FROM `order` WHERE USER_ID = :user");
			$statement->bindValue(":user",$user);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $err) {
			echo $err->getMessage();
		}
	}
	function removeOrder($id){
		try{
			$statement = DB->prepare("SELECT * FROM order_detail WHERE ORDER_ID = :id");
			$statement->bindValue(":id",$id);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			var_dump($result);
			foreach($result as $s){ 
				$st = DB->prepare("UPDATE product SET PRODUCT_STOCK = PRODUCT_STOCK+:stk WHERE PRODUCT_ID = :id");
				$st->bindValue(':id', $s["PRODUCT_ID"]);
				$st->bindValue(':stk',$s["QTY"]);
				$st->execute();
			}
			$statement = DB->prepare("DELETE FROM order_detail WHERE ORDER_ID = :id");
			$statement->bindValue(":id",$id);
			$statement->execute();

			$st = DB->prepare("DELETE FROM `order` WHERE ORDER_ID = :id");
			$st->bindValue(":id",$id);
			$st->execute();
			$previousPage = $_SERVER['HTTP_REFERER'];
			header("Location: $previousPage");
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}

	function getOrderDetailData($id){
		try {
			$statement = DB->prepare("SELECT * FROM order_detail WHERE ORDER_ID = :orderid");
			$statement->bindValue(":orderid",$id);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
	function removeOrder_detail($id){
		try{
			$statement = DB->prepare("SELECT * FROM order_detail WHERE ORDER_DETAIL_ID = :id");
			$statement->bindValue(":id",$id);
			$statement->execute();
			$s = $statement->fetch(PDO::FETCH_ASSOC);

			$st = DB->prepare("UPDATE product SET PRODUCT_STOCK = PRODUCT_STOCK+:stk WHERE PRODUCT_ID = :id");
			$st->bindValue(':id', $s["PRODUCT_ID"]);
			$st->bindValue(':stk',$s["QTY"]);
			$st->execute();

			$statement = DB->prepare("DELETE FROM order_detail WHERE ORDER_DETAIL_ID = :id");
			$statement->bindValue(":id",$id);
			$statement->execute();
			$previousPage = $_SERVER['HTTP_REFERER'];
			header("Location: $previousPage");
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}


	// --------------------------------------CHECKOUT-----------------------------------------------
	function checkout($id){
		$order_detail = getOrderDetailData($id);
		$products = getProductfromID($order_detail["PRODUCT_ID"]);
	}


	//---------------------------------------BELUM DIBAYAR - SUDAH DIBAYAR -----------------------------------

	function verifikasiorder($id){
		try{
			$statement = DB->prepare("UPDATE `order` SET PAYMENT_STATUS = 1 WHERE ORDER_ID = :id");
			$statement->bindValue(":id",$id);
			$statement->execute();
			header("Location: Telah_Bayar.php");
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
	function BayarOrder($user,$bank,$rek,$orderid){
		try{
			$statement = DB->prepare("INSERT INTO payment_method (USER_ID,BANK_NAME,NOMOR_REKENING) 
			VALUES (:user,:bank,:rek)");
			$statement->bindValue(':user',$user);
			$statement->bindValue(':bank',$bank);
			$statement->bindValue(':rek',$rek);
			$statement->execute();

			verifikasiorder($orderid);
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
	function showUserPaymentData($ID){
		try{
			$statement = DB->prepare("SELECT * FROM payment_method WHERE USER_ID = :id");
			$statement->bindValue(":id",$ID);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
	function getPaymentData($ID){
		try{
			$statement = DB->prepare("SELECT * FROM payment_method WHERE USER_ID = :id");
			$statement->bindValue(":id",$ID);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}catch (PDOException $err) {
            echo $err->getMessage();
        }
	}
?>