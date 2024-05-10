<?php
	session_start();
	$products = NULL;
	
	if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
		header('Location: /pages/LoginPage.php');
	}
	else {

		$id = $_SESSION['user_id'];
		$role = $_SESSION['role'];

		$pdo = require('../../mysql_db_connection.php');

		$products_query = $pdo->prepare('SELECT * FROM Products WHERE seller_id = :seller_id;');
		$products_query->bindParam(':seller_id', $id);
		$products_query->execute();
		$products = $products_query->fetchAll(PDO::FETCH_ASSOC);
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
<h1 class="auto-style1">LIST OF PRODUCTS</h1>
&nbsp;<table style="width: 100%" class="auto-style4">
	<tr>
		<td class="auto-style2"><strong>Product Status</strong></td>
		<td class="auto-style2"><strong>Product Name</strong></td>
		<td class="auto-style2"><strong>Product Description</strong></td>
		<td class="auto-style2"><strong>Product Minimum Price</strong></td>
		<td class="auto-style2"><strong>Product starting Date</strong></td>
		<td class="auto-style2"><strong>Product ending date</strong></td>
	</tr>
	<?php
	foreach($products as $product) {
		echo '<tr>';
		echo 	'<td class="auto-style3">' . $product['product_status'] . '</td>';
		echo 	'<td class="auto-style3">' . $product['product_name'] . '</td>';
		echo 	'<td class="auto-style3">' . $product['product_description'] . '</td>';
		echo 	'<td class="auto-style3">' . $product['product_minimum_bidding_price'] . '</td>';
		echo 	'<td class="auto-style3">' . $product['product_start_date'] . '</td>';
		echo 	'<td class="auto-style3">' . $product['product_last_date'] . '</td>';
		echo '</tr>';
	}

	?>
	
	</table>

<p>&nbsp;</p>

<p class="auto-style5"><a href="../../pages/S_Menu.php">Back To Menu</a></p>
</center>
</body>

</html>
