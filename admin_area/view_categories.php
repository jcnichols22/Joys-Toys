<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <tr>
            <th>ID #</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_categories = "SELECT * FROM categories";
        $run_categories = mysqli_query($con, $get_categories);
        while ($row_categories = mysqli_fetch_array($run_categories)) {
            $category_id = $row_categories['category_id'];
            $category_title = $row_categories['category_title'];
            echo "
            <tr>
                <td>$category_id</td>
                <td>$category_title</td>
                <td><a href='index.php?edit_category=$category_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_category=$category_id'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>