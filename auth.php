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
                <div id="loginForm">
                    <h2 class="text-center mb-4">Login</h2>
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="#" id="registerLink" style="color: #007bff;">Register</a></p>
                </div>
                
                <div id="registerForm" style="display: none;">
                    <h2 class="text-center mb-4">Register</h2>
                    <form>
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="registerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="#" id="loginLink" style="color: #28a745;">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#registerLink').click(function(e) {
                e.preventDefault();
                $('#loginForm').hide();
                $('#registerForm').show();
            });

            $('#loginLink').click(function(e) {
                e.preventDefault();
                $('#registerForm').hide();
                $('#loginForm').show();
            });
        });
    </script>
</body>
</html>
