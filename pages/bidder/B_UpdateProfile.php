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
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 60%;
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

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-actions {
            margin-top: 20px;
            text-align: center;
        }

        .form-actions input {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-actions input[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }

        .form-actions input[type="reset"] {
            background-color: #dc3545;
            color: #fff;
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
        <h1>Update Bidder Registration</h1>
        <form action="../../handle/bidder/handleUpdatingProfile.php" method="post">
            <div class="form-group">
                <label for="bidder_name">Bidder Name:</label>
                <input type="text" id="bidder_name" name="bidder_name" value="<?php echo htmlspecialchars($user['bidder_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bidder_email">Email Address:</label>
                <input type="text" id="bidder_email" name="bidder_email" value="<?php echo htmlspecialchars($user['bidder_email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bidder_phone">Phone Number:</label>
                <input type="text" id="bidder_phone" name="bidder_phone" value="<?php echo htmlspecialchars($user['bidder_phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bidder_resident_id_number">Resident ID Number:</label>
                <input type="text" id="bidder_resident_id_number" name="bidder_resident_id_number" value="<?php echo htmlspecialchars($user['bidder_resident_id_number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bidder_resident_card_image">Resident Card (Please upload):</label>
                <input type="file" id="bidder_resident_card_image" name="bidder_resident_card_image" required>
            </div>
            <div class="form-group">
                <label for="bidder_security_question">Security Question:</label>
                <select id="bidder_security_question" name="bidder_security_question" required>
                    <option value="Who is your favorite person?">Who is your favorite person?</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bidder_security_answer">Security Answer:</label>
                <input type="text" id="bidder_security_answer" name="bidder_security_answer" value="<?php echo htmlspecialchars($user['bidder_security_answer']); ?>" required>
            </div>
            <div class="form-actions">
                <input type="submit" name="submit" value="UPDATE">
                <input type="reset" value="CANCEL">
            </div>
        </form>
        <a class="back-link" href="./B_Menu.php">Back To Dashboard</a>
    </div>
</body>

</html>
