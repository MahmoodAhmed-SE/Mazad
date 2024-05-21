<?php
$info = array();
session_start();

if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
    header('Location: /pages/LoginPage.php');
    exit;
} else {
    $message = null;

    if (empty($_GET['product_id'])) {
        header('Location: ViewListOfSellerProducts.php');
        exit;
    }

    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    $product_id = $_GET['product_id'];

    $pdo = require('../../mysql_db_connection.php');

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
    
    $products_query = $pdo->prepare('SELECT * FROM Products WHERE product_id = :product_id;');
    $products_query->bindParam(':product_id', $product_id);
    $products_query->execute();
    $products = $products_query->fetchAll(PDO::FETCH_ASSOC);

    if (count($products) > 0) {
        foreach ($products as $product) {
            $bids_query = $pdo->prepare('SELECT * FROM Bids WHERE product_id = :product_id;');
            $bids_query->bindParam(':product_id', $product['product_id']);
            $bids_query->execute();
            $bids = $bids_query->fetchAll(PDO::FETCH_ASSOC);

            if (count($bids) > 0) {
                foreach ($bids as $bid) {
                    $bidder_query = $pdo->prepare('SELECT * FROM Bidders WHERE bidder_id = :bidder_id;');
                    $bidder_query->bindParam(':bidder_id', $bid['bidder_id']);
                    $bidder_query->execute();
                    $bidder = $bidder_query->fetch(PDO::FETCH_ASSOC);

                    $info[] = array(
                        'product_id' => $product['product_id'],
                        'product_name' => $product['product_name'],
                        'bid_id' => $bid['bid_id'],
                        'bidder_name' => $bidder['bidder_name'],
                        'bid_date' => $bid['bid_date'],
                        'bid_price' => $bid['bid_price']
                    );
                }
            } else {
                $message = "No bidders yet!";
            }
        }
    } else {
        $message = "No products published yet!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Bidders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-data {
            font-style: italic;
            text-align: center;
            margin-bottom: 20px;
        }

        .no-data a {
            color: #4CAF50;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>List of Bidders</h1>
    <?php if ($message) : ?>
        <p class="no-data"><?php echo $message; ?></p>
    <?php else : ?>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Bid ID</th>
                <th>Bidder Name</th>
                <th>Bid Date</th>
                <th>Bid Price</th>
            </tr>
            <?php foreach ($info as $row) : ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['bid_id']; ?></td>
                    <td><?php echo $row['bidder_name']; ?></td>
                    <td><?php echo $row['bid_date']; ?></td>
                    <td><?php echo $row['bid_price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <p class="no-data"><a href="./ListOfSellerProducts.php">Back</a></p>
</div>
</body>
</html>
