<?php
include_once('../src/inc/nav.php');
?>


 <?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1) {
    header('Location: login.php');
    exit;
}

loadUserProfile($con);

?>


<?php
include_once('../src/inc/footer.php');
?>
