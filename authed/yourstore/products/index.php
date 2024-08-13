<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action | Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../../../resources/styles/colorics.css" rel="stylesheet">
</head>

<body style="height:100vh;" class="overflow-auto bgc-black text-white d-flex flex-column align-items-center align-content-center justify-content-center ">
    <?php
    require_once("../../../managers/dbm.php");
    if (!isset($_SESSION["user"])) {
        header("location:../../../auth.php");
    }

    $store = GetStoreByUserId($_SESSION["user"]);

    if (!isset($store)) {
        echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
        header("refresh:3;../");
        return;
    }
    ?>
    <a href="../" class="d-flex align-items-center text-white gap-2 fs-2 text-decoration-none" style="cursor:pointer;">
        <i class="fa-solid fa-house"></i>
        Back to LastAction
    </a>
    <h1 style="font-size:5vw;">Products system under the construction</h1>



</body>

</html>