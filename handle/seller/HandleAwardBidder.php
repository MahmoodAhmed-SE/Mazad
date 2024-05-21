<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'seller') {
    $pdo = require('../../mysql_db_connection.php');

    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    if ($role !== 'seller')  {
        // print('bidder or administrators are not allowed to access this page!');
        header('Location: /Mazad/pages/LoginPage.php');
    }

    require('../../services/getUser.php');

    $user = getUser($pdo, $id, $role);

    if ($user === false) {
        echo '<script>
            alert("Please Register first!");
            window.location.href = "/Mazad/pages/Registration.php";
            </script>';
        exit();
    } else if ($role != 'admin' && $user[$role . '_status'] === 0) {
        echo '<script>
            alert("Please Wait for admin approval!");
            window.location.href = "/Mazad/pages/HomePage.php";
            </script>';
        exit();
    }

    $bidder_id = $_GET['bidder_id'];
    $product_id = $_GET['product_id'];


    $query = $pdo->prepare('UPDATE PRODUCTS SET bidder_id = :bidder_id WHERE product_id = :product_id;');
    $query->bindParam(':bidder_id', $bidder_id);
    $query->bindParam(':product_id', $product_id);
    $query->execute();

    $str = 'Location: /Mazad/pages/seller/BidderContactPage.php?product_id=' . $_GET['product_id'] . '&bidder_id=' . $_GET['bidder_id'] . '&bid_price=' .$_GET['bid_price'] . '&product_name=' . $_GET['product_name'];
    header($str);
}
else {
    header('Location: /Mazad/pages/LoginPage.php');
}

?>