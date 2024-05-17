<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../mysql_db_connection.php');
    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../services/getUser.php');

    $user = getUser($pdo, $id, $role);

    if ($user === false) {
        header('Location: /Mazad/pages/LoginPage.php');
        exit;
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
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="submit"],
        .form-group input[type="reset"] {
            width: 48%;
            cursor: pointer;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group input[type="reset"] {
            background-color: #f44336;
            color: #fff;
            border: none;
        }

        .form-group input[type="reset"]:hover {
            background-color: #e53935;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .back-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Change Password</h1>
        <form action="../handle/handleChangingPassword.php" method="post">
            <div class="form-group">
                <label for="password">Current Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="retype_new_password">Re-type New Password</label>
                <input type="password" name="retype_new_password" id="retype_new_password" required>
            </div>
            <div class="form-group" style="display: flex; justify-content: space-between;">
                <input type="submit" name="submit" value="Change">
                <input type="reset" name="reset" value="Cancel">
            </div>
        </form>
        <div class="back-link">
            <p><a href="../pages/LoginPage.php">Log-in Page</a></p>
        </div>
    </div>
</body>

</html>
