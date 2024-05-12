<?php
if (isset($_POST['submit'])) {

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $pdo = require('../../mysql_db_connection.php');

        $bidder_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        require('../../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            header('Location: /Mazad/pages/LoginPage.php');
        }

        $product_id = $_POST['product_id'];
        $bid_price = $_POST['bid_price'];
        $bid_date = date('Y-m-d'); // check
        

        $query = $pdo->prepare('INSERT INTO Bids(bid_price, bid_date, bidder_id, product_id)  VALUES(:bid_price, :bid_date, :bidder_id, :product_id);');

        $query->bindParam(':product_id', $product_id);
        $query->bindParam(':bid_price', $bid_price);
        $query->bindParam(':bid_date', $bid_date);

        $query->execute();


        header('Location: /Mazad/pages/bidder/B_Menu');

        echo '<script>alert("Bid has been set successfully!")</script>';
        exit();
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>




