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
} else {
    header('Location: /Mazad/pages/LoginPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
			text-align: center;
        }

        .container {
            max-width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #9DC8C6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .welcome {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .logout-link {
            font-size: 16px;
            color: #FF0000;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            margin-top: 20px;
        }

        .menu-item {
            width: 200px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .menu-item a {
            font-size: 18px;
            color: #333;
            text-decoration: none;
        }

        .menu-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Welcome, <?php echo ucfirst($user['administrator_name']); ?>!</h1>
        <p class="welcome">Please choose an option below:</p>
        <p><a class="logout-link" href="../../handle/handleLogout.php">Logout</a></p>

        <div class="menu">
            <div class="menu-item">
                <img src="../../assets/ChangePassword.png" alt="Change Password">
                <a href="../ChangePassword.php">Change Password</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/ViewList.png" alt="View List">
                <a href="ViewSellerByAdmin.php">List of Sellers for Approval</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/denied-1.png" alt="Denied Sellers">
                <a href="ListOfDeniedSellers.php">List of Denied Sellers</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/approval.png" alt="Approved Sellers">
                <a href="ListOfApprovedSellers.php">List of Approved Sellers</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/bidders.png" alt="Bidders">
                <a href="ViewBidderByAdmin.php">List of Bidders for Approval</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/forbidden.png" alt="Denied Bidders">
                <a href="ListOfDeniedBidders.php">List of Denied Bidders</a>
            </div>
            <div class="menu-item">
                <img src="../../assets/approve.png" alt="Approved Bidders">
                <a href="ListOfApprovedBidders.php">List of Approved Bidders</a>
            </div>
        </div>
    </div>

</body>

</html>
