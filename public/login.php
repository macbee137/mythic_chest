<?php
include('../src/inc/nav.php');
?>
<div class="login">
    <h1>Login</h1>
<div class="formular">
    <form action="" method="POST">
        <label for="username">Username oder email</label>
        <br>
        <input type="text" id="login" name="login" placeholder="username or email" required>
        <br>
        <label for="password">password</label>
        <br>
        <input type="password" id="password" name="pw" placeholder="password" required>
        <div class="form-btn-box">
        <button class="form-button" type="submit" name="loginbtn">Login</button>
        <a class="form-button" href="signup.php">Sign Up</a>
    </div>
</div>
    </form>

</div>

<?php
if (isset($_POST['loginbtn'])) {
    include('../src/inc/func.php');
    login($con);
}
?>

<?php
include("../src/inc/footer.php")
?>

