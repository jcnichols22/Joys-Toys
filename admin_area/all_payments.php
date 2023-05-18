<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
        $get_payments = "SELECT * FROM user_payments";
        $run_payments = mysqli_query($con, $get_payments);
        $row_count = mysqli_num_rows($run_payments);

        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No payments found</h2>";
        } else {
            echo "
                <tr>
                    <th></th>
                    <th>Invoice No</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>";
            $i = 0;
            while ($row_orders = mysqli_fetch_array($run_payments)) {
                $payment_id = $row_orders['payment_id'];
                $order_id = $row_orders['order_id'];
                $invoice = $row_orders['invoice'];
                $amount = $row_orders['amount'];
                $payment_method = $row_orders['payment_method'];
                $order_date = $row_orders['date'];
                $i++;

                echo "
                <tr>
                    <td>$i</td>
                    <td>$invoice</td>
                    <td>$amount</td>
                    <td>$payment_method</td>
                    <td>$order_date</td>
                    ";
            }
        }
        ?>

        </tbody>

</table>