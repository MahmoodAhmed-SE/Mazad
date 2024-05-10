<?php
	session_start();

	if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
		header('Location: /pages/LoginPage.php');
	}
	else {
		$info[] = array();

		$id = $_SESSION['user_id'];
		$role = $_SESSION['role'];

		$pdo = require('../mysql_db_connection.php');

		$products_query = $pdo->prepare('SELECT * FROM Products WHERE seller_id = :seller_id;');
		$products_query->bindParam(':seller_id', $id);
		$products_query->execute();
		$products = $products_query->fetchAll(PDO::FETCH_ASSOC);


		foreach ($products as $product) {
			$bids_query = $pdo->prepare('SELECT * FROM Bids WHERE product_id = :product_id;');
			$bids_query->bindParam(':product_id', $product['product_id']);
			$bids_query->execute();
			$bids = $bids_query->fetchAll(PDO::FETCH_ASSOC);

			foreach ($bids as $bid) {
				$bids_query = $pdo->prepare('SELECT * FROM Bidders WHERE bidder_id = :bidder_id;');
				$bids_query->bindParam(':bidder_id', $bid['bidder_id']);
				$bids_query->execute();
				$bidder = $bids_query->fetch(PDO::FETCH_ASSOC);

				$info[] = array($product, $bid, $bidder);
			}
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Forget Password</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	font-size: x-large;
	text-align: center;
	border: 2px solid #000000;
}
.auto-style3 {
	font-size: large;
	text-align: center;
	border: 2px solid #000000;
}
.auto-style4 {
	border: 4px solid #800000;
}
.auto-style5 {
	font-size: x-large;
}
</style>
</head>

<body style="background-color: #9DC8C6">

<center>
<h1 class="auto-style1">LIST OF BIDDERS</h1>
&nbsp;<table style="width: 100%" class="auto-style4">
	<tr>
		<td class="auto-style2"><strong>Product ID</strong></td>
		<td class="auto-style2"><strong>Product Name</strong></td>
		<td class="auto-style2"><strong>Bid ID</strong></td>
		<td class="auto-style2"><strong>Bidder Name</strong></td>
		<td class="auto-style2"><strong>Bid Date</strong></td>
		<td class="auto-style2"><strong>Bid Price</strong></td>
	</tr>
	<?php
	
	foreach ($info as $row) {
		echo '<tr>';
		echo 	'<td class="auto-style3">' . $row[0]['product_id'] . '</td>';
		echo 	'<td class="auto-style3">' . $row[0]['product_name'] . '</td>';
		echo 	'<td class="auto-style3">' . $row[1]['bid_id'] . '</td>';
		echo 	'<td class="auto-style3">' . $row[2]['bidder_name'] . '</td>';
		echo 	'<td class="auto-style3">' . $row[1]['bid_date'] . '</td>';
		echo 	'<td class="auto-style3">' . $row[1]['bid_price'] . '</td>';
		echo '</tr>';
	}
	?>

</table>

<p>&nbsp;</p>

<p class="auto-style5"><a href="../pages/S_Menu.php">Back To Menu</a></p>
</center>
</body>

</html>
