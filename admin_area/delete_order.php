<?php
if (isset($_GET['delete_order'])) {
    $delete_order_id = $_GET['delete_order'];
    $delete_order = "DELETE FROM customer_orders WHERE order_id='$delete_order_id'";
    $run_delete_order = mysqli_query($con, $delete_order);
    if ($run_delete_order) {
        echo "<script>alert('order has been deleted!')</script>";
        echo "<script>window.open('index.php?all_orders', '_self')</script>";
    }
}

?>