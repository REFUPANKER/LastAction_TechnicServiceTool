<?php
require_once "./managers/dbm.php";

if (isset($_SESSION["user"])) {
    header("location:./authed/");
    return;
}


?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action - Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #343a40;
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 5rem;
        }

        .home-link {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            text-decoration: none;
            filter: invert(1);
        }

        .home-link img {
            width: 32px;
            height: 32px;
        }

        .form-control {
            background-color: #495057;
            color: white;
        }
    </style>
</head>

<body>
    <a href="./" class="home-link"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946436.png" alt="Home"></a>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                $alertMessage = "";
                $alertType = "";
                if (!isset($_SESSION["user"]) && isset($_POST["t"])) {
                    switch ($_POST["t"]) {
                        case 'login':
                            if (!UserExistsByEmail($_POST["email"])) {
                                $alertMessage = "no user existing with this email";
                                $alertType = "warning";
                                unset($_POST["email"]);
                                break;
                            }
                            $tryToGet = GetUserByEmailPassword($_POST["email"], $_POST["password"]);
                            if (!$tryToGet) {
                                $alertMessage = "password not matching";
                                $alertType = "danger";
                                unset($_POST["password"]);
                                break;
                            } else {
                                LoginUser($_POST["email"], $_POST["password"]);
                                $alertMessage = "Successfully logged in (redirecting in 3 sec)";
                                $alertType = "success";
                                header("refresh:3;url=./authed/");
                            }
                            break;
                        case 'register':
                            if (str_contains($_POST["name"], "‎")) { //remove empty char : ‎
                                $alertMessage = "name must be valid";
                                $alertType = "danger";
                                unset($_POST["name"]);
                                break;
                            }
                            if (UserExistsByEmail($_POST["email"])) {
                                $alertMessage = "email already in use";
                                $alertType = "warning";
                                unset($_POST["email"]);
                                break;
                            }
                            RegisterUser($_POST["name"], $_POST["email"], $_POST["password"]);
                            $alertMessage = "Successfully registered (redirecting in 3 sec)";
                            $alertType = "success";
                            header("refresh:3;url=./authed/");
                            break;
                    }
                ?>
                    <div class="alert alert-<?= $alertType ?>">
                        <?= $alertMessage ?>
                    </div>
                <?php
                }
                if (isset($_GET["t"]) && $_GET["t"] == "register") { ?>
                    <div id="registerForm">
                        <h2 class="text-center mb-4">Register</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="registerName" class="form-label">Full Name</label>
                                <input <?= isset($_POST["name"]) ? "value=" . $_POST["name"] : "" ?> minlength="3" maxlength="64" name="name" type="text" class="form-control" id="registerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email Address</label>
                                <input <?= isset($_POST["email"]) ? "value=" . $_POST["email"] : "" ?> maxlength="64" name="email" type="email" class="form-control" id="registerEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input <?= isset($_POST["password"]) ? "value=" . $_POST["password"] : "" ?> minlength="6" maxlength="64" name="password" type="password" class="form-control" id="registerPassword" required>
                            </div>
                            <button name="t" value="register" type="submit" class="btn btn-success btn-block">Register</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="?t=login" id="loginLink" style="color: #28a745;">Login</a></p>
                    </div>
                <?php } else { ?>
                    <div id="loginForm">
                        <h2 class="text-center mb-4">Login</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email Address</label>
                                <input <?= isset($_POST["email"]) ? "value=" . $_POST["email"] : "" ?> maxlength="64" name="email" type="email" class="form-control" id="loginEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input <?= isset($_POST["password"]) ? "value=" . $_POST["password"] : "" ?> maxlength="64" name="password" type="password" class="form-control" id="loginPassword" required>
                            </div>
                            <button name="t" value="login" type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <p class="text-center mt-3">Don't have an account? <a href="?t=register" id="registerLink" style="color: #007bff;">Register</a></p>
                    </div>
                <?php }
                ?>

            </div>
        </div>
    </div>
</body>

</html>