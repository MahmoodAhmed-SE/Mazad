<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');
    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../../services/getUser.php');
    
    $user = getUser($pdo, $id, $role);

    if ($user === false) {
        header('Location: /Mazad/pages/LoginPage.php');
        exit();
    }

    $query = $pdo->prepare('SELECT * FROM Bids WHERE bidder_id = :bidder_id;');
    $query->bindParam(':bidder_id', $id);
    $query->execute();

    $bidder_bids = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($bidder_bids as &$bid) {
        $q = $pdo->prepare('SELECT product_name FROM Products WHERE product_id = :product_id');
        $q->bindParam(':product_id', $bid['product_id']);
        $q->execute();

        $product = $q->fetch(PDO::FETCH_ASSOC);
        
        $bid['product_name'] = $product['product_name'];
        
        if (isset($product['bidder_id'])) {
            if ($product['bidder_id'] == $id) {
                $bid['bid_status'] = "Approved";
            } else {
                $bid['bid_status'] = "Denied";
            }
        } else {
            $bid['bid_status'] = "Active";
        }
    }
    unset($bid);
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
    <title>List of Submitted Bids</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List of Submitted Bids</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Bid Price</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
            <?php foreach ($bidder_bids as $info) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($info['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($info['bid_price']); ?> OMR</td>
                    <td><?php echo htmlspecialchars($info['bid_status']); ?></td>
                    <td>
                        <a href="UpdateBid.php?bid_id=<?php echo $info['bid_id']; ?>&product_name=<?php echo $info['product_name']; ?>&bid_price=<?php echo $info['bid_price']; ?>">Update</a> / 
                        <a href="../../handle/bidder/handleCancelingBid.php?bid_id=<?php echo $info['bid_id']; ?>">Close</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a class="back-link" href="./B_Menu.php">Back To Dashboard</a>
    </div>
</body>

</html>
