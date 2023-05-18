<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>

<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <!-- <th>Status</th> -->
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $get_products = "SELECT * FROM products";
            $run_products = mysqli_query($con, $get_products);
            while ($row_products = mysqli_fetch_array($run_products)) {
                $product_id = $row_products['product_id'];
                $product_title = $row_products['product_title'];
                $product_image1 = $row_products['product_image1'];
                $product_price = $row_products['product_price'];
                // $product_status = $row_products['status'];
                $get_count = "SELECT * FROM pending_orders WHERE product_id='$product_id'";
                $run_count = mysqli_query($con, $get_count);
                $count = mysqli_num_rows($run_count);
                echo "
                <tr class='text-center align-middle'>
                    <td>$product_id</td>
                    <td>$product_title</td>
                    <td><img src='./product_images/$product_image1' class='product_img'</td>
                    <td>$$product_price</td>
                    <td>$count</td>                
                    <td><a href='index.php?edit_products=$product_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_product=$product_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }
            ?>



        </tbody>


    </table>

</body>

</html>