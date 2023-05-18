<?php
// start session
session_start();
// usent session variables
session_unset();
// destroy session
session_destroy();
// redirect to user home page after logout
echo "<script>window.open('index.php', '_self')</script>";

?>