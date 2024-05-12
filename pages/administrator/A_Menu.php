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
.auto-style7 {
	text-align: center;
	border: 2px solid #000000;
	font-size: x-large;
}
</style>
</head>

<body style="background-color: #9DC8C6">

<table style="width: 100%">
	<tr>
		<td class="auto-style5" style="width: 537px"><strong>&nbsp;&nbsp; Welcome, <?php echo ucfirst($user['administrator_name']); ?>!</strong>
		</td>
		<td class="auto-style5" style="width: 59px"><strong><br />
		<span class="auto-style6">LOGOUT</span><br />
		</strong></td>
	</tr>
</table>
<table class="auto-style3" style="width: 100%">
	<tr>
		<td class="auto-style2"><strong>
		<br class="auto-style1" />
		<img alt="" height="177" src="../../ChangePassword.png" width="177" /><br class="auto-style1" />
		<span class="auto-style1">Change 
		password</span></strong></td>
		<td class="auto-style2">&nbsp;</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style7"><strong>
		<img alt="" height="177" src="ViewList.png" width="177" /><br />
		<a href="ViewSellerByAdmin.php">List of Sellers</a> for Approval</strong></td>
		<td class="auto-style7">List of Approved Sellers</td>
		<td class="auto-style7">List of Denied Sellers</td>
	</tr>
	<tr>
		<td class="auto-style2" style="height: 20px; "><strong>
		<img alt="" height="177" src="bidders.png" width="177" /><br class="auto-style1" />
		</strong><span class="auto-style1">
		<strong><a href="ViewBidderByAdmin.php">List of Bidders</a> for Approval</strong></span></td>
		<td class="auto-style2" style="height: 20px; ">List of Approved Bidders</td>
		<td class="auto-style2" style="height: 20px; ">List of Denied Bidders</td>
	</tr>
	</table>

</body>

</html>
