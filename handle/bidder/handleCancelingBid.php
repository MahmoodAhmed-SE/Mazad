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
            alert("Please Register first!");
            window.location.href = "/Mazad/pages/Registration.php";
            </script>';
        exit();
    } else if ($role != 'admin' && $user[$role . '_status'] === 0) {
        echo '<script>
            alert("Please Wait for admin approval!");
            window.location.href = "/Mazad/pages/HomePage.php";
            </script>';
        exit();
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




