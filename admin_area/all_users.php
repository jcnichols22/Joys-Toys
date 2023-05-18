<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
        $get_users = "SELECT * FROM user_data";
        $run_users = mysqli_query($con, $get_users);
        $row_count = mysqli_num_rows($run_users);

        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No users found</h2>";
        } else {
            echo "
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";
            $i = 0;
            while ($row_orders = mysqli_fetch_array($run_users)) {
                $user_id = $row_orders['user_id'];
                $username = $row_orders['username'];
                $user_email = $row_orders['user_email'];
                $user_img = $row_orders['user_img'];
                $user_address = $row_orders['user_address'];
                $user_phone = $row_orders['user_mobile'];
                $i++;

                echo "
                <tr>
                    <td class='align-middle'>$i</td>
                    <td class='align-middle'>$username</td>
                    <td class='align-middle'>$user_email</td>
                    <td class='align-middle'><img src='../user_area/user_images/$user_img' alt='$username' class='product_img'</td>
                    <td class='align-middle'>$user_address</td>
                    <td class='align-middle'>$user_phone</td>
                    <td class='align-middle'><a href='index.php?delete_user=$user_id' onclick='return confirm(\"Are you sure you want to delete this order?\");'><i class='fa-solid fa-trash'></i></a></td>
                    ";
            }
        }
        ?>

        </tbody>

</table>