<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_product = "SELECT * FROM products WHERE product_id='$edit_id'";
    $run_product = mysqli_query($con, $get_product);
    $row_product = mysqli_fetch_array($run_product);
    $product_title = $row_product['product_title'];
    $product_description = $row_product['product_description'];
    $product_keywords = $row_product['product_keywords'];
    $category_id = $row_product['category_id'];
    $brand_id = $row_product['brand_id'];
    $product_image1 = $row_product['product_image1'];
    $product_image2 = $row_product['product_image2'];
    $product_image3 = $row_product['product_image3'];
    $product_price = $row_product['product_price'];


    // Get category name
    $get_category = "SELECT * FROM categories WHERE category_id='$category_id'";
    $run_category = mysqli_query($con, $get_category);
    $row_category = mysqli_fetch_array($run_category);
    $category_title = $row_category['category_title'];

    // Get brand name
    $get_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";
    $run_brand = mysqli_query($con, $get_brand);
    $row_brand = mysqli_fetch_array($run_brand);
    $brand_title = $row_brand['brand_title'];
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" value="<?php echo $product_title ?>"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description"
                value="<?php echo $product_description ?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" value="<?php echo $product_keywords ?>"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" class="form-select">
                <!-- this option displays what is currently saved in the data base for the category -->
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                <?php
                $get_all_categories = "SELECT * FROM categories";
                $run_all_categories = mysqli_query($con, $get_all_categories);
                // this while loop displays all the categories in the database
                while ($row_all_categories = mysqli_fetch_array($run_all_categories)) {
                    $category_id = $row_all_categories['category_id'];
                    $category_title = $row_all_categories['category_title'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label">Product Brand</label>
            <select name="product_brands" class="form-select">
                <!-- this option displays what is currently saved in the data base for the brand -->
                <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
                <?php
                $get_all_brands = "SELECT * FROM brands";
                $run_all_brands = mysqli_query($con, $get_all_brands);
                // this while loop displays all the brands in the database
                while ($row_all_brands = mysqli_fetch_array($run_all_brands)) {
                    $brand_id = $row_all_brands['brand_id'];
                    $brand_title = $row_all_brands['brand_title'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" name="product_image1" id="product_image1" value="<?php echo $product_title ?>"
                    class="form-control w-90 m-auto" required="required">
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" name="product_image2" id="product_image2" value="<?php echo $product_title ?>"
                    class="form-control w-90 m-auto" required="required">
                <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" name="product_image3" id="product_image3" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="product_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $product_price ?>"
                class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_products" value="Update Product" class="btn btn-info px-3 mb-3 text-light">
        </div>
    </form>
</div>

<!-- update product button -->
<?php
if (isset($_POST['edit_products'])) {
    // getting the text data from the fields
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    // getting the image from the field
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // image temp names
    $temp_name1 = $_FILES['product_image1']['tmp_name'];
    $temp_name2 = $_FILES['product_image2']['tmp_name'];
    $temp_name3 = $_FILES['product_image3']['tmp_name'];


    // uploading images to its folder
    move_uploaded_file($temp_name1, "./product_images/$product_image1");
    move_uploaded_file($temp_name2, "./product_images/$product_image2");
    move_uploaded_file($temp_name3, "./product_images/$product_image3");

    // updating the product in the database
    $update_product = "UPDATE products SET product_title='$product_title', product_description='$product_description', product_keywords='$product_keywords', category_id='$product_category', brand_id='$product_brands', product_price='$product_price', product_image1='$product_image1', product_image2='$product_image2', product_image3='$product_image3', date=NOW() WHERE product_id='$edit_id'";
    $run_product_update = mysqli_query($con, $update_product);

    if ($run_product_update) {
        echo "<script>alert('Product has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_products', '_self')</script>";
    }
}
?>