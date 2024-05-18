<?php
session_start();
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
        <p class="title"><strong>View Seller Details</strong></p>
        <table>
            <tr>
                <th>Contact</th>
                <th>Action</th>
                <th colspan="2">Residency</th>
            </tr>

            <?php
            $pdo = require('../../mysql_db_connection.php');
            $query = $pdo->prepare("SELECT * FROM Sellers WHERE seller_status=0 and administrator_id is null;");
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>';
                echo '<strong>Seller ID:</strong> ' . $row['seller_id'] . '<br>';
                echo '<strong>Seller Name:</strong> ' . $row['seller_name'] . '<br>';
                echo '<strong>Seller Email:</strong> ' . $row['seller_email'] . '<br>';
                echo '<strong>Seller Phone:</strong> ' . $row['seller_phone'] . '</td>';
                echo '<td class="action-column">';
                echo "<a href='../../handle/administrator/handleApproveSeller.php?sid={$row['seller_id']}' onclick=\"return confirm('Do you want to approve the seller?');\">Approve</a><br><br>";
                echo "<a href='../../handle/administrator/handleDenySeller.php?sid={$row['seller_id']}' onclick=\"return confirm('Do you want to deny the seller?');\">Deny</a>";
                echo '</td>';
                echo '<td colspan="2">';
                echo '<strong>Resident Card ID:</strong> ' . $row['seller_resident_id_number'] . '<br>';
                echo '<img class="resident-image" src="../../uploads/card_images/' . $row['seller_resident_card_image'] . '" alt="Resident Card Image">';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <p class="menu-link"><strong><a href="A_Menu.php">Administrator Dashboard</a></strong></p>
    </div>

</body>

</html>
