<div class="login-picture"">
</div>
<div class="login">
    <div class="form-field">
        <label>Username :</label>
        <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) {valinp($_POST, 'username');} ?>">
        <small> <?php if (isset($_POST['username'])) {errMsg($errors, $_POST, 'username');} ?> </small>
    </div>
    <div class="form-field">
        <label>Password :</label>
        <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) {valinp($_POST, 'password');} ?>">
        <small> <?php if (isset($_POST['password'])) {errMsg($errors, $_POST, 'password');} ?> </small>
    </div>
    <div class="form-field">
        <input type="submit" name="submit" value="Login">
        Belum memiliki akun ? <a href="register.php">Register</a>
    </div>
</div>
