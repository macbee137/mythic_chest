<?php
include_once('../src/inc/nav.php');
?>
<div class="del-user">
    <div class="del-user-container">
        <h2>Confirm User Deletion</h2>
        <p>Are you sure you want to delete this user?</p>

 </div>
        <form action="" method="POST">
            <div class="del-btns">
                <input type="hidden" name="user_uuid" value="<?php echo htmlspecialchars($_GET['user_uuid']); ?>">
                <button class="del-action-btn" type="submit" name="confirm_delete">Yes, delete user</button>
            <a href="../userlist.php" class="del-action-btn">No, go back</a>
            </div>
    </form>

    
</div>
    <?php
    sessionCheck();
    if (isset($_POST['confirm_delete'])) {
        delUser($con);
    }
    ?>

</div>
<?php
include_once('../src/inc/footer.php');
?>