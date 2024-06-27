<?php
if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}
?>
<style>
    #selectedImage {
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>

<h3 class="mt-2 w-100 text-center">Add Carousel Image</h3>
<?php
$carouselCount = GetStoreCarouselCount($store["id"])["count"];
$maxCarousels = 5;
if ($carouselCount < $maxCarousels) { ?>
    <!-- Add Carousel -->
    <div class="w-100 d-flex flex-column align-items-center">
        <?php
        $canAddCarousel = true;
        $sizeLimit = 5;
        if ($canAddCarousel && isset($_POST["addcarousel"]) && isset($_FILES["carousel_image"])) {
            $file = $_FILES["carousel_image"];
            $allowedTypes = array("image/jpeg", "image/png");
            $addCarouselMSG;
            $carouselMsgType;
            if (!in_array($file["type"], $allowedTypes)) {
                $addCarouselMSG = "only JPEG and PNG allowed";
                $carouselMsgType = "warning";
            } else {
                $maxFileSize = $sizeLimit * 1024 * 1024;
                if ($file["size"] > $maxFileSize) {
                    $addCarouselMSG = "file size over the limit <i>" . $sizeLimit . "mb</i>";
                    $carouselMsgType = "danger";
                    unset($_FILES["carousel_image"]);
                } else {
                    AddStoreCarousel($store["id"], $file["tmp_name"], $_POST["carousel_title"], $_POST["carousel_content"]);
                    $canAddCarousel = false;
                    $addCarouselMSG = "Carousel image added (refreshing page in 2 sec)";
                    $carouselMsgType = "success";
                }
            }
        }
        if (isset($addCarouselMSG)) { ?>
            <div class="w-50 alert alert-<?= $carouselMsgType ?>"><?= $addCarouselMSG ?></div>
        <?php }
        if ($canAddCarousel) { ?>
            <form method="post" enctype="multipart/form-data" class="d-flex carouselblock align-items-center justify-content-center gap-3 w-100">
                <div class="d-flex flex-column">
                    <label tabindex="1" for="pfpslct" class="w-100 m-1 btn btn-dark ">Select Image</label>
                    <input required id="pfpslct" onchange="onProfileImageSelected()" class="d-none w-100" type="file" name="carousel_image" title="select file" accept="image/jpeg, image/png">
                    <input tabindex="2" title="Title (required)" placeholder="Title" class="form-control m-1" name="carousel_title" required>
                    <input tabindex="3" title="Content (required)" placeholder="Content" class="form-control m-1" name="carousel_content" required>
                    <button tabindex="4" class="m-1 w-100 p-1 btn btn-dark" type="submit" name="addcarousel" value="1">Add</button>
                    <p class="w-100 rounded rounded-3 m-1 text-center"><i>size limit : <?= $sizeLimit . "mb" ?></i></p>
                </div>
                <div id="selectedImage" title="Selected image" style="min-width:30vw;aspect-ratio: 1280/720;border:0.2vmax solid white;background-color: rgba(255,255,255,0.3);border-radius: 0.5vmax;background-image:url('https://via.placeholder.com/1280x720');"></div>
            </form>
            <p class="w-100 rounded rounded-3 text-center"><i>only <?= $maxCarousels ?> carousel images allowed (current <?= $carouselCount . "/" . $maxCarousels ?> )</i></p>
            <script>
                function onProfileImageSelected() {
                    var pfpfile = document.getElementById("pfpslct");
                    var pfpimg = document.getElementById("selectedImage");
                    if (pfpfile.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            pfpimg.style.backgroundImage = "url('" + e.target.result + "')";
                        }
                        reader.readAsDataURL(pfpfile.files[0]);
                    }
                }
            </script>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">
        You are reached to carousel image limit (<?= $maxCarousels ?>)
    </div>
<?php } ?>