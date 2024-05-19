<?php
session_start();
$products = NULL;

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');
    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    
    require('../../services/getUser.php');
    
    $user = getUser($pdo, $id, $role);
    
    if ($user === false) {
        header('Location: /Mazad/pages/LoginPage.php');
    }

    $q = $pdo->prepare('SELECT product_id FROM Bids WHERE bidder_id = :bidder_id');
    $q->bindParam(':bidder_id', $id);
    $q->execute();

    $bids = $q->fetchAll(PDO::FETCH_ASSOC);
    
    $ids[] = array();
    foreach ($bids as $bid) {
        $ids[$bid['product_id']] = true;
    }

    if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        $product_type_id = isset($_POST['product_type_id']) && $_POST['product_type_id'] != 'all' ? $_POST['product_type_id'] : null;

        if (!empty($searchTerm)) {
            if (!empty($product_type_id)) {
                $stmt = $pdo->prepare('SELECT * FROM Products WHERE product_name LIKE :searchTerm AND product_type_id = :product_type_id');
                $stmt->bindValue(':product_type_id', $product_type_id);
            } else {
                $stmt = $pdo->prepare('SELECT * FROM Products WHERE product_name LIKE :searchTerm');
            }
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        } else {
            if (!empty($product_type_id) && $product_type_id != 'all') {
                $stmt = $pdo->prepare('SELECT * FROM Products WHERE product_type_id = :product_type_id');
                $stmt->bindValue(':product_type_id', $product_type_id);
            } else {
                $stmt = $pdo->prepare('SELECT * FROM Products');
            }
        }
        
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $products_query = $pdo->prepare('SELECT * FROM Products WHERE bidder_id is null;');
        $products_query->execute();
        $products = $products_query->fetchAll(PDO::FETCH_ASSOC);
    }

    foreach($products as $key => $product) {
        if (isset($ids[$product['product_id']]) && $ids[$product['product_id']] == true) {
            unset($products[$key]);
        }
    }
} else {
    header('Location: /Mazad/pages/LoginPage.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #9DC8C6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"],
        .search-form select {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .product-item {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .product-item img {
            max-width: 100%;
            height: auto;
        }

        .product-item h2 {
            margin-top: 10px;
            font-size: 18px;
        }

        .no-products {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #666;
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
    <h1>Search Products</h1>
    <form class="search-form" method="POST">
        <input type="text" name="search" placeholder="Search for a product...">
        <select name="product_type_id">
            <option value="all">All</option>
            <?php 
            $q = $pdo->prepare('SELECT * FROM PRODUCT_TYPE;');
            $q->execute();
            $types = $q->fetchAll(PDO::FETCH_ASSOC);
            foreach($types as $type) {
                echo '<option value="' . $type['product_type_id'] . '">' . $type['product_type'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Search">
        <input type="submit" name="show_all" value="Show All">
    </form>


    <div class="product-list">
        <?php if ($products && count($products) > 0) : ?>
            <?php foreach ($products as $product) : ?>
				<div class="product-item">
					<img src="../../uploads/product_images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="300">
					<a href='bidProduct.php?product_id=<?php echo $product['product_id']; ?>'>
						<h2><?php echo $product['product_name']; ?></h2>
					</a>
				</div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="no-products">No products found. Try a different search.</p>
        <?php endif; ?>
        
    </div>
    <center><a class="back-link" href="./B_Menu.php">Back To Dashboard</a></center>
</div>

</body>
</html>
