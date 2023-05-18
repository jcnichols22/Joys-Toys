<?php 
include('../includes/connect.php');

if(isset($_POST['insert_cat'])){
    $cat_title = $_POST['cat_title'];

    // select data from database
    $select_query = "SELECT * FROM categories WHERE category_title = '$cat_title'";
    // run the query
    $run_query = mysqli_query($con, $select_query);
    // count the number of rows
    $number=mysqli_num_rows($run_query);
    // if the number is greater than 0 then the category already exists
    if($number>0){
        // alert the user that the category already exists
        echo "<script>alert('Category already exists!')</script>";
    } else {
        // if the category does not exist then insert the category into the database
        $insert_query = "INSERT INTO categories (category_title) VALUES ('$cat_title')";
        $run_query = mysqli_query($con, $insert_query);
        if ($run_query) {
            echo "<script>alert('Category has been inserted!')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Categories</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="Categories"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories">
    </div>
</form>