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
}
else {
    header('Location: /Mazad/pages/LoginPage.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seller Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9DC8C6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .title {
            text-align: center;
            font-size: 28px;
            color: #663300;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .action-column {
            width: 202px;
        }

        .action-column a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .action-column a:hover {
            text-decoration: underline;
        }

        .resident-image {
            height: 250px;
            width: 300px;
        }

        .menu-link {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .menu-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .menu-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <p class="title"><strong>View Bidder Details</strong></p>
        <table>
            <tr>
                <th>Contact</th>
                <th>Action</th>
                <th colspan="2">Residency</th>
            </tr>

            <?php
            $pdo = require('../../mysql_db_connection.php');
            $query = $pdo->prepare("SELECT * FROM Bidders WHERE bidder_status=0 and administrator_id is null;");
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>';
                echo '<strong>Bidder ID:</strong> ' . $row['bidder_id'] . '<br>';
                echo '<strong>Bidder Name:</strong> ' . $row['bidder_name'] . '<br>';
                echo '<strong>Bidder Email:</strong> ' . $row['bidder_email'] . '<br>';
                echo '<strong>Bidder Phone:</strong> ' . $row['bidder_phone'] . '</td>';
                echo '<td class="action-column">';
                echo "<a href='../../handle/administrator/handleApproveBidder.php?bid={$row['bidder_id']}' onclick=\"return confirm('Do you want to approve the bidder?');\">Approve</a><br><br>";
                echo "<a href='../../handle/administrator/handleDenyBidder.php?bid={$row['bidder_id']}' onclick=\"return confirm('Do you want to deny the bidder?');\">Deny</a>";
                echo '</td>';
                echo '<td colspan="2">';
                echo '<strong>Resident Card ID:</strong> ' . $row['bidder_resident_id_number'] . '<br>';
                echo '<img class="resident-image" src="../../uploads/card_images/' . $row['bidder_resident_card_image'] . '" alt="Resident Card Image">';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <p class="menu-link"><strong><a href="A_Menu.php">Administrator Dashboard</a></strong></p>
    </div>

</body>

</html>
