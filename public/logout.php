

<?php
include('../src/inc/nav.php');
?>
<div class="logoutmsg">

<?php
session_unset();
session_destroy();
echo "getting logged out </div>";
header('Refresh: 1; index.php');
include('../src/inc/footer.php');
exit();


?>

