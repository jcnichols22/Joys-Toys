<?php
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $get_category_id = "SELECT * FROM categories WHERE category_id='$category_id'";
    $run_category = mysqli_query($con, $get_category_id);
    $row_category = mysqli_fetch_array($run_category);
    $category_id = $row_category['category_id'];
    $category_title = $row_category['category_title'];
}

if (isset($_POST['update_category'])) {
    $update_title = $_POST['category_title'];
    $update_category = "UPDATE categories SET category_title='$update_title' WHERE category_id='$category_id'";
    $run_category = mysqli_query($con, $update_category);
    if ($run_category) {
        echo "<script>alert('Category has been updated successfully')</script>";
        echo "<script>window.open('index.php?view_categories','_self')</script>";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" value="<?php echo $category_title ?>"
                class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="update_category" value="Update Category"
                class="btn btn-info px-3 mb-3 text-light">
        </div>
    </form>
</div>