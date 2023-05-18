<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start()
    ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Joys Toys User Dashboard</title>
    <!-- css link -->
    <link rel="stylesheet" href="../styles.css">
    <style>
        .profile_img {
            width: 90%;
            margin: auto;
            display: block;
            object-fit: contain;
        }

        .edit_profile_img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- calling cart function -->
    <?php cart(); ?>

    <!-- navbar -->
    <!-- container-fluid with p-0 will make the nav banner span the full width of the window-->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/joys-toys-logo.png" alt="" class="nav-logo">
                <!-- creates the search bar and the hamburger menu and button-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- unordered list with list elements for nav links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_dashboard.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <!-- font awesome cart icon -->
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
                                    <?php total_items() ?>
                                </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:
                                <?php cart_total_price() ?>
                            </a>
                        </li>

                    </ul>
                    <!-- d-flex so that this will display as a flex box container which will keep the search bar and button in a row -->
                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                // if user is not logged in, display welcome guest
                if (!isset($_SESSION['username'])) {
                    echo "
          <li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
                    // if user is logged in, display welcome and the username
                } else {
                    echo "
          <li class='nav-item'>
          <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
        </li>";
                }

                // if user is not logged in, display login link
                if (!isset($_SESSION['username'])) {
                    echo "
          <li class='nav-item'>
          <a class='nav-link' href='./user_area/user_login.php'>Login</a>
          </li>";
                    // if user is logged in, display logout link
                } else {
                    echo "
          <li class='nav-item'>
          <a class='nav-link' href='./user_area/logout.php'>Logout</a>
          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Joys Toys</h3>
            <p class="text-center">Where every toy brings Joy to your world!</p>
        </div>

        <!-- fourth child -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your Profile</h4>
                        </a>
                    </li>

                    <?php
                    $username = $_SESSION['username'];
                    $user_img = "SELECT * FROM user_data WHERE username = '$username'";
                    $user_img_query = mysqli_query($con, $user_img);
                    $user_img_row = mysqli_fetch_array($user_img_query);
                    $user_img = $user_img_row['user_img'];
                    echo "
                        <li class='nav-item'>
                            <img src='user_images/$user_img' alt='' class='profile_img my-4'>
                        </li>
                    ";
                    ?>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_dashboard.php">Pending Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_dashboard.php?edit_account">Edit Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_dashboard.php?my_orders">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_dashboard.php?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>
                </ul>

            </div>
            <div class="col-md-10 text-center">
                <?php
                get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include("edit_account.php");
                }
                if (isset($_GET['my_orders'])) {
                    include("user_orders.php");
                }
                if (isset($_GET['delete_account'])) {
                    include("delete_account.php");
                }
                ?>
            </div>

        </div>




        <!-- last child -->
        <?php include("../includes/footer.php") ?>
    </div>


    <!-- bootstrp js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>