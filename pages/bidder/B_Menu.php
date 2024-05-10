<?php

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
	$pdo = require('../../mysql_db_connection.php');
	$id = $_SESSION['user_id'];
	$role = $_SESSION['role'];

	require('../../services/getUser.php');
	
	$user = getUser($pdo, $id, $role);

	if ($user === false) {
		echo "Register first! or you account is pending., return to homepage!";
		exit();
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
<title>LOGIN PAGE</title>
<style type="text/css">
.auto-style1 {
	font-size: x-large;
}
.auto-style2 {
	text-align: center;
	border: 2px solid #000000;
}
.auto-style3 {
	border: 4px solid #800000;
}
.auto-style5 {
	font-size: x-large;
	text-align: left;
}
.auto-style6 {
	color: #FF0000;
}
</style>
</head>

<body style="background-color: #9DC8C6">

<table style="width: 100%">
	<tr>
		<td class="auto-style5" style="width: 537px"><strong>&nbsp;&nbsp; Welcome, <?php echo ucfirst($user['bidder_name']); ?>! </strong>
		</td>
		<td class="auto-style5" style="width: 59px"><strong><br />
		<span class="auto-style6"><a href='../../handle/handleLogout.php'>LOGOUT</a></span><br />
		</strong></td>
	</tr>
</table>
<table class="auto-style3" style="width: 100%">
	<tr>
		<td class="auto-style2" style="width: 537px"><strong>
		<img alt="" height="177" src="../../assets/UpdateProfile.png" width="177" /><br class="auto-style1" />
		</strong><span class="auto-style1"><strong>
		<a href="B_UpdateProfile.php">Update profile</a></strong></span></td>
		<td class="auto-style2"><strong>
		<img alt="" height="177" src="../../assets/AddProduct.png" width="177" /><br class="auto-style1" />
		</strong><span class="auto-style1"><strong>Bid Product</strong></span></td>
	</tr>
	<tr>
		<td class="auto-style2" style="width: 537px"><strong>
		<img alt="" height="177" src="../../assets/ChangePassword.png" width="177" /><br class="auto-style1" />
		</strong><span class="auto-style1"><strong><a href="../ChangePassword.php">Change 
		password</a></strong></span></td>
		<td class="auto-style2"><strong>
		<img alt="" class="auto-style1" height="200" src="../../assets/UpdateProduct.png" width="200" /><br class="auto-style1" />
		</strong><span class="auto-style1"><strong>Update Bid</strong></span></td>
	</tr>
	<tr>
		<td class="auto-style2" style="height: 20px; width: 537px;"><strong>
		<img alt="" height="177" src="../../assets/bidders.png" width="177" /><br class="auto-style1" />
		</strong><span class="auto-style1">
		<a href="ListOfSubmittedBids.php">List of Submitted Bids</a></span></td>
		<td class="auto-style2" style="height: 20px"><span class="auto-style1"><strong>
		<img alt="" height="177" src="../../assets/ViewList.png" width="177" /><br />
		</strong>
		<a href="ListOfProducts.php">Search Products to Bid</a></span></td>
	</tr>
	<tr>
		<td class="auto-style2" style="height: 20px; " colspan="2">
		<strong>
		<img alt="" height="177" src="../../assets/close.png" width="177" /><br />
		</strong><span class="auto-style1"><strong>Cancel Bid</strong></span></td>
	</tr>
	</table>
<p class="auto-style1">&nbsp;</p>

</body>

</html>
