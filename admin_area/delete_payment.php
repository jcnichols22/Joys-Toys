<?php
if (isset($_GET['delete_payment'])) {
    $delete_payment_id = $_GET['delete_payment'];
    $delete_payment = "DELETE FROM payments WHERE payment_id='$delete_payment_id'";
    $run_delete_payment = mysqli_query($con, $delete_payment);
    if ($run_delete_payment) {
        echo "<script>alert('Payment has been deleted!')</script>";
        echo "<script>window.open('index.php?view_payments', '_self')</script>";
    }
}

?>