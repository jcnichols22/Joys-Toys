<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_customer = "SELECT * FROM user_data WHERE username ='$username'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $user_id = $row_customer['user_id'];

    ?>
    <h3 class="text-success text-center">All My Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <tr>
                <th>Order No</th>
                <th>Amount Due</th>
                <th>Product Total</th>
                <th>Invoice Number</th>
                <th>Order Date</th>
                <th>Paid/Unpaid</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_orders = "SELECT * FROM customer_orders WHERE user_id = '$user_id'";
            $run_orders = mysqli_query($con, $get_orders);
            $number = 1;
            while ($row_data = mysqli_fetch_array($run_orders)) {
                $order_id = $row_data['order_id'];
                $amount_due = $row_data['amount_due'];
                $total_products = $row_data['total_products'];
                $invoice = $row_data['invoice'];
                $order_date = substr($row_data['order_date'], 0, 11);
                $order_status = $row_data['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Pending';
                } else {
                    $order_status = 'Complete';
                }
                echo "
                <tr class='text-center'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice</td>
                    <td>$order_date</td>
                    <td>$order_status</td>";
                ?>
                <?php
                if ($order_status == 'Complete') {
                    echo "<td>Paid</td>";
                } else {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                        </tr>";
                }
                $number++;
            }


            ?>
        </tbody>

    </table>

</body>

</html>