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
<title>Update Seller Registration</title>
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
    select {
        width: calc(100% - 10px);
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
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
    <h1>Update Seller Registration</h1>
    <form action="../../handle/seller/handleUpdateSellerProfile.php" method="post" enctype="multipart/form-data">
        <label for="seller_name">Seller Name:</label>
        <input type="text" name="seller_name" id="seller_name" value="<?php echo htmlspecialchars($user['seller_name']); ?>" required>

        <label for="seller_email">Email Address:</label>
        <input type="text" name="seller_email" id="seller_email" value="<?php echo htmlspecialchars($user['seller_email']); ?>" required>

        <label for="seller_phone">Phone Number:</label>
        <input type="text" name="seller_phone" id="seller_phone" value="<?php echo htmlspecialchars($user['seller_phone']); ?>" required>

        <label for="seller_resident_id_number">Resident ID Number:</label>
        <input type="text" name="seller_resident_id_number" id="seller_resident_id_number" value="<?php echo htmlspecialchars($user['seller_resident_id_number']); ?>" required>

        <label for="seller_resident_card_image">Resident Card (Please upload):</label>
        <input type="file" name="seller_resident_card_image" id="seller_resident_card_image" required>

        <label for="seller_security_question">Security Question:</label>
        <select name="seller_security_question" id="seller_security_question" required>
            <option value="favorite_person" selected>Who is your favorite person?</option>
        </select>

        <label for="seller_security_answer">Security Answer:</label>
        <input type="text" name="seller_security_answer" id="seller_security_answer" value="<?php echo htmlspecialchars($user['seller_security_answer']); ?>" required>

        <input type="submit" name="submit" value="UPDATE">
        <input type="reset" name="reset" value="CANCEL">
    </form>

    <div class="back-link">
        <a href="./S_Menu.php">Back To Dashboard</a>
    </div>
</div>

</body>
</html>
