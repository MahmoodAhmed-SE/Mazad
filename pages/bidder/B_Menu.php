<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');
    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../../services/getUser.php');
    
    $user = getUser($pdo, $id, $role);

    if ($user === false) {
        echo "Register first! or your account is pending. Return to homepage!";
        exit();
    }

} else {
    header('Location: /Mazad/pages/LoginPage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
			background-color: #fff;
            margin: 0;
            padding: 0;
        }
		
        .container {
			max-width: 90%;
            margin: 0 auto;
            padding: 20px;
			background-color: #9DC8C6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .welcome-message {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .logout-link {
            font-size: 16px;
            color: #FF0000;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        .dashboard-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            margin-top: 20px;
        }

        .dashboard-option {
            width: 200px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-option img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .dashboard-option a {
            font-size: 18px;
            color: #333;
            text-decoration: none;
        }

        .dashboard-option a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Welcome, <?php echo ucfirst($user['bidder_name']); ?>!</h1>
    <p class="welcome-message">Please choose an option below:</p>
    <p><a class="logout-link" href="../../handle/handleLogout.php">Logout</a></p>

    <div class="dashboard-options">
        <div class="dashboard-option">
            <img src="../../assets/UpdateProfile.png" alt="Update Profile">
            <a href="B_UpdateProfile.php">Update Profile</a>
        </div>
        <div class="dashboard-option">
            <img src="../../assets/ChangePassword.png" alt="Change Password">
            <a href="../ChangePassword.php">Change Password</a>
        </div>
        <div class="dashboard-option">
            <img src="../../assets/ViewList.png" alt="Search Products to Bid">
            <a href="ListOfProducts.php">Search Products to Bid</a>
        </div>
        <div class="dashboard-option">
            <img src="../../assets/bidders.png" alt="List of Submitted Bids">
            <a href="ListOfSubmittedBids.php">List of Submitted Bids</a>
        </div>
    </div>
</div>

</body>

</html>
