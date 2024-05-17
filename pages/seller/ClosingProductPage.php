<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $pdo = require('../../mysql_db_connection.php');

    $id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    require('../../services/getUser.php');

    $user = getUser($pdo, $id, $role);

    // Redirect if user is not valid
    if ($user === false) {
        header('Location: /Mazad/pages/LoginPage.php');
    }

    // Fetch product details
    $product_id = $_GET['product_id'];
    $query = $pdo->prepare('SELECT * from Products where product_id = :product_id;');
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
    <title>Close Product</title>
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

        .radio-label {
            margin-right: 20px;
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
        <h1>Close Product</h1>
        <form action="../../handle/seller/handleClosingProduct.php" method="post" style="width: 100%">
            <table>
                <tr>
                    <td style="width: 30%;">Product to Close:</td>
                    <td>
                        <?php echo '<input type="hidden" name="product_id" value="' . $product['product_id'] . '">'; ?>
                        <strong><?php echo $product['product_name']; ?></strong>
                    </td>
                </tr>
                <tr>
                    <td>You agree and confirm that your decision of closing this product is final.</td>
                    <td>
                        <label class="radio-label">
                            <input checked="checked" name="agreement" value="disagree" type="radio" />I don't agree
                        </label>
                        <label class="radio-label">
                            <input name="agreement" value="agree" type="radio" />I agree
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center">
                        <input class="button" name="submit" type="submit" value="Close Product" />
                    </td>
                </tr>
            </table>
        </form>
        <a class="back-link" href="./S_Menu.php">Back To Dashboard</a>
    </div>
</body>

</html>
