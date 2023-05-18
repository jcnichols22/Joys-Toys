<?php
if (isset($_GET['delete_category'])) {
    $delete_category_id = $_GET['delete_category'];
    $delete_category = "DELETE FROM categories WHERE category_id='$delete_category_id'";
    $run_delete_category = mysqli_query($con, $delete_category);
    if ($run_delete_category) {
        echo "<script>alert('category has been deleted!')</script>";
        echo "<script>window.open('index.php?view_categories', '_self')</script>";
    }
}

?>