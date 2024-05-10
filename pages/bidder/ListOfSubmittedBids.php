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
	<tr>
		<td class="auto-style3" style="width: 385px">Classic Car model 1985</td>
		<td class="auto-style3">1200</td>
		<td class="auto-style3">Lost bid</td>
	</tr>
	</table>

<p>&nbsp;</p>

<p class="auto-style5"><a href="../pages/S_Menu.php">Back To Menu</a></p>
</center>
</body>

</html>
