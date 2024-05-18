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

        $query = $pdo->prepare('UPDATE Bids SET bid_price = :bid_price WHERE bid_id = :bid_id;');
        $query->bindParam(':bid_id', $_POST['bid_id']);
        $query->bindParam(':bid_price', $_POST['bid_price']);
        $query->execute();

        echo '<script>
                alert("Bid has been updated successfully!");
                window.location.href = "/Mazad/pages/bidder/B_Menu.php";
                </script>';
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>



