<div class="form-field">
    <label>Email :</label>
    <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) {valinp($_POST, 'email');} else {echo show($table, 'email', $id);} ?>">
    <small> <?php if (isset($_POST['email'])) {errMsg($errors, $_POST, 'email');} ?> </small>
</div>
<div class="form-field">
    <label>Nama Lengkap :</label>
    <input type="text" name="nama" id="nama" value="<?php if (isset($_POST['nama'])) {valinp($_POST, 'nama');} else {echo show($table, 'name', $id);} ?>">
    <small> <?php if (isset($_POST['nama'])) {errMsg($errors, $_POST, 'nama');} ?> </small>
</div>
<div class="form-field">
    <label>Alamat :</label>
    <input type="text" name="alamat" id="alamat" value="<?php if (isset($_POST['alamat'])) {valinp($_POST, 'alamat');} else {echo show($table, 'address', $id);} ?>">
    <small> <?php if (isset($_POST['alamat'])) {errMsg($errors, $_POST, 'alamat');} ?> </small>
</div>
<div class="form-field">
    <label>Nomor Telepon :</label>
    <input type="text" name="telepon" id="telepon" value="<?php if (isset($_POST['telepon'])) {valinp($_POST, 'telepon');} else {echo show($table, 'phone', $id);} ?>">
    <small> <?php if (isset($_POST['telepon'])) {errMsg($errors, $_POST, 'telepon');} ?> </small>
</div>
<div class="form-field">
    <input type="submit" name="submit" value="Edit Profil">
    <a href="user_account.php">Kembali</a>
</div>