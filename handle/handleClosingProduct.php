<?php

if(isset($_POST['submit']) && isset($_POST['agree'])) {
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $pdo = require('../mysql_db_connection.php');

        $id = isset($_SESSION['user_id']);
        $role = isset($_SESSION['role']);
        
               
        require('../services/getUser.php');

        $user = getUser($pdo, $id, $role);
        
        
        if ($user === false) {
            print('Please register! or Your Registration is Pending.');
        }
        

        $product_id = $_POST['product'];

        $query = $pdo->prepare('UPDATE Products SET product_status = 0 WHERE product_id = :product_id;');
        $query->bindParam(':product_id', $product_id);
        $query->execute();
        
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }

}

?>