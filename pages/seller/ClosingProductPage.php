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
	
	$query = $pdo->prepare('SELECT * from Products where seller_id = :seller_id;');
	$query->bindParam(':seller_id', $id);
	
	$query->execute();
	
	$products = $query->fetchAll(PDO::FETCH_ASSOC);
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
<form action="../../handle/handleClosingProduct.php" method="post" style="width: 718px">
	<table class="auto-style2" style="width: 100%">
		<tr>
			<td class="auto-style4" colspan="2">Close a product</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Choose a product to 
			Close:</td>
			<td class="auto-style6">
			&nbsp;
			<select name="product" style="width: 122px">
			<?php
			foreach($products as $product) {
				echo '<option value="'. $product['product_id'] .'">' . $product['product_name'] . '</option>';
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">You agree and confirm 
			that your decision of closing this product is final.</td>
			<td class="auto-style6">
			<input checked="checked" name="agreement" value="disagree" type="radio" />I don't agree&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="agreement" value="agree" type="radio" /> I agree</td>
		</tr>
		<tr>
			<td class="auto-style1" colspan="2"><br />
			<input name="submit" type="submit" value="Close Product" />&nbsp;</td>
		</tr>
	</table>
</form>

<p class="auto-style5"><a href="./S_Menu.php">Back To Dashboard</a></p>
</center>
</body>

</html>
