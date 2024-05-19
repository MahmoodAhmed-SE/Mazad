<?php
session_start();

if (isset($_SESSION['user_id'], $_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');
    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../../services/getUser.php');

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
    <title>Publish a Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        form {
            width: 100%;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        select,
        textarea {
            width: calc(100% - 10px);
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="date"] {
            width: 100%;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            font-size: 18px;
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
    <h1>Publish a Product</h1>
    <form action="../../handle/seller/handleAddingProduct.php" method="post" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea name="product_description" id="product_description" rows="4" required></textarea>

        <label for="product_minimum_bidding_price">Product Minimum Auction Price (Omani Rial):</label>
        <input type="text" name="product_minimum_bidding_price" id="product_minimum_bidding_price" required>

        <label for="product_type">Product Type:</label>
        <select name="product_type_id" id="product_type" required>
            <?php
            $q = $pdo->prepare('SELECT * from product_type;');
            $q->execute();

            $rows = $q->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo "<option value=" . $row['product_type_id'] . ">" . $row['product_type'] . "</option>";
            }
            ?>
        </select>

        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" id="product_image" required>

        <label for="product_start_date">Product Auction Starting Date:</label>
        <input type="date" name="product_start_date" id="product_start_date" value='<?php echo date('Y-m-d'); ?>' readonly>

        <label for="product_last_date">Product Auction Ending Date:</label>
        <input type="date" name="product_last_date" id="product_last_date" required>

        <input type="submit" name="submit" value="Add">
        <input type="reset" name="reset" value="CANCEL">
    </form>

    <div class="back-link">
        <a href="./S_Menu.php">Back To Dashboard</a>
    </div>
</div>

</body>
</html>
