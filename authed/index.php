<?php
require_once "../managers/dbm.php";

if (!isset($_SESSION["user"])) {
    header("location:../auth.php");
}

if (isset($_GET["logout"])) {
    LogoutUser();
}
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #343a40;
            color: #fff;
        }

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
        <div class="user-info">
            <img src="https://via.placeholder.com/80" alt="Profile Picture">
            <?php $userData = GetUserById($_SESSION["user"])
            ?>
            <h5 title="id:<?= $userData["id"] ?> | Account <?= $userData["active"] ? "active" : "disabled" ?> | <?= $userData["email"] ?>">
                <?= $userData["name"] ?>
            </h5>
            <div class="btn-group">
                <a href="?logout=1" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        <a href="."><i class="fas fa-home"></i> Home</a>
        <a href="?p=profile"><i class="fas fa-user"></i> Profile</a>
        <a href="?p=news"><i class="fas fa-newspaper"></i> News</a>
        <a href="?p=messages"><i class="fas fa-message"></i> Messages</a>
        <a href="./yourstore/"><i class="fas fa-store"></i> Your Store</a>
        <hr class="w-75 mt-1 mb-1">
        <a target="_blank" href="../faq.php"><i class="fas fa-question"></i> FAQ</a>
    </div>

    <div class="content">
        <div class="container">
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