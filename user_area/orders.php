<?php
include("../includes/connect.php");
include("../functions/common_function.php");

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
}

//getting total items and toatl price 
$ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM customer_cart WHERE ip_address = '$ip_address'";
$cart_result = mysqli_query($con, $cart_query);
// mt_rand() is a built-in function in PHP that generates a random number
$invoice_num = mt_rand();
$status = "pending";
$count_products = mysqli_num_rows($cart_result);
while ($cart_row = mysqli_fetch_array($cart_result)) {
    $product_id = $cart_row['product_id'];
    $select_product = "SELECT * FROM products WHERE product_id = $product_id";
    $run_product = mysqli_query($con, $select_product);
    while ($product_row = mysqli_fetch_array($run_product)) {
        $product_price = array($product_row['product_price']);
        $product_price_total = array_sum($product_price);
        $total_price += $product_price_total;

    }
}

// get qty from cart
$cart_query = "SELECT * FROM customer_cart";
$cart_result = mysqli_query($con, $cart_query);
$get_item_qty = mysqli_fetch_array($cart_result);
$qty = $get_item_qty['quantity'];
if ($qty == 0) {
    $qty = 1;
    $subtotal = $total_price;
} else {
    $qty = $qty;
    $subtotal = $total_price * $qty;
}

$insert_order = "INSERT INTO customer_orders (user_id, amount_due, invoice, total_products, order_date, order_status) VALUES ($customer_id, $subtotal, $invoice_num, $count_products, NOW(), '$status')";
$run_order = mysqli_query($con, $insert_order);
if ($run_order) {
    echo "<script>alert('Your order has been submitted, Thanks')</script>";
    echo "<script>window.open('user_dashboard.php', '_self')</script>";
}


//pening orders 
// $insert_pending_order = "INSERT INTO pending_orders (user_id, invoice, product_id, quantity, order_status) VALUES ($customer_id, $invoice_num, $product_id, $qty, '$status')";
// $run_pending_order = mysqli_query($con, $insert_pending_order);


// delete items from the cart after orders are placed in database
$delete_cart = "DELETE FROM customer_cart WHERE ip_address = '$ip_address'";
$run_delete = mysqli_query($con, $delete_cart);


?>