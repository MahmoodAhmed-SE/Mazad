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
            header('Location: /Mazad/pages/LoginPage.php');
        }

        $query = $pdo->prepare('UPDATE Bids SET bid_price = :bid_price WHERE bid_id = :bid_id;');
        $query->bindParam(':bid_id', $_POST['bid_id']);
        $query->bindParam(':bid_price', $_POST['bid_price']);
        $query->execute();

        echo "Bid has been updated successfully!";
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>



