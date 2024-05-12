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

        $bid_id = $_POST['bid_id'];

        $query = $pdo->prepare('DELETE FROM Bids WHERE bid_id = :bid_id;');

        $query->bindParam(':bid_id', $bid_id);

        $query->execute();


        header('Location: /Mazad/pages/bidder/B_Menu');

        echo '<script>alert("Bid has been canceled successfully!")</script>';
        exit();
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>




