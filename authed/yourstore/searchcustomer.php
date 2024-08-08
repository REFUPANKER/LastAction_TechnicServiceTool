<?php
if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}
?>

<h1 class="text-center m-0">Search Customers</h1>
<?php
// SEARCH RESULTS
$res = [];
if (isset($_POST["CallSearch"])) {
    $searchType = "";
    switch ($_POST["SearchType"]) {
        case 'id':
            $res = SearchCustomer(id: $_POST["SearchInput"]);
            break;
        case 'name':
            $res = SearchCustomer(name: $_POST["SearchInput"]);
            break;
        case 'issue':
            $res = SearchCustomer(issue: $_POST["SearchInput"]);
            break;
    }
} ?>
<form method="post" class="d-flex gap-2 justify-content-center">
    <div class="d-flex flex-column gap-1">
        Search By
        <select name="SearchType">
            <option <?= isset($_POST["SearchType"]) && $_POST["SearchType"] == "id" ? "selected" : "" ?> value="id">ID</option>
            <option <?= isset($_POST["SearchType"]) && $_POST["SearchType"] == "name" ? "selected" : "" ?> value="name">Name</option>
            <option <?= isset($_POST["SearchType"]) && $_POST["SearchType"] == "issue" ? "selected" : "" ?> value="issue">Issue</option>
        </select>
        <button name="CallSearch" class="btn btn-success">Search</button>
    </div>
    <div class="gap-1 d-flex flex-column w-50">
        <label>Type here </label>
        <input class="m-0 h-100 form-control" style="resize: none;" required name="SearchInput" maxlength="64" value="<?= isset($_POST["SearchInput"]) ? $_POST["SearchInput"] : null ?>">
    </div>
</form>
<!-- Results Table  -->
<?php
if (isset($_GET["active"]) && isset($_GET["c"])) {
    $_GET["active"] %= 2;
    ChangeCustomerActive($_GET["c"], 1 - $_GET["active"]);
    header("refresh:3;?p=searchcustomer#item" . $_GET["c"]); ?>
    <div class="alert alert-success">Customer active status changed (refreshing in 3sec)</div>
<?php }

if (isset($_POST["updateStatus"]) && isset($_POST["c"])) {
    ChangeCustomerStatus($_POST["c"], $_POST["updateStatus"]);
    header("refresh:3;?p=searchcustomer#item" . $_POST["c"]); ?>
    <div class="alert alert-success">Customer current action changed (refreshing in 3sec)</div>
<?php } ?>
<div class="w-100 d-flex flex-column border overflow-auto" style="max-height: 70vh;">
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
        if (!isset($res) || count($res) <= 0) { ?>
            <tr>
                <td colspan="7">
                    <div class="m-2 alert alert-warning">No results found</div>
                </td>
            </tr>
            <?php } else {
            foreach ($res as $k => $value) { ?>
                <tr class="border" id="item<?= $value["id"] ?>">
                    <td class="p-2 text-center " title="<?= $status[$value["status"] - 1] ?>" style="border-left:solid 0.5rem <?= $statusColor[$value["status"] - 1] ?>;"><?= $value["id"] ?></td>
                    <td class="p-2 text-center">
                        <a href="?p=searchcustomer&c=<?= $value["id"] ?>&active=<?= $value["active"] ?>" class="m-0 btn bg-<?= $value["active"] ? "success" : "danger" ?>" title="click to switch">
                            <?= $value["active"] ? "True" : "False" ?></a>
                    </td>
                    <td class="p-2 text-center">
                        <form method="post" action="?p=searchcustomer#item<?= $value["id"] ?>" class="gap-2 d-flex flex-column align-items-center">
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
        <?php }
        } ?>
    </table>
</div>