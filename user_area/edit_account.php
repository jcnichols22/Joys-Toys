<?php
// getting the user data from the database
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $get_user_data = "SELECT * FROM user_data WHERE username = '$user_session_name'";
    $get_user_data_query = mysqli_query($con, $get_user_data);
    $get_user_data_row = mysqli_fetch_array($get_user_data_query);
    $user_id = $get_user_data_row['user_id'];
    $username = $get_user_data_row['username'];
    $user_email = $get_user_data_row['user_email'];
    $user_address = $get_user_data_row['user_address'];
    $user_mobile = $get_user_data_row['user_mobile'];
}

// if user clicks on update button update the user data in the database
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $update_username = $_POST['username'];
    $update_email = $_POST['user_email'];
    $update_address = $_POST['user_address'];
    $update_mobile = $_POST['user_mobile'];
    $update_img = $_FILES['user_img']['name'];
    $update_img_tmp = $_FILES['user_img']['tmp_name'];
    move_uploaded_file($update_img_tmp, "./user_images/$update_img");

    $update_user_data = "UPDATE user_data SET username = '$update_username', user_email = '$update_email', user_address = '$update_address', user_mobile = '$update_mobile', user_img = '$update_img' WHERE user_id = '$update_id'";
    $update_user_data_query = mysqli_query($con, $update_user_data);
    if ($update_user_data_query) {
        echo "<script>alert('Your account has been updated successfully')</script>";
        echo "<script>window.open('logout.php', '_self')</script>";
    } else {
        echo "<script>alert('Your account has not been updated')</script>";
        echo "<script>window.open('index.php?user_dashboard', '_self')</script>";
    }


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">Edit Account Information</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo "$username" ?>" name="username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo "$user_email" ?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_img">
            <img src="./user_images/<?php echo $user_img ?>" alt="" class="edit_profile_img">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo "$user_address" ?>"
                name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo "$user_mobile" ?>" name="user_mobile">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">

    </form>
</body>

</html>