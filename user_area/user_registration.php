<?php
include("../includes/connect.php");
include("../functions/common_function.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- Username Field -->
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter username here"
                            autocomplete="off" required="required" name="username" />
                    </div>
                    <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">E-mail</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter email here"
                            autocomplete="off" required="required" name="user_email" />
                    </div>
                    <!-- user image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image" />
                    </div>
                    <!-- user password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter password here"
                            autocomplete="off" required="required" name="user_password" />
                    </div>
                    <!-- confirm password -->
                    <div class="form-outline mb-4">
                        <label for="user_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="user_confirm_password" class="form-control"
                            placeholder="Confirm password here" autocomplete="off" required="required"
                            name="user_confirm_password" />
                    </div>
                    <!-- address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter address here"
                            autocomplete="off" required="required" name="user_address" />
                    </div>
                    <!-- contact field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter contact here"
                            autocomplete="off" required="required" name="user_contact" />
                    </div>
                    <!-- register button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" class="bg-info py-2 px-3 border-0" value="Register" name="user_register" />
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php"> Login
                                here</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['user_register'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $password_hash = password_hash($user_password, PASSWORD_DEFAULT);
    $user_confirm_password = $_POST['user_confirm_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    //select username and email query
    $select_query = "SELECT * FROM user_data WHERE username = '$username' or user_email = '$user_email'";
    $select_result = mysqli_query($con, $select_query);
    $select_row = mysqli_num_rows($select_result);
    if ($select_row > 0) {
        echo "<script>alert('Username or E-mail already exists!')</script>";
    } else if ($user_password != $user_confirm_password) {
        echo "<script>alert('Passwords do not match!')</script>";
    } else {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $query = "INSERT INTO user_data(username, user_email, user_password, user_img, user_ip, user_address, user_mobile) 
            VALUES('$username', '$user_email', '$password_hash', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $result = mysqli_query($con, $query);
    }

    // selecting cart items
    $select_cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$user_ip'";
    $select_cart_result = mysqli_query($con, $select_cart_query);
    $select_cart_row = mysqli_num_rows($select_cart_result);
    if ($select_cart_row > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('you have items in cart')</script>";
        echo "<script>window.open('checkout.php', '_self')</script>";
    } else {
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}
?>