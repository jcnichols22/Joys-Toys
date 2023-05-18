<?php

// include connection file
//include("./includes/connect.php");

// getting products in index page
function getproducts()
{
  global $con;

  //condition to check if category is set
  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {
      $select_query = "SELECT * FROM products order by rand() LIMIT 0,6";
      $run_query = mysqli_query($con, $select_query);
      while ($row = mysqli_fetch_assoc($run_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
      </div>
    </div>";
      }
    }
  }
}

//getting all products in database
function get_all_products()
{
  global $con;

  //condition to check if category is set
  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {
      $select_query = "SELECT * FROM products order by rand()";
      $run_query = mysqli_query($con, $select_query);
      while ($row = mysqli_fetch_assoc($run_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
      </div>
    </div>";
      }
    }
  }

}

// getting products in category page

function get_selected_categories()
{
  global $con;

  //condition to check if category is set
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "SELECT * FROM products WHERE category_id = '$category_id'";
    $run_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($run_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No inventory in this category at this time. Please check back later!</h2>";
    }
    while ($row = mysqli_fetch_assoc($run_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
      </div>
    </div>";
    }
  }
}



// getting brands in side nav
function getbrands()
{
  global $con;
  $select_brands = "SELECT * FROM brands";
  $run_brands = mysqli_query($con, $select_brands);
  while ($row_data = mysqli_fetch_assoc($run_brands)) {
    $brand_title = $row_data['brand_title'];
    $brand_id = $row_data['brand_id'];
    echo "<li class='nav-item'>
      <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
      </li>";
  }
}


function get_selected_brands()
{
  global $con;

  //condition to check if category is set
  if (isset($_GET['brand'])) {
    $brand_id = $_GET['brand'];
    $select_query = "SELECT * FROM products WHERE brand_id = '$brand_id'";
    $run_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($run_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No inventory in this brand at this time. Please check back later!</h2>";
    }
    while ($row = mysqli_fetch_assoc($run_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
      </div>
    </div>";
    }
  }
}

// getting categories in side nav
function getcategories()
{
  global $con;
  $select_categories = "SELECT * FROM categories";
  $run_categories = mysqli_query($con, $select_categories);
  while ($row_data = mysqli_fetch_assoc($run_categories)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo "<li class='nav-item'>
      <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
      </li>";
  }
}


// get products searched for
function search_data()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $user_search_value = $_GET['search_data'];
    $search_query = "SELECT * FROM products WHERE product_keywords LIKE '%$user_search_value%'";
    $run_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($run_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger'>No results found, either no product at this time or check spelling and try again!</h2>";
    }
    while ($row = mysqli_fetch_assoc($run_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card' style='width: 18rem;'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>Price: $$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
      </div>
    </div>";
    }
  }
}


// view details of product function
function view_details()
{
  global $con;

  //condition to check if category is set
  if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
      if (!isset($_GET['brand'])) {
        $product_id = $_GET['product_id'];
        $select_query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $run_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($run_query)) {
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_image2 = $row['product_image2'];
          $product_image3 = $row['product_image3'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card' style='width: 18rem;'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>Price: $$product_price</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
              <a href='index.php' class='btn btn-secondary'>Return Home</a>
            </div>
          </div>
        </div>
        
        <div class='col-md-8'>
                <!-- related card images -->
                <div class='row'>
                    <div class='col-md-12'>
                        <h4 class='text-center text-info mb-5'>Related Products</h4>
                    </div>
                    <div class='col-md-6'>
                    <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>

                    </div>
                    <div class='col-md-6'>
                    <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>

                    </div>
                </div>

            </div>";


        }
      }
    }
  }

}

// get ip address function copied function from https://www.javatpoint.com/how-to-get-the-ip-address-in-php
function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

// add to cart function
function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $select_query = "SELECT * FROM customer_cart WHERE ip_address = '$get_ip_add' AND product_id =$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows > 0) {
      echo "<script>alert('Item already present inside the cart')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    } else {
      $insert_product = "INSERT INTO customer_cart (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 0)";
      $result_query = mysqli_query($con, $insert_product);
      echo "<script>alert('Item is added to cart')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    }
  }
}



// function to get total items in cart
function total_items()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM customer_cart WHERE ip_address = '$get_ip_add'";
    $result_query = mysqli_query($con, $select_query);
    $count_items = mysqli_num_rows($result_query);
  } else {
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM customer_cart WHERE ip_address = '$get_ip_add'";
    $result_query = mysqli_query($con, $select_query);
    $count_items = mysqli_num_rows($result_query);
  }
  echo $count_items;
}

// Cart total price function
function cart_total_price()
{
  global $con;
  $ip = getIPAddress();
  $total = 0;
  $cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$ip'";
  $result = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_product = "SELECT * FROM products WHERE product_id = '$product_id'";
    $run_products = mysqli_query($con, $select_product);
    while ($row_price = mysqli_fetch_array($run_products)) {
      $product_price = array($row_price['product_price']);
      $values = array_sum($product_price);
      $total += $values;
    }
  }
  echo "$" . $total;

}



// get order details for the user
function get_user_order_details()
{
  global $con;
  $username = $_SESSION['username'];
  $order_details = "SELECT * FROM user_data WHERE username = '$username'";
  $run_order_details = mysqli_query($con, $order_details);
  while ($row = mysqli_fetch_array($run_order_details)) {
    $user_id = $row['user_id'];
    if (!isset($_GET['edit_account'])) {
      if (!isset($_GET['my_orders'])) {
        if (!isset($_GET['delete_account'])) {
          $get_orders = "SELECT * FROM customer_orders WHERE user_id = '$user_id' AND order_status = 'pending'";
          $run_orders = mysqli_query($con, $get_orders);
          $count_orders = mysqli_num_rows($run_orders);
          if ($count_orders > 0) {
            echo "<h3 class='text-center text-success my-5'> You have <span class='text-danger'>$count_orders</span> pending orders</h3>
            <p class='text-center'><a href='user_dashboard.php?my_orders' class='text-dark'>View Orders</a></p>";
          } else {
            echo "<h3 class='text-center text-success my-5'> You have no pending orders</h3>
            <p class='text-center'><a href='../index.php' class='text-dark'>View products</a></p>";
          }
        }
      }
    }
  }
}


?>