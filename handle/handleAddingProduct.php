<?php

if(isset($_POST['submit'])) {
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'seller') {
        $pdo = require('../mysql_db_connection.php');

        $id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if ($role !== 'seller')  {
            // print('bidder or administrators are not allowed to access this page!');
            header('Location: /Mazad/pages/LoginPage.php');
        }

        require('../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            header('Location: /Mazad/pages/LoginPage.php');
        }

        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_minimum_bidding_price = $_POST['product_minimum_bidding_price'];
        $product_start_date = $_POST['product_start_date'];
        $product_last_date = $_POST['product_last_date'];


        $query = $pdo->prepare('INSERT INTO Products(product_name, product_minimum_bidding_price, product_description, product_start_date, product_last_date, product_status, seller_id, product_type_id, product_image, bidder_id) 
        VALUES(:product_name, :product_minimum_bidding_price, :product_description, :product_start_date, :product_last_date, :product_status, :seller_id, :product_type_id, :product_image, :bidder_id);');

        // to work with:
        $prod_default_status = '1';
        $seller_id = $user['seller_id'];
        $product_type_id = 1;
        $product_image = 'image path';
        $bidder_id = 1;

        $query->bindParam(':product_name', $product_name);
        $query->bindParam(':product_minimum_bidding_price', $product_minimum_bidding_price);
        $query->bindParam(':product_description', $product_description);
        $query->bindParam(':product_start_date', $product_start_date);
        $query->bindParam(':product_last_date', $product_last_date);
        $query->bindParam(':product_status', $prod_default_status);
        $query->bindParam(':seller_id', $seller_id);
        $query->bindParam(':product_type_id', $product_type_id);
        $query->bindParam(':product_image', $product_image);
        $query->bindParam(':bidder_id', $bidder_id);


        $query->execute();


        print('Insertion is successful!');
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>