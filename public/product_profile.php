<?php
include_once('../src/inc/nav.php');
?>

<div class="products">
 <?php


sessionCheck();
showProduct($con);


                if ($_SESSION['role'] == 1) {
                    echo "<div class='button-or-edit'>
                    <a class='cart-button' href='../public/edit_product.php?pid=" . htmlspecialchars($_GET['pid']) ."'>Edit Product</a>
                    <a class='cart-button' href='../public/del_product.php?pid=" . htmlspecialchars($_GET['pid']) ."'>Delete Product</a>
                    </div></div>";
                } else {
                    echo "<div class='button-or-edit'>
                    <button class='cart-button' type='submit' name='addcart'>Add to Cart</button>
                    </div></div>";
                }
?>

</div>

<?php
include_once('../src/inc/footer.php');
?>
