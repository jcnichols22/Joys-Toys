<?php
if (isset($_GET['delete_brand'])) {
    $delete_brand_id = $_GET['delete_brand'];
    $delete_brand = "DELETE FROM brands WHERE brand_id='$delete_brand_id'";
    $run_delete_brand = mysqli_query($con, $delete_brand);
    if ($run_delete_brand) {
        echo "<script>alert('brand has been deleted!')</script>";
        echo "<script>window.open('index.php?view_brands', '_self')</script>";
    }
}

?>