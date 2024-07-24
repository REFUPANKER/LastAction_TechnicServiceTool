<?php
require_once("../../../managers/dbm.php");
if (!isset($_SESSION["user"])) {
    header("location:../../auth.php");
}

if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;../");
    return;
}
?>
products