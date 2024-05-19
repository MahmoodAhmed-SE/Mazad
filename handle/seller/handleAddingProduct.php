<?php

if(isset($_POST['submit'])) {
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'seller') {
        $pdo = require('../../mysql_db_connection.php');

        $id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if ($role !== 'seller')  {
            echo '<script>
            alert("Bidder or administrators are not allowed to access this page!");
            window.location.href = "/Mazad/pages/HomePage.php";
            </script>';;
        }

        require('../../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            echo '<script>
                alert("Either Your Registration is Pending or Not Registered yet!");
                window.location.href = "/Mazad/pages/HomePage.php";
                </script>';
        }
        
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_minimum_bidding_price = $_POST['product_minimum_bidding_price'];
        $product_start_date = $_POST['product_start_date'];
        $product_last_date = $_POST['product_last_date'];
        $product_image = $_FILES['product_image'];
        $seller_id = $user['seller_id'];
        $product_type_id = $_POST['product_type_id'];


        require('../../services/uploadImage.php');
        $filename = upload($product_image, "../../uploads/product_images/");


        $query = $pdo->prepare('INSERT INTO Products(product_name, product_minimum_bidding_price, product_description, product_start_date, product_last_date, product_status, seller_id, product_type_id, product_image, bidder_id) 
        VALUES(:product_name, :product_minimum_bidding_price, :product_description, :product_start_date, :product_last_date, 1, :seller_id, :product_type_id, :product_image, NULL);');


        $query->bindParam(':product_name', $product_name);
        $query->bindParam(':product_minimum_bidding_price', $product_minimum_bidding_price);
        $query->bindParam(':product_description', $product_description);
        $query->bindParam(':product_start_date', $product_start_date);
        $query->bindParam(':product_last_date', $product_last_date);
        $query->bindParam(':seller_id', $seller_id);
        $query->bindParam(':product_type_id', $product_type_id);
        $query->bindParam(':product_image', $filename);


        $query->execute();


        echo '<script>
            alert("Product has been published!");
            window.location.href = "/Mazad/pages/seller/S_Menu.php";
            </script>';
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>