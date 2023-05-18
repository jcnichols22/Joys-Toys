<?php
include("../includes/connect.php");
include("../functions/common_function.php");
@session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!-- Username Field -->
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter username here"
                            autocomplete="off" required="required" name="username" />
                    </div>
                    <!-- user password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter password here"
                            autocomplete="off" required="required" name="user_password" />
                    </div>
                    <!-- register button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" class="bg-info py-2 px-3 border-0" value="Login" name="user_login" />
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php">
                                Register here</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['user_login'])) {
    // get data from form
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $select_username_query = "SELECT * FROM user_data WHERE username = '$username'";
    $select_username_result = mysqli_query($con, $select_username_query);
    $row_count = mysqli_num_rows($select_username_result);
    $row_data = mysqli_fetch_assoc($select_username_result);
    $ip_address = getIPAddress();

    // select query for cart
    $select_cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$ip_address'";
    $select_cart_result = mysqli_query($con, $select_cart_query);
    $row_cart_count = mysqli_num_rows($select_cart_result);

    //if row count is greater than 0 means the user is present in the database table
    if ($row_count > 0) {
        // activate session for user
        $_SESSION['username'] = $username;
        if (password_verify($user_password, $row_data['user_password'])) {
            // if user is logged in and cart is empty then redirect to user dashboard
            if ($row_count == 1 and $row_cart_count == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('user_dashboard.php', '_self')</script>";
                // if user is logged in and cart is not empty then redirect to payment page
            } else {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Username or Password are incorrect')</script>";
        }
    } else {
        echo "<script>alert('Username or Password are incorrect')</script>";

    }

}
?>