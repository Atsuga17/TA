<div class="form-field">
	<label for="gambar">Upload Gambar : </label>
	<input type="file" name="gambar" id="gambar">
    <small> <?php if (isset($_FILES['gambar'])) {errMsg($errors, $_FILES, 'gambar');} ?> </small>
</div>
<div class="form-field">
    <label for="brand">Nama Brand :  </label>
    <select name="brand" id="brand">
        <option value="">Pilih Brand</option>
        <?php foreach ($brands as $brand) {
            echo '<option value="' . $brand["BRAND_ID"].'"' . (isset($products) ? ($brand["BRAND_ID"] == $products[0]["BRAND_ID"] ? 'selected' : '') : ''). '>' . $brand["BRAND_NAME"] . '</option>';
        } ?>
    </select>
    <small> <?php if (isset($_POST['brand'])) {errMsg($errors, $_POST, 'brand');} ?> </small>
</div>
<div class="form-field">
	<label for="name">Nama Produk : </label>
	<input type="text" name="nama" id="nama" value="<?php if (isset($_POST['nama'])) {valinp($_POST, 'nama');} else {if (isset($id)) {echo show('product', 'name', $id);}} ?>">
    <small> <?php if (isset($_POST['nama'])) {errMsg($errors, $_POST, 'nama');} ?> </small>
</div>
<div class="form-field">
	<label for="stock"> Stock : </label>
	<input type="text" name="stock" id="stock" value="<?php if (isset($_POST['stock'])) {valinp($_POST, 'stock');} else {if (isset($id)) {echo show('product', 'stock', $id);}} ?>">
    <small> <?php if (isset($_POST['stock'])) {errMsg($errors, $_POST, 'stock');} ?> </small>
</div>
<div class="form-field">
	<label for="harga">Harga : </label>
	<input type="text" name="harga" id="harga" value="<?php if (isset($_POST['harga'])) {valinp($_POST, 'harga');} else {if (isset($id)) {echo show('product', 'price', $id);}} ?>">
    <small> <?php if (isset($_POST['harga'])) {errMsg($errors, $_POST, 'harga');} ?> </small>
</div>
<div class="form-field">
	<label for="deskripsi"> Keterangan : </label>
	<input type="text" name="deskripsi" id="deskripsi" value="<?php if (isset($_POST['deskripsi'])) {valinp($_POST, 'deskripsi');} else {if (isset($id)) {echo show('product', 'desc', $id);}} ?>">
    <small> <?php if (isset($_POST['deskripsi'])) {errMsg($errors, $_POST, 'deskripsi');} ?> </small>
</div>