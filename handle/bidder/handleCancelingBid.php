<?php

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

    $bid_id = $_GET['bid_id'];

    $query = $pdo->prepare('DELETE FROM Bids WHERE bid_id = :bid_id;');

    $query->bindParam(':bid_id', $bid_id);

    $query->execute();

    
    echo '<script>
        alert("Bid has been canceled successfully!");
        window.location.href = "/Mazad/pages/bidder/B_Menu.php";
        </script>';

    exit();
}
else {
    header('Location: /Mazad/pages/LoginPage.php');
}
?>




