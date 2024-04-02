<?php
include_once('../src/inc/nav.php');
?>

<div class="edit-user">
 <?php

sessionCheck();
editUser($con);

?>

</div>
<?php
include_once('../src/inc/footer.php');
?>
