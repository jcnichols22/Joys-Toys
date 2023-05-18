<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
        $get_orders = "SELECT * FROM customer_orders";
        $run_orders = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($run_orders);

        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No orders found</h2>";
        } else {
            echo "
                <tr>
                    <th></th>
                    <th>Amount Due</th>
                    <th>Invoice No</th>
                    <th>Total Products</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";
            $i = 0;
            while ($row_orders = mysqli_fetch_array($run_orders)) {
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['amount_due'];
                $invoice = $row_orders['invoice'];
                $total_products = $row_orders['total_products'];
                $order_date = $row_orders['order_date'];
                $order_status = $row_orders['order_status'];
                $i++;

                echo "
                <tr>
                    <td>$i</td>
                    <td>$amount_due</td>
                    <td>$invoice</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='index.php?delete_order=$order_id' onclick='return confirm(\"Are you sure you want to delete this order?\");'><i class='fa-solid fa-trash'></i></a></td>
                    ";
            }
        }
        ?>

        </tbody>

</table>