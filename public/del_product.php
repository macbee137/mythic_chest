<?php
include_once('../src/inc/nav.php');
?>
<div class="del-user">
    <div class="del-user-container">
        <h2>Confirm Product Deletion</h2>
        <p>Are you sure you want to delete this product?</p>

 </div>
        <form action="" method="POST">
            <div class="del-btns">
                <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_GET['pid']) ?>">
                <div class="del-btns">
                <button class="del-action-btn" type="submit" name="confirm_delete">Yes, delete</button>
            <a href="../product_profile.php?pid=<?php echo htmlspecialchars($_GET['pid']) ?>" class="del-action-btn">No, go back</a>
            </div></div>
    </form>

    
</div>
    <?php
    sessionCheck();
    if (isset($_POST['confirm_delete'])) {
        delProduct($con);
    }
    ?>

</div>
<?php
include_once('../src/inc/footer.php');
?>