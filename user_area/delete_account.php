<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>

<body>
    <h3 class="text-success mb-4">Do you want to delete your account?</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="do_not_delete" value="Do Not Delete Account">
        </div>
    </form>

    <?php
    $username_session = $_SESSION['username'];
    // if user clicks delete account button
    if (isset($_POST['delete'])) {
        // delete user from database
        $delete_user = "DELETE FROM user_data WHERE username = '$username_session'";
        $run_delete = mysqli_query($con, $delete_user);
        // if user is deleted from database
        if ($run_delete) {
            // delete user from session
            session_destroy();
            // redirect user to home page
            echo "<script>alert('Your account has been deleted. Sorry to see you go!')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }
    // if user clicks do not delete account button
    if (isset($_POST['do_not_delete'])) {
        // redirect user to user dashboard
        echo "<script>window.open('user_dashboard.php', '_self')</script>";
    }
    ?>


</body>

</html>