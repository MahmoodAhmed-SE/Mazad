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

    $product_id = $_GET['product_id'] ?? null;

    if ($product_id) {
        $query = $pdo->prepare('SELECT * FROM PRODUCTS WHERE product_id = :product_id');
        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $query->execute();

        $product = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        header('Location: /Mazad/pages/Dashboard.php');
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
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-details img {
            height: 100%;
            border-radius: 8px;
        }

        .product-details div {
            font-size: 18px;
        }

        .product-details label {
            font-weight: bold;
        }

        .product-details input[type="number"],
        .product-details input[type="submit"] {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 10px;
        }

        .product-details input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .product-details input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Product Details</h1>
    <div class="product-details">
        <div>
            <label>Product Name:</label>
            <span><?php echo $product['product_name']; ?></span>
        </div>
        <div>
            <label>Minimum Bidding Amount:</label>
            <span><?php echo $product['product_minimum_bidding_price']; ?> OMR</span>
        </div>
        <div>
            <label>Description:</label>
            <span><?php echo $product['product_description']; ?></span>
        </div>
        <div>
            <label>Bidding Start Date:</label>
            <span><?php echo $product['product_start_date']; ?></span>
        </div>
        <div>
            <label>Bidding End Date:</label>
            <span><?php echo $product['product_last_date']; ?></span>
        </div>
        <div>
            <label>Product Image:</label>
            <img src="../../uploads/product_images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100%">
        </div>
        <form action="../../handle/bidder/handleBiddingOnProduct.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <div>
                <label for="bid_price">Bidding Amount (OMR):</label>
                <input type="number" name="bid_price" id="bid_price" required value="<?php echo $product['product_minimum_bidding_price']; ?>" min="<?php echo $product['product_minimum_bidding_price']; ?>">
            </div>
            <div>
                <input type="submit" name="submit" value="Bid">
            </div>
        </form>
    </div>
    <div class="back-link">
        <p><a href="./B_Menu.php">Back To Dashboard</a></p>
    </div>
</div>

</body>
</html>
