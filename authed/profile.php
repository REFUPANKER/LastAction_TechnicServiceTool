<?php
if (!isset($_SESSION["user"])) {
    header("location:../auth.php");
}
?>
profile