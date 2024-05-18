<?php
if (isset($_POST['submit'])) {

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $pdo = require('../../mysql_db_connection.php');

        $id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        require('../../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            echo '<script>
                alert("Either Your Registration is Pending or Not Registered yet!");
                window.location.href = "/Mazad/pages/HomePage.php";
                </script>';
        }

        $product_id = $_POST['product_id'];
        $bid_price = $_POST['bid_price'];
        $bid_date = date('Y-m-d'); // check
        

        $query = $pdo->prepare('INSERT INTO Bids(bid_price, bid_date, bidder_id, product_id)  VALUES(:bid_price, :bid_date, :bidder_id, :product_id);');

        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':bid_price', $bid_price);
        $query->bindParam(':bid_date', $bid_date);
        $query->bindParam(':bidder_id', $id);

        $query->execute();

        
        echo '<script>
        alert("Bid has been set successfully!");
        window.location.href = "/Mazad/pages/bidder/B_Menu.php";
        </script>';
       
        exit();
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>




