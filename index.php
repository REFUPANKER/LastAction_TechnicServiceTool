<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    </style>
</head>

<body style="background-color: #252525;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-custom">
        <div class="container-fluid d-flex justify-content-around align-items-center">
            <a class="navbar-brand" href="#">Last Action</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
            <div class="collapse navbar-collapse justify-content-md-around" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./auth.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Image Carousel -->
    <div class="d-flex justify-content-center my-5">
        <div id="carouselExampleControls" class="carousel slide w-75" data-bs-ride="carousel">
            <div class="carousel-inner rounded rounded-3">
                <div class="carousel-item active">
                    <img src="https://img.freepik.com/free-photo/computer-screens-running-programming-code-empty-software-developing-agency-office-computers-parsing-data-algorithms-background-neural-network-servers-cloud-computing-data-room_482257-33353.jpg?t=st=1718452673~exp=1718456273~hmac=5d61ef97b3d2ae75cdf8e080689f37fb15fee9e0d9035bec4774ca0932d730b2&w=740" class="carousel-image" alt="Software support">
                    <div class="carousel-caption custom-carousel-caption">
                        <h5 class="carousel-caption-title">Software Support</h5>
                        <p class="carousel-caption-text">Live support & app development</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/7639373/pexels-photo-7639373.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="carousel-image" alt="Technical Support">
                    <div class="carousel-caption custom-carousel-caption">
                        <h5 class="carousel-caption-title">Technical Support</h5>
                        <p class="carousel-caption-text">We are fixing your devices</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://img.freepik.com/free-vector/software-installation-contract-adjustment-agreement-terms-regulation-program-fix-coworkers-holding-gears-cartoon-character-application-bugs_335657-2095.jpg" class="carousel-image" alt="Customize Your Store">
                    <div class="carousel-caption custom-carousel-caption">
                        <h5 class="carousel-caption-title">Customize your own store</h5>
                        <p class="carousel-caption-text">Join us and create your store account</p>
                    </div>
                </div>
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
        <h2>About Us</h2>
        <div class="row">
            <div class="col-md-2">
                <img src="https://via.placeholder.com/100" class="img-fluid" alt="...">
            </div>
            <div class="col-md-10">
                <p>Description about the store or website.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h5 class="text-center">Contact Us</h5>
                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter the subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter your message" style="resize: none;" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark d-block mx-auto">Send</button>
                    </form>
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