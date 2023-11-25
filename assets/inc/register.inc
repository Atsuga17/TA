<div class="form-field">
    <label>Username :</label>
    <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) {valinp($_POST, 'username');} ?>">
    <small> <?php if (isset($_POST['username'])) {errMsg($errors, $_POST, 'username');} ?> </small>
</div>
<div class="form-field">
    <label>Email :</label>
    <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) {valinp($_POST, 'email');} ?>">
    <small> <?php if (isset($_POST['email'])) {errMsg($errors, $_POST, 'email');} ?> </small>
</div>
<div class="form-field">
    <label>Nama Lengkap :</label>
    <input type="text" name="nama" id="nama" value="<?php if (isset($_POST['nama'])) {valinp($_POST, 'nama');} ?>">
    <small> <?php if (isset($_POST['nama'])) {errMsg($errors, $_POST, 'nama');} ?> </small>
</div>
<div class="form-field">
    <label>No. Telepon :</label>
    <input type="text" name="telepon" id="telepon" value="<?php if (isset($_POST['telepon'])) {valinp($_POST, 'telepon');} ?>">
    <small> <?php if (isset($_POST['telepon'])) {errMsg($errors, $_POST, 'telepon');} ?> </small>
</div>
<div class="form-field">
    <label>Alamat :</label>
    <input type="text" name="alamat" id="alamat" value="<?php if (isset($_POST['alamat'])) {valinp($_POST, 'alamat');} ?>">
    <small> <?php if (isset($_POST['alamat'])) {errMsg($errors, $_POST, 'alamat');} ?> </small>
</div>
<div class="form-field">
    <label>Password :</label>
    <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) {valinp($_POST, 'password');} ?>">
    <small> <?php if (isset($_POST['password'])) {errMsg($errors, $_POST, 'password');} ?> </small>
</div>
<div class="form-field">
    <label>Konfirmasi Password :</label>
    <input type="password" name="password2" id="password2" value="<?php if (isset($_POST['password2'])) {valinp($_POST, 'password2');} ?>">
    <small> <?php if (isset($_POST['password2'])) {errMsg($errors, $_POST, 'password2');} ?> </small>
</div>
<div class="form-field">
    <label>Kunci :</label>
    <input type="password" name="kunci" id="kunci" value="<?php if (isset($_POST['kunci'])) {valinp($_POST, 'kunci');} ?>">
    <small> <?php if (isset($_POST['kunci'])) {errMsg($errors, $_POST, 'kunci');} ?> </small>
</div>
<div class="form-field">
    <input type="submit" name="submit" value="Register">
    Sudah memiliki akun ? <a href="index.php">Login</a>
</div>