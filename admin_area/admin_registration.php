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
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/registration.jpg" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-3">
                        <label for="admin_username" class="form-label">Admin Userame</label>
                        <input type="text" class="form-control" id="admin_username" name="admin_username"
                            placeholder="Enter username" required="required">
                    </div>
                    <div class="form-outline mb-3">
                        <label for="admin_email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="admin_email" name="admin_email"
                            placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Admin Password</label>
                        <input type="password" class="form-control" id="admin_password" name="admin_password"
                            placeholder="Enter your password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_admin_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_admin_password"
                            name="confirm_admin_password" placeholder="Confirm your password" required>
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="register_admin" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php">Login</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>


<?php
if (isset($_POST['register_admin'])) {
    $username = $_POST['admin_username'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $password_hash = password_hash($admin_password, PASSWORD_DEFAULT);
    $confirm_admin_password = $_POST['confirm_admin_password'];

    //select username and email query
    $select_query = "SELECT * FROM admin_data WHERE admin_username = '$username' or admin_email = '$admin_email'";
    $select_result = mysqli_query($con, $select_query);
    $select_row = mysqli_num_rows($select_result);
    if ($select_row > 0) {
        echo "<script>alert('Username or E-mail already exists!')</script>";
    } else if ($admin_password != $confirm_admin_password) {
        echo "<script>alert('Passwords do not match!')</script>";
    } else {
        $query = "INSERT INTO admin_data(admin_username, admin_email, admin_password) 
            VALUES('$username', '$admin_email', '$password_hash')";
        $result = mysqli_query($con, $query);
        echo "<script>alert('Admin registered successfully')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }
}
?>