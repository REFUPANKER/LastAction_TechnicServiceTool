<?php
include_once("../../managers/innerPageChecker.php");
if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}
?>

<h1 class="text-center">List Customers</h1>
<div class="d-flex flex-column gap-1">
    <div class="w-100 d-flex flex-column border overflow-auto" style="max-height: 80vh;">
        <?php
        if (isset($_GET["active"]) && isset($_GET["c"])) {
            $_GET["active"] %= 2;
            ChangeCustomerActive($_GET["c"], 1 - $_GET["active"]);
            header("location:?p=listcustomers#item" . $_GET["c"]);
        }

        if (isset($_POST["updateStatus"]) && isset($_POST["c"])) {
            ChangeCustomerStatus($_POST["c"], $_POST["updateStatus"]);
        }
        ?>
        <table>
            <tr class="text-center">
                <td><i class="fas ms-1 fa-diagram-project"></i></td>
                <td>Active</td>
                <td>Status</td>
                <td>Name</td>
                <td class="p-2">Issue</td>
                <td>Contact</td>
                <td>Entry</td>
            </tr>
            <?php
            $customers = GetCustomers();
            if (!isset($customers) || count($customers) <= 0) {
            ?>
                <tr>
                    <td colspan="7">
                        <div class="m-2 alert alert-warning">No results found</div>
                    </td>
                </tr>
            <?php
            }
            foreach ($customers as $key => $value) { ?>
                <tr class="border" id="item<?= $value["id"] ?>">
                    <td class="p-2 text-center " title="<?= $status[$value["status"] - 1] ?>" style="border-left:solid 0.5rem <?= $statusColor[$value["status"] - 1] ?>;"><?= $value["id"] ?></td>
                    <td class="p-2 text-center">
                        <a href="?p=listcustomers&c=<?= $value["id"] ?>&active=<?= $value["active"] ?>" class="m-0 btn bg-<?= $value["active"] ? "success" : "danger" ?>" title="click to switch">
                            <?= $value["active"] ? "True" : "False" ?></a>
                    </td>
                    <td class="p-2 text-center">
                        <form method="post" action="?p=listcustomers#item<?= $value["id"] ?>" class="gap-2 d-flex flex-column align-items-center">
                            <select name="updateStatus" class="p-1 w-100 bg-dark rounded rounded-3">
                                <?php
                                foreach ($status as $k => $v) { ?>
                                    <option <?= $value["status"] - 1 == $k ? "selected" : "" ?> value="<?= $k + 1 ?>"><?= $v ?></option>
                                <?php } ?>
                            </select>
                            <button name="c" value="<?= $value["id"] ?>" class="btn btn-outline-success p-1 w-100">Update</button>
                        </form>
                    </td>
                    <td class="p-2 text-center"><textarea class="border-0 form-control text-center align-content-center" style="resize: none;" readonly><?= htmlspecialchars($value["name"]) ?></textarea></td>
                    <td class="p-2 text-center"><textarea class="border-0 w-100 form-control" style="resize: none;" readonly><?= htmlspecialchars($value["issue"]) ?></textarea></td>
                    <td class="p-2 text-center"><textarea class="border-0 form-control" style="resize: none;" readonly><?= htmlspecialchars($value["contact"]) ?></textarea></td>
                    <td class="p-2 text-center"><?= $value["entry"] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="d-flex align-items-center gap-1 alert p-1 m-0 alert-warning"><i class="fa fa-exclamation btn btn-warning"></i> Active customers will be listed on your store page</div>
</div>