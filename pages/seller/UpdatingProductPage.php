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
    }

    $product_id = $_GET['product_id'];

    $query = $pdo->prepare('SELECT * FROM Products WHERE product_id = :product_id;');
    $query->bindParam(':product_id', $product_id);

    $query->execute();

    $product = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: /Mazad/pages/LoginPage.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Update Product</title>
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

        form {
            width: 100%;
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

        .submit-button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        .cancel-button {
            display: inline-block;
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .cancel-button:hover {
            background-color: #d32f2f;
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
        <h1>Update product:</h1>
        <form action="../../handle/handleUpdatingProduct.php" method="post">
            <table>
                <tr>
                    <td>Product to update:</td>
                    <td>
                        <input name="product_id" value="<?php echo $product['product_id']; ?>" type="hidden">
                        <strong><?php echo $product['product_name']; ?></strong>
                    </td>
                </tr>
                <tr>
                    <td>Updated Product Name:</td>
                    <td><input name="updated_name" style="width: 200px;" type="text" value="<?php echo $product['product_name']; ?>"></td>
                </tr>
                <tr>
                    <td>Updated Product Description:</td>
                    <td><textarea name="updated_description" style="width: 300px; height: 100px;"><?php echo $product['product_description']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Updated Product Minimum Auction Price (Omani Rial):</td>
                    <td><input name="updated_product_minimum_bidding_price" style="width: 100px;" type="text" value="<?php echo $product['product_minimum_bidding_price']; ?>"> OMR</td>
                </tr>
                <tr>
                    <td>Updated Product Type:</td>
                    <td>
                        <select name="product_type" style="width: 200px;">
                            <?php
                            $q = $pdo->prepare('SELECT * from product_type;');
                            $q->execute();

                            $rows = $q->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($rows as $row) {
                                echo "<option value=" . $row['product_type_id'] . ">" . $row['product_type'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Updated Product Image:</td>
                    <td><input name="product_image" type="file" value="<?php echo $product['product_image']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="submit-button" name="submit" type="submit" value="UPDATE">
                        <input class="cancel-button" name="reset" type="reset" value="CANCEL">
                    </td>
                </tr>
            </table>
        </form>
        <p class="back-link"><a href="./S_Menu.php">Back To Dashboard</a></p>
    </div>
</body>

</html>

