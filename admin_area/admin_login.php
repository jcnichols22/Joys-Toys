<?php
include("../includes/connect.php");
include("../functions/common_function.php");
@session_start();

if (isset($_SESSION['admin_username'])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/login.jpg" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-3">
                        <label for="admin_username" class="form-label">Admin Username</label>
                        <input type="text" class="form-control" id="admin_username" name="admin_username"
                            placeholder="Enter your username" required="required">
                    </div>
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Admin Password</label>
                        <input type="password" class="form-control" id="admin_password"
                            placeholder="Enter your password" name="admin_password" required>
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="login_admin" value="login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a
                                href="admin_registration.php">Register</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['login_admin'])) {
    // get data from form
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    $select_admin_query = "SELECT * FROM admin_data WHERE admin_username = '$admin_username'";
    $select_admin_result = mysqli_query($con, $select_admin_query);
    $row_count = mysqli_num_rows($select_admin_result);
    $row_data = mysqli_fetch_assoc($select_admin_result);

    //if row count is greater than 0 means the user is present in the database table
    if ($row_count > 0) {
        // activate session for user
        $_SESSION['admin_username'] = $admin_username;
        if (password_verify($admin_password, $row_data['admin_password'])) {
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            echo "<script>alert('Username or Password are incorrect')</script>";

        }

    }
}
?>