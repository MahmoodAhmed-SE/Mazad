<?php
session_start();

// Redirect if user is not logged in
if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
    header('Location: /pages/LoginPage.php');
    exit;
}

// Fetch products associated with the logged-in user
$id = $_SESSION['user_id'];
$pdo = require('../../mysql_db_connection.php');
$products_query = $pdo->prepare('SELECT * FROM Products WHERE seller_id = :seller_id AND product_status = 1 AND bidder_id IS NULL;');
$products_query->bindParam(':seller_id', $id);
$products_query->execute();
$products = $products_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of Products</title>
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
	a {
		text-decoration: none;
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

    img {
        max-width: 100%;
        height: auto;
    }

    .center {
        text-align: center;
    }

    .no-products {
        font-style: italic;
        text-align: center;
    }

    .no-products a {
        color: #4CAF50;
    }
</style>
</head>
<body>
<div class="container">
    <h1>List of Products</h1>
    <?php if (!empty($products)) : ?>
        <table>
            <tr>
                <th>Details</th>
                <th>Description</th>
                <th>Options</th>
                <th>Image</th>
            </tr>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td>
                        <strong>Name:</strong> <?php echo $product['product_name']; ?><br><br>
                        <strong>Minimum Price:</strong> <?php echo $product['product_minimum_bidding_price']; ?><br><br>
                        <strong>Starting date:</strong> <?php echo date('Y-m-d', strtotime($product['product_start_date'])); ?><br>
                        <strong>Ending date:</strong> <?php echo date('Y-m-d', strtotime($product['product_last_date'])); ?>
                    </td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td class="center">
                        <a href="ViewListOfBidders.php?product_id=<?php echo $product['product_id']; ?>">View&nbsp;Bidders</a><br><br>
                        <a href="AwardBidder.php?product_id=<?php echo $product['product_id']; ?>">Award</a><br><br>
                        <a href="UpdatingProductPage.php?product_id=<?php echo $product['product_id']; ?>">Update</a><br><br>
                        <a href="ClosingProductPage.php?product_id=<?php echo $product['product_id']; ?>">Close</a>
                    </td>
                    <td class="center"><img src="../../uploads/product_images/<?php echo $product['product_image']; ?>" alt="Product Image" width="250"></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="no-products">No Active Products Yet. <a href="AddProductPage.php">Add product here!</a></p>
    <?php endif; ?>
    <p class="center"><a href="./S_Menu.php">Back To Dashboard</a></p>
</div>
</body>
</html>
