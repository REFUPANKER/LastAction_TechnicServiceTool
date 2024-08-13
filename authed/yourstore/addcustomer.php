<?php
if (!isset($store)) {
    echo "<div class='alert alert-danger'>No Store existing. Redirecting in 3 seconds</div>";
    header("refresh:3;./");
    return;
}
$customers = GetCustomers();
?>

<form method="post" class="d-flex flex-column gap-2 ">
    <h1 class="text-center">Add Customer</h1>
    <?php
    if (isset($_POST["add_customer"])) {
        $orderId = AddCustomer($_POST["name"], $store["id"], $_POST["issue"], $_POST["contact"]); ?>
        <div class="alert alert-success">Customer added.<a href="?p=addcustomer"><b>Refresh</b></a>ing page in 10 seconds</div>
        <h4>Order Number : <?=$orderId?></h4>
        
    <?php
        header("refresh:10;?p=addcustomer");
        return;
    }
    ?>
    <label>Name</label>
    <input class="form-control" maxlength="64" required name="name">
    <label>Issue</label>
    <textarea class="form-control" maxlength="512" required name="issue" style="resize: none;"></textarea>
    <label>Contact</label>
    <input class="form-control" type="tel" placeholder="phone,mail or adress" maxlength="512" required name="contact">
    <button name="add_customer" class="btn btn-success">Add</button>
</form>