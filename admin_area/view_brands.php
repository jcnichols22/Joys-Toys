<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <tr>
            <th>ID #</th>
            <th>Brand</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_brands = "SELECT * FROM brands";
        $run_brands = mysqli_query($con, $get_brands);
        while ($row_brands = mysqli_fetch_array($run_brands)) {
            $brand_id = $row_brands['brand_id'];
            $brand_title = $row_brands['brand_title'];
            echo "
    <tr>
        <td>$brand_id</td>
        <td>$brand_title</td>
        <td><a href='index.php?edit_brand=$brand_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_brand=$brand_id' onclick='return confirm(\"Are you sure you want to delete this brand?\");'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
        }
        ?>

    </tbody>
</table>