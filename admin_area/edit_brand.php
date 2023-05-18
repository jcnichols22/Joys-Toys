<?php
if (isset($_GET['edit_brand'])) {
    $brand_id = $_GET['edit_brand'];
    $get_brand_id = "SELECT * FROM brands WHERE brand_id='$brand_id'";
    $run_brand = mysqli_query($con, $get_brand_id);
    $row_brand = mysqli_fetch_array($run_brand);
    $brand_id = $row_brand['brand_id'];
    $brand_title = $row_brand['brand_title'];
}

if (isset($_POST['update_brand'])) {
    $update_title = $_POST['brand_title'];
    $update_brand = "UPDATE brands SET brand_title='$update_title' WHERE brand_id='$brand_id'";
    $run_brand = mysqli_query($con, $update_brand);
    if ($run_brand) {
        echo "<script>alert('brand has been updated successfully')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Edit brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="brand_title" class="form-label">brand Title</label>
            <input type="text" name="brand_title" id="brand_title" value="<?php echo $brand_title ?>"
                class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="update_brand" value="Update brand" class="btn btn-info px-3 mb-3 text-light">
        </div>
    </form>
</div>