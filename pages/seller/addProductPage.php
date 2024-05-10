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
</style>
</head>

<body style="background-color: #9DC8C6">
<center>
<form action="../../handle/handleAddingProduct.php" method="post" style="width: 688px">
	<table class="auto-style2" style="width: 100%">
		<tr>
			<td class="auto-style4" colspan="2">Publish a product</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Product name:</td>
			<td class="auto-style6">
			<input name="product_name" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="height: 64px; width: 271px">Product 
			Description:</td>
			<td class="auto-style6">
			<textarea name="product_description" style="width: 311px; height: 53px"></textarea></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Product Minimum Auction 
			Price (Omani Rial):</td>
			<td class="auto-style6">
			<input name="product_minimum_bidding_price" style="width: 102px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Product auction 
			starting date:</td>
			<td class="auto-style6">
			<input name="product_start_date" type="text" /></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Product auction ending 
			date:</td>
			<td class="auto-style6">
			<input name="product_last_date" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style1" colspan="2"><br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="submit" type="submit" value="UPDATE" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;<input name="reset" type="reset" value="CANCEL" />&nbsp;</td>
		</tr>
	</table>
</form>

<p class="auto-style5"><a href="S_Menu.php">Back To Menu</a></p>
</center>
</body>

</html>
