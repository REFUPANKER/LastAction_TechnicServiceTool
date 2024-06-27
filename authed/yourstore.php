<div class="d-flex flex-column">
    <style>
        #selectedImage {
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
    <?php
    $store = GetStoreByUserId($_SESSION["user"]);
    if (!$store) {
        echo "no store";
    } else { ?>
        <div class="d-flex align-items-start" style="height: 10rem;">
            <img src="<?= isset($store['logo']) ? base64_decode($store['logo']) : "https://cdn-icons-png.flaticon.com/512/869/869636.png" ?>" alt="Logo" class="h-100 img-thumbnail" style="aspect-ratio: 1;object-fit: 100% 100%;">
            <div class="ms-3 d-flex flex-column h-100 justify-content-center">
                <h5 class="m-0"><?= $store['name'] ?></h5>
                <label><?= $store['about'] ?></label>
                <label>Owner: <?= $store['owner'] ?></label>
                <div class="d-flex w-100 gap-2">
                    <a onclick="alert(`lastaction/store?t=<?= $store['token'] ?>`);" class="btn btn-primary w-100 mt-2 rounded rounded-3">Share</a>
                    <a href="../store?t=<?= $store['token'] ?>" class="btn btn-success mt-2 rounded rounded-3 w-100">Preview</a>
                </div>
                <button class="btn btn-dark mt-1">Edit</button>
            </div>
        </div>


        <!-- Carousels -->
        <h3 class="mt-2 w-100 text-center">Carousel</h3>
        <?php
        $carousels = GetStoreCarousel($store["id"]);
        $carouselCount = count($carousels);
        $maxCarousels = 5;
        if (isset($_POST["removeCarousel"])) {
            RemoveStoreCarousel($_POST["removeCarousel"]);
        }
        if ($carouselCount > 0) { ?>
            <div class="d-flex flex-wrap w-100 h-50 overflow-auto gap-2 align-items-center m-3" style="max-height: 60vh;">
                <?php foreach ($carousels as $key => $value) { ?>
                    <div class="d-flex flex-column gap-2 w-25 p-2 bg-dark rounded rounded-3">
                        <img class="align-self-center" src="data:image/png;base64,<?= base64_encode($value["image"]) ?>" style="width:100%;aspect-ratio: 2/1;object-fit:100% 100%;">
                        <div class="d-flex flex-column text-break overflow-auto " style="height: 4rem;">
                            <h5 class="m-0"><?= htmlspecialchars($value["title"]) ?></h5>
                            <p><?= htmlspecialchars($value["content"]) ?></p>
                        </div>
                        <form class="w-100" method="post" action=".?p=yourstore">
                            <button name="removeCarousel" value="<?= $value["id"] ?>" class="btn btn-outline-danger w-100">Delete</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        <?php unset($carousels);
        }
        if ($carouselCount < $maxCarousels) { ?>
            <!-- Add Carousel -->
            <div class="w-100 d-flex flex-column align-items-center">
                <h3>Add Carousel Image</h3>
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
                            <p class="w-100 rounded rounded-3 text-center"><i>only <?= $maxCarousels ?> carousel images allowed</i></p>
                        </div>
                        <div id="selectedImage" title="Selected image" style="min-width:30vw;aspect-ratio: 1280/720;border:0.2vmax solid white;background-color: rgba(255,255,255,0.3);border-radius: 0.5vmax;background-image:url('https://via.placeholder.com/1280x720');"></div>
                    </form>

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
                You are reached to carousel limit (<?= $maxCarousels ?>)
            </div>
        <?php } ?>
    <?php } ?>
</div>