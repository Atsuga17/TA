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
    <input type="submit" name="submit" value="Edit Profil">
    <?php
        if ($table == 'admin') {
            $back = 'administrator';
        } else {
            $back = 'manager';
        }
    ?>
    <a href="admin_account.php">Batal</a>
</div>