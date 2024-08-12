<?php
if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}

if (isset($_GET["rmsrv"])) {
    RemoveStoreService($store["id"], $_GET["rmsrv"]);
}



$servs = GetStoreServices($store["id"]);
$servlimit = 10;

if (isset($_POST["AddStore"]) && count($servs) < $servlimit) {
    AddStoreService($store["id"], $_POST["ServiceName"], $_POST["ServiceDescription"]);
    $servs = GetStoreServices($store["id"]);
    Toastify("Service added successfully");
}

?>
<style>
    .tab button {
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        background-color: transparent;
    }

    .tab button.active {
        background-color: var(--bs-gray-dark);
    }

    .tab button i {
        margin-right: 0.3rem;
    }

    .tab :nth-child(1) {
        border-top-left-radius: 0.4rem;
    }

    .tab :last-child {
        border-top-right-radius: 0.4rem;
    }

    .tab button:hover {
        background-color: #5f6b6e;
    }

    .tab button:active {
        background-color: #252525;
    }

    .tabcontent {
        display: none;
        padding: 1rem;
        border-top: none;
        background-color: var(--bs-gray-dark);
        border-bottom-left-radius: 0.4rem;
        border-bottom-right-radius: 0.4rem;
        flex-direction: column;
        max-height: 85vh;
        overflow: auto;
    }

    textarea {
        resize: none;
    }
</style>

<div class="w-100">
    <div class="overflow-hidden tab">
        <button id="tab1" onclick="openTab(event, 'Display')"><i class="fa-solid fa-bars-staggered"></i>Display</button>
        <button id="tab2" onclick="openTab(event, 'Add')"><i class="fas fa-plus"></i>Add</button>
    </div>

    <div id="Display" class="tabcontent">
        <h3>Listing services <?= "(" . count($servs) . "/" . $servlimit . ")" ?></h3>
        <div class="overflow-auto border border-black p-3 rounded-3">
            <?php

            if (count($servs) <= 0) { ?>
                <div class="m-1 alert alert-warning ">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                    No services existing
                </div>
                <?php
            } else {
                foreach ($servs as $key => $value) { ?>
                    <div class="d-flex align-items-center m-1 rounded rounded-3 " style="height:6vw;">
                        <img src="<?= isset($value["image"]) ? $value["image"] : "https://cdn-icons-png.flaticon.com/512/780/780528.png" ?>" class="rounded rounded-3 overflow-hidden p-2" style="width:6vw;aspect-ratio: 1;">
                        <div class="d-flex flex-column w-100 overflow-auto">
                            <h5> <?= $value["name"] ?></h5>
                            <h6 class="text-break"><?= $value["descr"] ?></h6>
                        </div>
                        <a title="remove" href="?p=services&rmsrv=<?= $value["id"] ?>" style="aspect-ratio: 1;" class="btn btn-outline-danger d-flex align-items-center "><i class="fas fa-trash"></i></a>
                    </div>
                    <?php if ($key + 1 != count($servs)) echo "<hr></hr>";
                    ?>
            <?php }
            } ?>
        </div>
    </div>

    <div id="Add" class="tabcontent">
        <?php
        if (count($servs) < $servlimit) {
        ?>
            <form method="post" class="d-flex flex-column gap-2">
                <h3>Add Service</h3>
                Name
                <input class="form-control" maxlength="64" name="ServiceName" required>
                Description
                <textarea class="form-control" maxlength="512" name="ServiceDescription" required></textarea>
                <button name="AddStore" value="1" class="btn btn-success">Add</button>
            </form>
        <?php
        } else {
            Toastify("You reached to service count limit (" . $servlimit . ")", "var(--bs-primary)");
        ?>
            <div class="alert alert-warning">
                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                You can only add <?= $servlimit ?> Services
            </div>
        <?php } ?>

    </div>
</div>

<script>
    let preTabEvt;

    function openTab(evt, tabname) {
        if (preTabEvt != null) {
            preTabEvt.className = preTabEvt.className.replace(" active", "");
        }
        preTabEvt = evt.currentTarget;
        preTabEvt.className += " active";

        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabname).style.display = "flex";
    }
    document.getElementById("tab1").click();
</script>