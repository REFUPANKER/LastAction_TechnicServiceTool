<?php
require_once "../managers/dbm.php";

if (!isset($_SESSION["user"])) {
    header("location:../auth.php");
    exit;
}

if (isset($_GET["logout"])) {
    LogoutUser();
}

$userData = GetUserById($_SESSION["user"]);

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action | User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../resources/styles/colorics.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #151515;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .sidebar .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            width: 100%;
            text-align: left;
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
        <h3 class="w-100 text-center">Your Account</h3>
        <div class="d-flex flex-column w-75 gap-1">
            <div class="d-flex gap-1">
                <img
                    src="https://via.placeholder.com/80"
                    class="rounded rounded-3"
                    alt="Profile Picture"
                    title="id:<?= $userData["id"] ?>">
                <div class="d-flex flex-column justify-content-between">
                    <h5><?= htmlspecialchars($userData["name"]) ?></h5>
                    <h5 class="btn btn-<?= $userData["active"] ? "success" : "danger" ?> m-0"><?= $userData["active"] ? "Active" : "Disabled" ?></h5>
                </div>
            </div>
            <a href="?logout=1" class="btn btn-danger text-white p-2 ">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
        <a href="."><i class="fas fa-home"></i> Home</a>
        <a href="?p=profile"><i class="fas fa-user"></i> Profile</a>
        <a href="?p=news"><i class="fas fa-newspaper"></i> News</a>
        <a href="?p=messages"><i class="fas fa-message"></i> Messages</a>
        <a href="./yourstore/"><i class="fas fa-store"></i> Your Store</a>

        <label style="color:#adb5bd;">Quick Access</label>
        <a href="./yourstore/?p=addcustomer"><i class="fas fa-users"></i> Add Customer</a>
        <a href="./yourstore/products/" target="_blank"><i class="fas fa-cubes"></i> Products</a>

        <hr class="w-75 mt-1 mb-1">
        <a target="_blank" href="../faq.php"><i class="fas fa-question"></i> FAQ</a>
    </div>

    <div class="content">
        <div>
            <?php
            if (isset($_GET["p"]) && !str_contains($_GET["p"], "/") && !str_contains($_GET["p"], ".") && file_exists($_GET["p"] . ".php")) {
                include_once($_GET["p"] . ".php");
            } else { ?>
                <h1>Wellcome <?= $userData["name"] ?> !</h1>
                <p style="white-space: pre-line;">This is your account dashboard.
                    You can customize your profile as you wish</p>
                <?php
                $storeLink = StorePreviewLink();

                if (isset($storeLink)) { ?>
                    <a target="_blank" href="../store.php?t=<?= $storeLink["token"] ?>" class="btn btn-success mt-2 rounded rounded-3 w-100">You have active store profile | Preview |</a>
                    <div class="d-flex flex-column w-100 pt-3">
                        <h4>Analytics for your store</h4>
                        use chart.js
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning rounded rounded-3 p-2 w-100">You dont have active store profile</div>
                    <a href="./yourstore/" class="btn fs-5 btn-success p-3"><i class="fas fa-store"></i> Create Store Account </a>
            <?php }
            } ?>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>

</html>