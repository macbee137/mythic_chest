<?php
include_once('../src/inc/nav.php');
?>

<div class="products">
 <?php

sessionCheck();
listProducts($con);

?>

</div>
<?php
include_once('../src/inc/footer.php');
?>
