<?php
include_once("../../managers/innerPageChecker.php");

if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    exit;
}
$getacts = GetActions($store["id"]);
?>

<div class="d-flex flex-column">
    <h4 class="text-center">Displaying Last Actions that also shown in your store page</h4>
    <?php
    if (!isset($getacts) || count($getacts) <= 0) {
    ?>
        <div class="alert alert-warning">No actions existing</div>
    <?php
    } else { ?>
        <div class="mt-1 border border-2 rounded rounded-3 overflow-auto d-flex flex-wrap gap-2 p-1" style="max-height:83vh;">
            <?php
            foreach ($getacts as $key => $value) {
            ?>
                <div title="ID : <?= $value["id"] ?>" class="d-flex flex-row align-items-center" >
                    <img src="<?= $statusImages[$value["status"] - 1] ?>" style="height: 5rem;aspect-ratio: 1;" class="rounded p-2">
                    <div class="m-2 d-flex flex-column">
                        <h5 class="m-0">Number : <?= $value["id"] ?></h5>
                        <p class="m-0">Status : <?= $status[$value["status"] - 1] ?></p>
                        <p class="m-0">Last Action : <?= $value["lastUpdate"] ?></p>
                    </div>
                </div>
        <?php }
        } ?>
        </div>
        <div class="d-flex align-items-center gap-1 alert p-1 mt-1 alert-warning"><i class="fa-solid fa-triangle-exclamation"></i> Listing 10 actions by latest update date </div>
</div>
