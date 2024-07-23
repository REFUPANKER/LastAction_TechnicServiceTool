<h3 class="mt-2 w-100 text-center">Remove Carousel Image</h3>
<?php

if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}

$carousels = GetStoreCarousel($store["id"]);
$carouselCount = count($carousels);
if (isset($_POST["removeCarousel"])) {
    RemoveStoreCarousel($_POST["removeCarousel"]);
    header("refresh:0;");
}
if ($carouselCount > 0) { ?>
    <div class="d-flex flex-wrap overflow-auto gap-2 m-3" >
        <?php foreach ($carousels as $key => $value) { ?>
            <div class="d-flex flex-column gap-2 w-25 p-2 bg-dark rounded rounded-3">
                <img class="align-self-center" src="data:image/png;base64,<?= base64_encode($value["image"]) ?>" style="width:100%;aspect-ratio: 2/1;object-fit:100% 100%;">
                <div class="d-flex flex-column text-break overflow-auto " style="height: 4rem;">
                    <h5 class="m-0"><?= htmlspecialchars($value["title"]) ?></h5>
                    <p><?= htmlspecialchars($value["content"]) ?></p>
                </div>
                <form class="w-100" method="post">
                    <button name="removeCarousel" value="<?= $value["id"] ?>" class="btn btn-outline-danger w-100">Delete</button>
                </form>
            </div>
        <?php } ?>
    </div>
<?php unset($carousels);
}else{?>
<div class='alert alert-warning'>No carousel images existing.</div>
<?php }