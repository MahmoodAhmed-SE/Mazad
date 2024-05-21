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
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Update Bid</title>
    <style type="text/css">
        body {
            background-color: #9DC8C6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .center {
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input[type="text"], 
        .input-group input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
        }

        .back-link:hover {
            color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Bid</h1>
        <form action="../../handle/bidder/handleUpdateBid.php" method="post">
            <div class="input-group">
                <label for="product_name">Product bid to update:</label>
                <input type="hidden" name="bid_id" value="<?php echo $_GET['bid_id']; ?>">
                <strong><?php echo $_GET['product_name']; ?></strong>
            </div>
            <div class="input-group">
                <label for="bid_price">Updated bidding price:</label>
                <input id="bid_price" name="bid_price" type="number" value="<?php echo $_GET['bid_price']; ?>" min="<?php echo $_GET['bid_price']; ?>">
            </div>
            <div class="center">
                <input class="button" name="submit" type="submit" value="UPDATE">
                <input class="button" name="reset" type="reset" value="CANCEL">
            </div>
        </form>
        <a class="back-link" href="./B_Menu.php">Back To Dashboard</a>
    </div>
</body>

</html>
