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
	}

	$query = $pdo->prepare('SELECT * FROM Bids WHERE bidder_id = :bidder_id');
	$query->bindParam(':bidder_id', $id);
	$query->execute();


	$bidder_bids = $query->fetchAll(PDO::FETCH_ASSOC);
	
	$bidder_bids_with_product_info[] = array();

	foreach ($bidder_bids as $bid) {
		$q = prepare('SELECT product_name FROM Products WHERE product_id = :product_id');
		$q->bindParam(':product_id', $bid['product_id']);
		$q->exectute();

		$product_name = $q->fetch(PDO::FETCH_ASSOC);
		$product_name = $product_name['product_name'];
		
		$bidder_bids_with_product_info[] = array($bidder_bids, $product_name);
	}
}
else {
	header('Location: /Mazad/pages/LoginPage.php');
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
<h1 class="auto-style1">LIST OF BIDS SUBMITED</h1>
&nbsp;<table style="width: 100%" class="auto-style4">
	<tr>	
		<td class="auto-style2" style="width: 385px">Product name</td>
		<td class="auto-style2">Bid Price</td>
		<td class="auto-style2">Status</td>
	</tr>
	<?php
	foreach ($bidder_bids_with_product_info as $info) {
		echo '<tr>';
		echo '	<td class="auto-style2" style="width: 385px">' . $info[1] . '</td>';
		echo '	<td class="auto-style2">' . $info[0]['bid_price'] . '</td>';
		echo '	<td class="auto-style2">Not decided yet!</td>';
		echo '</tr>';
	}
	?>
	</table>

<p>&nbsp;</p>

<p class="auto-style5"><a href="./B_Menu.php">Back To Dashboard</a></p>
</center>
</body>

</html>
