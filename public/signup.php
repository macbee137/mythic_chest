<?php
include('../src/inc/nav.php')
?>

<div class="signup">
    <h1>Sign Up</h1>
<div class="formular">
    <form action="" method="POST">
        <label for="username">username</label>
        <br>
        <input type="text" id="username" name="username" placeholder="username" required>
        <br>
        <label for="vorname">name</label>
        <br>
        <input type="text" id="firstname" name="firstname" placeholder="name" required>
        <br>
        <label for="nachname">familyname</label>
        <br>
        <input type="text" id="lastname" name="lastname" placeholder="familyname" required>
        <br>
        <label for="email">e-mail</label>
        <br>
        <input type="email" id="email" name="email" placeholder="du@email.com" required>
        <br>
        <label for="password">password</label>
        <br>
        <input type="password" id="password" name="password" placeholder="password">
        <br>
        <label for="pwconfirm">confirm password</label>
        <br>
        <input type="password" id="pwconfirm" name="pwconfirm" placeholder="confirm password">
        <br>
        <label for="gender">gender</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Divers">Divers</option>
        </select>
        <br>
        <label for="birthday">birthday</label>
        <br>
        <input type="date" id="birthday" name="birthday">
        <br>
        <label for="street">street</label>
        <br>
        <input type="text" id="street" name="street" placeholder="du@email.com">
        <br>
        <label for="postcode">postcode</label>
        <br>
        <input type="text" id="postcode" name="postcode" placeholder="du@email.com">
        <br>
        <label for="country">country</label>
        <br>
        <input type="text" id="country" name="country" placeholder="du@email.com">
        <br>
        <div class="form-btn-box">
        <button class="form-button" type="submit" name="signbtn">SignUp</button>
</div>
</div>
</div>
<?php
if (isset($_POST['signbtn'])) {
    include('../src/inc/func.php');
    signUp($con);
}

include('../src/inc/footer.php');
?>
