<?php
include_once('../src/inc/nav.php');
?>

<div class="edit-user">
 <?php

sessionCheck();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 1) {
    die("Unauthorized access.");
} else {
    editProducts($con);
}


?>

</div>
<?php
include_once('../src/inc/footer.php');
?>
