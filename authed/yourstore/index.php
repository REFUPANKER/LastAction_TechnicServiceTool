<?php
//TODO: add create store system
require_once "../../managers/dbm.php";

if (!isset($_SESSION["user"])) {
    header("location:../auth.php");
}

if (isset($_GET["logout"])) {
    LogoutUser();
}
$store = GetStoreByUserId($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action | Your Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #212529;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease;
            border-right: 0.1rem #303030 solid;
        }

        .sidebar .user-info {
            text-align: center;
            margin-bottom: 1rem;
        }

        .sidebar .user-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 0.5rem;
        }

        .sidebar .user-info h5 {
            margin-bottom: 0.5rem;
        }

        .sidebar .user-info .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            width: 100%;
        }

        .sidebar .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .sidebar h6 {
            color: #909090;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 0.3vmax;
            display: block;
            width: 100%;
            text-align: left;
            font-size: 1.2rem;
            padding-left: 1rem;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .dropdown-menu {
            background-color: #212529;
            border: none;
        }

        .dropdown-item {
            color: #adb5bd;
        }

        .dropdown-item:hover {
            background-color: #495057;
        }

        .menu-toggle {
            display: none;
            background-color: #212529;
            border: none;
            color: #fff;
            padding: 10px;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1040;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                position: fixed;
                z-index: 1030;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <div class="user-info">
            <img src="https://via.placeholder.com/80" alt="Profile Picture">
            <?php $userData = GetUserById($_SESSION["user"])
            ?>
            <h5 title="id:<?= $userData["id"] ?> | Account <?= $userData["active"] ? "active" : "disabled" ?> | <?= $userData["email"] ?>">
                <?= htmlspecialchars($userData["name"]) ?>
            </h5>
            <div class="btn-group ">
                <a href="../profile/" class="btn btn-secondary btn-sm text-white">
                    <i class="fas fa-cog"></i>
                    <span>Profile</span>
                </a>
                <a href="?logout=1" class="btn btn-danger btn-sm text-white p-2 ">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        <a href="../"><i class="fas fa-dashboard"></i> Dashboard</a>
        <h6 class="m-0 ms-5 w-100">Store</h6>
        <a href="."><i class="fas fa-home"></i> Home</a>
        <h6 class="m-0 ms-5 w-100">Carousel</h6>
        <a href="?p=addcarousel"><i class="fas fa-plus"></i> Add Image</a>
        <a href="?p=removecarousel"><i class="fas fa-trash"></i> Remove Images</a>
        <h6 class="m-0 ms-5 w-100">Configration</h6>
        <a href="?p=actions"><i class="fas fa-play"></i> Actions</a>
        <a href="?p=services"><i class="fas fa-code"></i> Services</a>
    </div>
    <div class="content">
        <div class="container">
            <?php
            if (isset($_GET["p"]) && !str_contains($_GET["p"], "/") && !str_contains($_GET["p"], ".") && file_exists($_GET["p"] . ".php")) {
                include_once($_GET["p"] . ".php");
            } else if (!isset($_GET["p"])) { ?>
                <div class="d-flex flex-column">
                    <?php
                    if (!$store) {
                    ?>
                        <div class='alert alert-warning'>No Store existing.</div>
                        <h1 class="text-center">Create Your Store</h1>
                        <form method="post" enctype="multipart/form-data" class="d-flex flex-column w-100 justify-content-center gap-3 align-items-center">
                            <input maxlength="64" class="w-50 form-control" title="Name (required)" placeholder="Name" name="store_name" required>
                            <textarea maxlength="512" style="resize: none;min-height:15vh;" class="w-50 form-control" title="About (required)" placeholder="About" name="store_about" required></textarea>
                            <label class="w-50 form-control btn btn-outline-secondary text-white" title="Logo" for="store_logo">Upload Logo</label>
                            <input id="store_logo" class="d-none" type="file" placeholder="Logo" name="store_logo" title="select file" accept="image/jpeg, image/png">
                            <button class="w-50 btn btn-success form-control" name="create_store">Create</button>
                        </form>
                    <?php } else { ?>
                        <div class="d-flex align-items-start" style="height: 10rem;">
                            <img src="<?= isset($store['logo']) ? base64_decode($store['logo']) : "https://cdn-icons-png.flaticon.com/512/869/869636.png" ?>" alt="Logo" class="h-100 img-thumbnail" style="aspect-ratio: 1;object-fit: 100% 100%;">
                            <div class="ms-3 d-flex flex-column h-100 justify-content-center">
                                <h5 class="m-0"><?= htmlspecialchars($store['name']) ?></h5>
                                <label><?= htmlspecialchars($store['about']) ?></label>
                                <div class="d-flex w-100 gap-2">
                                    <a onclick="alert(`lastaction/store?t=<?= $store['token'] ?>`);" class="btn btn-primary w-100 mt-2 rounded rounded-3">Share</a>
                                    <a href="../../store?t=<?= $store['token'] ?>" class="btn btn-success mt-2 rounded rounded-3 w-100">Preview</a>
                                </div>
                                <button class="btn btn-dark mt-1">Edit</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else {
                echo "<div class='alert alert-danger'>Page not existing. Redirecting in 3 seconds</div>";
                header("refresh:3;./");
                return;
            }
            ?>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>

</html>