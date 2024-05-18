<?php
if (isset($_POST['submit'])) {

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $pdo = require('../mysql_db_connection.php');

        $id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        require('../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            echo '<script>
                alert("Either Your Registration is Pending or Not Registered yet!");
                window.location.href = "/Mazad/pages/HomePage.php";
                </script>';
        }

        
        $product_id = $_POST['product_id'];
        $updated_name = $_POST['updated_name'];
        $updated_description = $_POST['updated_description'];
        $updated_product_minimum_bidding_price = $_POST['updated_product_minimum_bidding_price'];
        $updated_product_start_date = $_POST['updated_product_start_date'];
        $updated_product_last_date = $_POST['updated_product_last_date'];


        $query = $pdo->prepare('UPDATE Products SET product_name = :updated_name, product_description = :updated_product_description, product_minimum_bidding_price = :updated_product_minimum_bidding_price, product_start_date = :updated_product_start_date, product_last_date = :updated_product_last_date WHERE product_id = :product_id');


        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':updated_name', $updated_name);
        $query->bindParam(':updated_product_description', $updated_description);
        $query->bindParam(':updated_product_minimum_bidding_price', $updated_product_minimum_bidding_price);
        $query->bindParam(':updated_product_start_date', $updated_product_start_date);
        $query->bindParam(':updated_product_last_date', $updated_product_last_date);


        $query->execute();


        echo '<script>
                alert("Product Updated Successfully!");
                window.location.href = "/Mazad/pages/seller/S_Menu.php";
                </script>';
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}


?>