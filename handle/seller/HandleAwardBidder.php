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
        header('Location: /Mazad/pages/LoginPage.php');
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