<?php
session_start();
    
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
	$pdo = require('../mysql_db_connection.php');
	$id = isset($_SESSION['user_id']);
	$role = isset($_SESSION['role']);
	
	require('../services/getUser.php');

	$user = getUser($pdo, $id, $role);
	
	
	if ($user === false) {
		header('Location: /Mazad/pages/LoginPage.php');
	}
} else {
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
	font-size: x-large;
	border: 2px solid #000000;
}
.auto-style2 {
	border: 2px solid #000000;
}
.auto-style3 {
	border: 4px solid #800000;
}
.auto-style4 {
	font-size: large;
	border: 2px solid #000000;
}
.auto-style5 {
	font-size: x-large;
}
</style>
</head>

<body style="background-color: #9DC8C6">
<center>
<form action="../handle/handleChangingPassword.php" method="post" style="width: 480px">
	<table class="auto-style3" style="width: 100%">
		<tr>
			<td class="auto-style1" colspan="2"><strong>Change Password</strong></td>
		</tr>
		<tr>
			<td class="auto-style4">Current Password</td>
			<td class="auto-style2">
			<input name="password" style="width: 180px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4">New Password</td>
			<td class="auto-style2">
			<input name="new_password" style="width: 181px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4">Re-type New Password</td>
			<td class="auto-style2">
			<input name="retype_new_password" style="width: 181px" type="text" /></td>
		</tr>
		<tr>
			<td class="auto-style2" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
			<input name="submit" type="submit" value="CHANGE" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="reset" type="reset" value="CANCEL" /></td>
		</tr>
	</table>
</form>
<p class="auto-style5"><a href="../pages/LoginPage.php">Log-in Page</a></p>
</center>
</body>

</html>
