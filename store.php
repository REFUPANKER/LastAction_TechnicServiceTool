<?php
require_once "./managers/dbm.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
    if (isset($_GET["t"])) {
        $store = GetStoreByToken($_GET["t"]);
        if (isset($store)) {
            $owner = GetUserById($store["owner"]);
        } else { ?>
            <div class="alert alert-warning m-3">No store valid for this token,redirecting to home page (3sec)</div>
    <?php
            header("refresh:3;url=./");
            return;
        }
    }
    ?>
    <title><?= $store["name"] ?> | Last Action</title>
    <style>
        .navbar-custom {
            background-color: black;
        }

        .navbar-custom a {
            color: white;
        }

        .footer {
            background-color: black;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .scrollable {
            max-height: 510px;
            overflow-y: auto;
        }

        .carousel-image {
            object-fit: 100% 100%;
            height: 500px;
            width: 100%;
        }

        .custom-carousel-caption {
            background-color: rgba(0, 0, 0, 0.8);
            color: white !important;
            padding: 10px;
            border-radius: 0.4rem;
        }

        .service-container {
            max-height: 60vh;
            overflow-y: auto;
        }

        .service-container img {
            padding: 0.5vw;
            object-fit: contain;
        }

        .home-link img {
            width: 2vw !important;
            aspect-ratio: 1;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            filter: invert(1);
        }
    </style>
</head>

<body style="background-color: #252525;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-custom">
        <div class="container-fluid d-flex justify-content-around align-items-center gap-2">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100 gap-2" id="navbarNav">
                <a href="./" class="nav-link home-link"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946436.png" alt="Home"></a>
                <a class="nav-link" href="#"><?= htmlspecialchars($store["name"]) ?> by <?= htmlspecialchars($owner["name"]) ?></a>
                <div class="btn btn<?= $store["open"] ? "-success" : "-danger" ?>"><?= $store["open"] ? "Open" : "Closed" ?></div>
            </div>
            <div class="collapse w-100 navbar-collapse justify-content-md-around" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#lastActions">Last Actions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./faq.php">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="collapse w-100 navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./auth.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Image Carousel -->
    <?php
    $carousel = GetStoreCarousel($store["id"]);
    if (count($carousel) <= 0) { ?>
        <div class="w-100 d-flex justify-content-center align-items-center">
            <div class="alert alert-warning w-50 mt-3">Carousel not existing</div>
        </div>
    <?php } else { ?>
        <div class="d-flex justify-content-center my-5">
            <div id="carouselExampleControls" class="carousel slide w-75" data-bs-ride="carousel">
                <div class="carousel-inner rounded rounded-3">
                    <?php
                    foreach ($carousel as $key => $value) { ?>
                        <div class="carousel-item <?= $key == 0 ? "active" : "" ?>">
                            <img src="<?= isset($value['image']) ? "data:image/png;base64," . base64_encode($value['image']) : "https://cdn-icons-png.flaticon.com/512/869/869636.png" ?>" class="carousel-image">
                            <div class="carousel-caption custom-carousel-caption">
                                <h5 class="carousel-caption-title"><?= htmlspecialchars($value["title"]) ?></h5>
                                <p class="carousel-caption-text"><?= htmlspecialchars($value["content"]) ?></p>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="filter: invert(1);">
                    <span class="carousel-control-prev-icon carousel-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="filter: invert(1);">
                    <span class="carousel-control-next-icon carousel-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    <?php } ?>

    <!-- Last Actions -->
    <div class="container my-5" id="lastActions">
        <h2 class="text-center mb-4">Last Actions</h2>
        <div class="scrollable">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-2">
                        <img src="https://via.placeholder.com/150" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h5 class="card-title">Title 3</h5>
                            <p class="card-text">Action 3</p>
                            <p class="card-text"><small class="text-muted">Time 3</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </div>


    <!-- Services -->
    <div class="container my-5" id="services">
        <h2 class="text-center mb-4">Services</h2>
        <div class="row row-cols-1 row-cols-md-5 g-3 service-container">
            <div class="col">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/3067/3067451.png" class="card-img-top img-fluid" alt="Service 1">
                    <div class="card-body">
                        <h5 class="card-title">Service Title 1</h5>
                        <p class="card-text">Service Description 1</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img class="h-100" src="https://img.freepik.com/free-photo/laptop-spectacle-yellow-coffee-mug-diary-table-with-black-textured-wall_23-2147956645.jpg?t=st=1718714544~exp=1718718144~hmac=fb5f12c4a1fe84df834c592440ad9ce109bd7570c1b7193c7e0199a419dd2881&w=1380" class="card-img-top img-fluid" alt="Service 2">
                    <div class="card-body">
                        <h5 class="card-title">Service Title 2</h5>
                        <p class="card-text">Service Description 2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us -->
    <div class="container my-5" id="about">
        <h2 class="text-center">About Us</h2>
        <div class="row">
            <div class="col-md-2">
                <img src="<?= isset($store['logo']) ? "data:image/png;base64," . base64_encode($store['logo']) : "https://cdn-icons-png.flaticon.com/512/869/869636.png" ?>" class="img-fluid rounded rounded-3" style="width:20vw;aspect-ratio: 1;" alt="...">
            </div>
            <div class="col-md-10 d-flex flex-column">
                <h4><?= htmlspecialchars($store["name"]) ?></h4>
                <p class="h-100"><?= htmlspecialchars($store["about"]) ?></p>
                <h6 title="Year/Month/Day">Created at <?= htmlspecialchars(date("Y/m/d", strtotime($store["creation"]))) ?></h6>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h5 class="text-center" id="contactform">Contact Us</h5>
                    <!-- //TODO:add contact us mail system -->
                    <?php
                    if (isset($_POST["contact"])) {
                        SendMessage($_POST["contact_email"], $store["owner"], $_POST["contact_subject"], $_POST["contact_message"]);
                        $_SESSION["last_contactMessageSent"] = time(); ?>
                        <div class="alert alert-success">Message sent (refreshing page...)</div>
                    <?php header("refresh:2");
                    }
                    $maxContactTime = 5 * 60;
                    if (isset($_SESSION["last_contactMessageSent"]) && ($contactSent = time() - $_SESSION["last_contactMessageSent"]) < $maxContactTime) { ?>
                        <div class="alert alert-warning">Message already received from this device
                            (available in <?= floor($maxContactTime / 60 - $contactSent / 60) ?> mins <?= 60 - floor($contactSent % 60) ?> seconds)</div>
                    <?php } else { ?>
                        <form method="post" action="#contactform">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="contact_email" type="text" maxlength="64" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input minlength="3" maxlength="128" name="contact_subject" type="text" class="form-control" id="subject" placeholder="Enter the subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="contact_message" maxlength="512" class="form-control" id="message" rows="3" placeholder="Enter your message" style="resize: none;" required></textarea>
                            </div>
                            <button name="contact" type="submit" class="btn btn-dark d-block mx-auto">Send</button>
                        </form>
                    <?php }

                    ?>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-6 text-center">
                    <span>&copy; 2024 Last Action</span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>