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
    <title>Payment</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
</head>
<style>
    .pay_img{
        width: 50%;
        margin: auto;
        display: block;
    }
</style>

<body>
    <!-- php code to access user ID -->
    <?php
    $ip=getIPAddress();
    $get_customer="SELECT * FROM user_data WHERE user_ip='$ip'";
    $result_customer=mysqli_query($con,$get_customer);
    $run_customer=mysqli_fetch_array($result_customer);
    $customer_id=$run_customer['user_id'];
    
    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <a href="https://www.paypal.com" target=="_blank"><img src="../images/payments.png" alt="" class="pay_img"></a>
            </div>
            <div class="col-md-6">
            <a href="orders.php?customer_id=<?php echo $customer_id ?>"><h2 class="text-center">Pay Offline</h2></a>
            </div>
        </div>
    </div>

</body>
</html>