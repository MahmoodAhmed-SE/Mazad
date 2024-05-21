<?php
$info = [];
session_start();

// Check if user is logged in
if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
    header('Location: /pages/LoginPage.php');
} else {
    $message = NULL;

    // Check if product_id is provided
    if (empty($_GET['product_id'])) {
        header('Location: ViewListOfSellerProducts.php');
        echo '<script>alert("No bidders for this product yet!")</script>';
        exit();
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
    
    // Fetch product details
    $products_query = $pdo->prepare('SELECT * FROM Products WHERE product_id = :product_id AND bidder_id IS NULL;');
    $products_query->bindParam(':product_id', $product_id);
    $products_query->execute();
    $products = $products_query->fetchAll(PDO::FETCH_ASSOC);

    // Fetch bids for the product
    if (count($products) > 0) {
        foreach ($products as $product) {
            $bids_query = $pdo->prepare('SELECT * FROM Bids WHERE product_id = :product_id ORDER BY bid_price DESC;');
            $bids_query->bindParam(':product_id', $product['product_id']);
            $bids_query->execute();
            $bids = $bids_query->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any bids
            if (count($bids) > 0) {
                foreach ($bids as $bid) {
                    $bidders_query = $pdo->prepare('SELECT * FROM Bidders WHERE bidder_id = :bidder_id;');
                    $bidders_query->bindParam(':bidder_id', $bid['bidder_id']);
                    $bidders_query->execute();
                    $bidder = $bidders_query->fetch(PDO::FETCH_ASSOC);

                    $info[] = array($product, $bid, $bidder);
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
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>List of Bidders</title>
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

        th,
        td {
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

        .message {
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
        }

        .award-link {
            color: #4CAF50;
            text-decoration: none;
        }

        .award-link:hover {
            text-decoration: underline;
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
        <h1>List of Bidders</h1>
        <?php if ($message) : ?>
            <p class="message"><?php echo $message; ?></p>
        <?php else : ?>
            <p class="message">Highest Bidder:</p>
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Bid ID</th>
                    <th>Bidder Name</th>
                    <th>Bid Date</th>
                    <th>Bid Price</th>
                    <th>Award</th>
                </tr>
                <?php foreach ($info as $row) : ?>
                    <tr>
                        <td><?php echo $row[0]['product_id']; ?></td>
                        <td><?php echo $row[0]['product_name']; ?></td>
                        <td><?php echo $row[1]['bid_id']; ?></td>
                        <td><?php echo $row[2]['bidder_name']; ?></td>
                        <td><?php echo $row[1]['bid_date']; ?></td>
                        <td><?php echo $row[1]['bid_price']; ?></td>
                        <td><a class="award-link" href="../../handle/seller/HandleAwardBidder.php?product_id=<?php echo $row[0]['product_id']; ?>&bidder_id=<?php echo $row[2]['bidder_id']; ?>&bid_price=<?php echo $row[1]['bid_price']; ?>&product_name=<?php echo $row[0]['product_name']; ?>">Award</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <a class="back-link" href="./ListOfSellerProducts.php">Back</a>
    </div>
</body>

</html>
