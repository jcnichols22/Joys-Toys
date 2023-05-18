<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Joys Toys - Customer Cart</title>
  <!-- css link -->
  <link rel="stylesheet" href="styles.css">
  <style>
    .cart_img {
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
        <img src="./images/joys-toys-logo.png" alt="" class="nav-logo">
        <!-- creates the search bar and the hamburger menu and button-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- unordered list with list elements for nav links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./user_area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <!-- font awesome cart icon -->
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
                  <?php total_items() ?>
                </sup></a>
            </li>
          </ul>
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

        if (!isset($_SESSION['username'])) {
          echo "
          <li class='nav-item'>
          <a class='nav-link' href='./user_area/user_login.php'>Login</a>
          </li>";
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

    <!-- fourth child table-->
    <div class="container">
      <div class="row">
        <form action="" method="post">
          <table class="table table-bordered text-center">


            <!-- php for pulling info from database for the table -->
            <?php
            $ip = getIPAddress();
            $total = 0;
            $cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$ip'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
              echo "
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";
              while ($row = mysqli_fetch_array($result)) {
                $product_id = $row['product_id'];
                $select_product = "SELECT * FROM products WHERE product_id = '$product_id'";
                $run_products = mysqli_query($con, $select_product);
                while ($row_price = mysqli_fetch_array($run_products)) {
                  $product_price = array($row_price['product_price']);
                  $single_price = $row_price['product_price'];
                  $product_title = $row_price['product_title'];
                  $product_image = $row_price['product_image1'];
                  $values = array_sum($product_price);
                  $total += $values;
                  ?>
                  <tr>
                    <td>
                      <?php echo $product_title ?>
                    </td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image ?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="quantity" class="form-input w-50"></td>
                    <?php
                    $ip = getIPAddress();
                    if (isset($_POST['update'])) {
                      $quantity = $_POST['quantity'];
                      $update_quantity = "UPDATE customer_cart SET quantity = '$quantity' WHERE ip_address = '$ip'";
                      $run_quantity = mysqli_query($con, $update_quantity);
                      $total = $total * $quantity;
                    }

                    ?>
                    <td>
                      <?php echo "$" . $single_price ?>
                    </td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                      <input type="submit" value="Update" class="bg-info px-3 py-2 border-0 mx-3" name="update">
                      <input type="submit" value="Remove" class="bg-info px-3 py-2 border-0 mx-3" name="remove">
                    </td>
                  </tr>
                  <!-- closing while loops from above the table data -->
                <?php }
              }
            }
            // else statement for the if ($result_count > 0)
            else {
              echo "<h2 class='text-center text-danger'>Your cart is empty</h2>";
            }
            ?>
            </tbody>
          </table>

          <!-- subtotal -->
          <!-- d-flex for display flex to display on the same line -->
          <div class="d-flex mb-3">
            <?php
            $ip = getIPAddress();
            $cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$ip'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
              // if there are items in the cart, display the subtotal and continue shopping and checkout buttons
              echo "
                    <h4 class='px-3'>Subtotal: <strong class='text-info'>$$total</strong></h4>
                    <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                    <button class='bg-secondary px-3 py-2 border-0'><a href='./user_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button></a>
                    ";
            } else {
              echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
            }

            if (isset($_POST['continue_shopping'])) {
              // if the continue shopping button is clicked, redirect to the index page and refresh the page
              echo "<script>window.open('index.php', '_self')</script>";
            }
            ?>

          </div>
      </div>
    </div>
    </form>

    <!-- function for removing items -->
    <?php
    function remove_cart_item()
    {
      global $con;
      if (isset($_POST['remove'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
          $delete_product = "DELETE FROM customer_cart WHERE product_id = '$remove_id'";
          $run_delete = mysqli_query($con, $delete_product);
          if ($run_delete) {
            echo "<script>alert('Item is removed from the cart')</script>";
            echo "<script>window.open('cart.php', '_self')</script>";
          }
        }
      }
    }
    remove_cart_item();
    ?>


    <!-- last child -->
    <?php include("./includes/footer.php") ?>
  </div>


  <!-- bootstrp js link  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>