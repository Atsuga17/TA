<div class="form-field">
    <label for="gambar">Upload Gambar : </label>
    <input type="file" name="gambar" id="gambar">
    <small> <?php if (isset($_FILES['gambar'])) {errMsg($errors, $_FILES, 'gambar');} ?> </small>
</div>
<div class="form-field">
    <label>Nama :</label>
    <input type="text" name="nama" id="nama" value="<?php if (isset($_POST['nama'])) {valinp($_POST, 'nama');} else {if (isset($id)) {echo show('brand', 'name', $id);}} ?>">
    <small> <?php if (isset($_POST['nama'])) {errMsg($errors, $_POST, 'nama');} ?> </small>
</div>