<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');

    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../../services/getUser.php');

    $user = getUser($pdo, $id, $role);

    // Redirect to login page if user is not found
    if ($user === false) {
        header('Location: /Mazad/pages/LoginPage.php');
        exit;
    }

    // Get bid details from GET parameters
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $bidder_id = $_GET['bidder_id'];
    $bid_price = $_GET['bid_price'];

    // Fetch bidder details
    $query = $pdo->prepare('SELECT * FROM Bidders WHERE bidder_id = :bidder_id;');
    $query->bindParam(':bidder_id', $bidder_id);
    $query->execute();
    $bidder = $query->fetch(PDO::FETCH_ASSOC);


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
    <title>Bidder Contact Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 10px;
        }
        .back-link {
            margin-top: 30px;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Awarded successfully to <?php echo $bidder['bidder_name']; ?></h1>
        <div class="details">
            <p><strong>Product Name:</strong> <?php echo $product_name; ?></p>
            <p><strong>Bid Price:</strong> <?php echo $bid_price; ?></p>
            <p><strong>Bidder Name:</strong> <?php echo $bidder['bidder_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $bidder['bidder_email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $bidder['bidder_phone']; ?></p>
            
        </div>
        <br><br>
        <center><a class="back-link" href="./S_Menu.php">Back To Dashboard</a></center>
    </div>
</body>
</html>
