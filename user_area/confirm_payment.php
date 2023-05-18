<?php
include("../includes/connect.php");
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $get_order = "SELECT * FROM customer_orders WHERE order_id = '$order_id'";
    $get_order_query = mysqli_query($con, $get_order);
    $get_order_row = mysqli_fetch_array($get_order_query);
    $invoice_number = $get_order_row['invoice'];
    $amount_due = $get_order_row['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $insert_payment = "INSERT INTO user_payments (order_id, invoice, amount, payment_method) VALUES ($order_id, $invoice_number, $amount, '$payment_method')";
    $insert_payment_query = mysqli_query($con, $insert_payment);
    if ($insert_payment_query) {
        echo "<script>alert('Your order has been received, Thanks')</script>";
        echo "<script>window.open('user_dashboard.php?my_orders', '_self')</script>";
    }
    $update_orders = "UPDATE customer_orders SET order_status = 'Complete' WHERE order_id = '$order_id'";
    $update_orders_query = mysqli_query($con, $update_orders);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_method" class="form-select w-50 m-auto">
                    <option>Select Payment Method</option>
                    <option>Paypal</option>
                    <option>Credit</option>
                    <option>Check</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>

</body>

</html>