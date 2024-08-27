<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts - SF Pro Display -->
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'SF Pro Display', Arial, sans-serif;
            scroll-behavior: smooth;
        }

        .full-height {
            height: calc(100vh - 56px);
            /* Adjust based on navbar height */
        }

        .bg-opacity {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://9c79aca2.rocketcdn.me/wp-content/uploads/sites/51/2021/06/DS-Blog_Unwanted-software-in-the-company.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
        }

        *::placeholder {
            color: #909090 !important;
        }

        * :not(input):not(textarea):not(button):not(a) {
            user-select: none !important;
            cursor: default !important;
        }

        .rounded-silver {
            border-radius: 15px;
            border: 0.05rem solid #959595;
            padding: 1rem;
            background-color: #080808;
            margin:0.5rem;
        }

        textarea {
            resize: none;
        }

        .navbar-custom {
            background-color: #101010;
        }

        .navbar-custom a,
        .navbar-custom a:focus {
            color: white;
        }

        .navbar-custom a:hover {
            color: silver;
        }

        .btn-custom {
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-radius: 50px;
        }

        .about-us-img {
            max-height: 300px;
        }

        .about-us-text {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .MainTitle {
            background-image: linear-gradient(-45deg, #252525, white, #252525);
            background-clip: text;
            color: transparent;
            font-size: 10vw !important;
        }

        /* Increase App Name Font Size */
        #account h1 {
            font-size: 4rem;
            /* Adjust as needed */
        }

        /* Make Contact Us Section Height Auto */
        #contact-us {
            height: auto;
            padding: 100px 0;
            /* Add some padding for spacing */
        }
    </style>
</head>

<body>
    <!-- Sticky Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Last Action</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#info">Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-us">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- First Part -->
    <div id="account" class="full-height d-flex flex-column justify-content-center align-items-center position-relative text-center">
        <div class="bg-opacity"></div>
        <h1 class="m-0 MainTitle">Last Action</h1>
        <h6 class="m-0 mb-4">the Tech Service and Customer notification software</h6>
        <a href="/auth.php" class="btn btn-outline-light btn-custom">Join Us</a>
    </div>

    <!-- Second Part -->
    <div id="info" class="d-flex justify-content-center align-items-center text-center full-height">
        <div class="container">
            <h2>Create Your Tech Service Store</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="rounded-silver">
                        <h3>Notify Your Customers</h3>
                        <h5>With your store account, you can display action info</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded-silver">
                        <h3>Improve your store</h3>
                        <h5>Your store can get better with feedback via the message dashboard</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded-silver">
                        <h3>Show your products</h3>
                        <h5>Let your customers know what you are selling</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Part -->
    <div id="about-us" class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="https://avatars.githubusercontent.com/u/68808212?v=4" class="border border-3 img-fluid about-us-img rounded rounded-3">
            </div>
            <div class="col-md-8 about-us-text">
                <div>
                    <h2>About Us</h2>
                    <p>We are a tech company that specializes in providing top-notch tech services, from software support to device repairs. Our mission is to empower businesses by creating their own tech service stores with ease.</p>
                    <i>Developed by
                        <a style="color: #53c8e6;" href="https://github.com/REFUPANKER" target="_blank">
                            Refupanker
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </i>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us Part -->
    <div id="contact-us" class="d-flex justify-content-center align-items-center text-center bg-dark">
        <div class="container w-50">
            <h2>Contact Us</h2>
            <form class="mt-4" method="post">
                <div class="mb-3">
                    <input name="email" type="email" class="form-control" placeholder="Your Email" style="background-color: #333; color: #fff;">
                </div>
                <div class="mb-3">
                    <input name="subject" type="text" class="form-control" placeholder="Subject" style="background-color: #333; color: #fff;">
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" style="background-color: #333; color: #fff;"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-light p-3 fs-5 rounded rounded-pill" style="min-width: 25%;">Send</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-3 d-flex align-items-center justify-content-center gap-2">
        <p class="m-0 p-0">&copy; 2024 Last Action</p><a href="auth_admin.php" title="Moderation" class="fa-brands fa-redhat m-0 p-0 text-white text-decoration-none"></a>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>