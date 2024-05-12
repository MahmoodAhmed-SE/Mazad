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
<title></title>
<style type="text/css">
.auto-style1 {
	border: 2px solid #000000;
}
.auto-style2 {
	border: 4px solid #800000;
}
.auto-style3 {
	font-size: large;
	border: 2px solid #000000;
}
.auto-style4 {
	font-size: x-large;
	text-align: center;
	border: 2px solid #000000;
}
.auto-style5 {
	font-size: x-large;
}
.auto-style6 {
	border: 2px solid #000000;
	text-align: left;
}
.auto-style7 {
	font-size: large;
	border: 2px solid #000000;
	direction: ltr;
}
</style>
</head>

<body style="background-color: #9DC8C6">
<center>
<form action="../../handle/bidder/handleCancelingBid.php" method="post" style="width: 688px">
	<table class="auto-style2" style="width: 100%">
		<tr>
			<td class="auto-style4" colspan="2">Cancel a bid</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Choose the bid to 
			cancel:</td>
			<td class="auto-style6">
			&nbsp;
			<select name="bid_id" style="width: 184px">
			<?php
			foreach($bidder_bids_with_product_info as $info) {
				echo '<option value="' . $info[0]['bid_id'] . '">' . $info[1] . '</option>';
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td class="auto-style1" colspan="2"><br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="submit" type="submit" value="Approve" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;<input name="Reset1" type="reset" value="CANCEL" />&nbsp;</td>
		</tr>
	</table>
</form>

<p class="auto-style5"><a href="./B_Menu.php">Back To Dashboard</a></p>
</center>
</body>

</html>
