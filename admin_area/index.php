<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("location: admin_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css link -->
    <link rel="stylesheet" href="../styles.css">

    <style>
        .product_img {
            width: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/joys-toys-logo.png" alt="" class="nav-logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <?php
                        // if user is not logged in, display welcome guest
                        if (!isset($_SESSION['admin_username'])) {
                            echo "
                                <li class='nav-item'>
                                <a class='nav-link' href='#'>Welcome Guest</a>
                                </li>";
                            // if user is logged in, display welcome and the username
                        } else {
                            echo "
                                <li class='nav-item'>
                                <a class='nav-link' href='#'>Welcome " . $_SESSION['admin_username'] . "</a>
                                </li>";
                        }
                        ?>
                    </ul>

                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/bear.png" alt="" class="admin_image"></a>
                    <?php
                    // if user is not logged in, display welcome guest
                    if (!isset($_SESSION['admin_username'])) {
                        echo "
            
                                <p class='text-light' href='#'>Welcome Guest</p>
                                ";
                        // if user is logged in, display welcome and the username
                    } else {
                        echo "
                                <p class='text-light' href='#'>Welcome " . $_SESSION['admin_username'] . "</p>
                                ";
                    }
                    ?>
                </div>
                <div class="button text-center m-auto">
                    <button class="btn btn-info"><a href="index.php?insert_product"
                            class="nav-link text-light my-1">Insert
                            Products</a></button>
                    <button class="btn btn-info"><a href="index.php?view_products" class="nav-link text-light my-1">View
                            products</a></button>
                    <button class="btn btn-info"><a href="index.php?insert_category"
                            class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button class="btn btn-info"><a href="index.php?view_categories"
                            class="nav-link text-light my-1">View
                            Categories</a></button>
                    <button class="btn btn-info"><a href="index.php?insert_brand"
                            class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                    <button class="btn btn-info"><a href="index.php?view_brands" class="nav-link text-light my-1">View
                            Brands</a></button>
                    <button class="btn btn-info"><a href="index.php?all_orders" class="nav-link text-light my-1">All
                            Orders</a></button>
                    <button class="btn btn-info"><a href="index.php?all_payments" class="nav-link text-light my-1">All
                            Payments</a></button>
                    <button class="btn btn-info"><a href="index.php?all_users" class="nav-link text-light my-1">All
                            Users</a></button>
                    <button class="btn btn-info"><a href="admin_logout.php"
                            class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php
            // main pages included for buttons in admin panel
            if (isset($_GET['insert_product'])) {
                include("insert_product.php");
            }
            if (isset($_GET['view_products'])) {
                include("view_products.php");
            }
            if (isset($_GET['insert_category'])) {
                include("insert_categories.php");
            }
            if (isset($_GET['view_categories'])) {
                include("view_categories.php");
            }
            if (isset($_GET['insert_brand'])) {
                include("insert_brands.php");
            }
            if (isset($_GET['view_brands'])) {
                include("view_brands.php");
            }
            if (isset($_GET['all_orders'])) {
                include("all_orders.php");
            }
            if (isset($_GET['all_payments'])) {
                include("all_payments.php");
            }
            if (isset($_GET['all_users'])) {
                include("all_users.php");
            }

            // these pages are included for buttons inside the above pages
            
            if (isset($_GET['edit_products'])) {
                include("edit_products.php");
            }
            if (isset($_GET['delete_product'])) {
                include("delete_product.php");
            }
            if (isset($_GET['edit_category'])) {
                include("edit_category.php");
            }
            if (isset($_GET['delete_category'])) {
                include("delete_category.php");
            }
            if (isset($_GET['edit_brand'])) {
                include("edit_brand.php");
            }
            if (isset($_GET['delete_brand'])) {
                include("delete_brand.php");
            }
            if (isset($_GET['delete_order'])) {
                include("delete_order.php");
            }
            if (isset($_GET['delete_payment'])) {
                include("delete_payment.php");
            }
            if (isset($_GET['delete_user'])) {
                include("delete_user.php");
            }


            ?>
        </div>

        <!-- last child -->
        <?php include('../includes/footer.php'); ?>
    </div>



    <!-- bootstrp js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>