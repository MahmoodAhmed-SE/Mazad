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
<title>Enter Full Name</title>
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
</style>
</head>

<body style="background-color: #9DC8C6">
<center>
<form action="../../handle/seller/handleUpdateSellerProfile.php" method="post" style="width: 688px">
	<table class="auto-style2" style="width: 100%">
		<tr>
			<td class="auto-style4" colspan="2"><strong>Update Seller Registration</strong></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Seller Name:</td>
			<td class="auto-style1">
			<input name="seller_name" style="width: 246px" type="text" value="<?php echo $user['seller_name']; ?>" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="height: 64px; width: 271px">Email 
			Address:</td>
			<td class="auto-style1">
			<input name="seller_email" style="width: 243px" type="text" value="<?php echo $user['seller_email']; ?>"/>&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Phone Number:</td>
			<td class="auto-style1">
			<input name="seller_phone" style="width: 242px" type="text" value="<?php echo $user['seller_phone']; ?>" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Resident ID Number:</td>
			<td class="auto-style1">
			<input name='seller_resident_id_number' style="width: 172px" type="text" value="<?php echo $user['seller_resident_id_number']; ?>"/>&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Resident Card <em>
			(Please upload)</em>:</td>
			<td class="auto-style1">
			<input name="seller_resident_card_image" style="width: 305px" type="file" value="<?php echo $user['seller_resident_card_image']; ?>"/></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Security Question:</td>
			<td class="auto-style1">
			<select name="seller_security_question" style="width: 407px">
			<option value="<?php echo $user['seller_security_question']; ?>">Who is your favorite person?
			</option>
			</select></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Security Answer:</td>
			<td class="auto-style1">
			<input name="seller_security_answer" type="text" style="width: 225px" value="<?php echo $user['seller_security_answer']; ?>"/></td>
		</tr>
		<tr>
			<td class="auto-style1" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
			<input name="submit" type="submit" value="UPDATE" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;<input name="reset" type="reset" value="CANCEL" />&nbsp;</td>
		</tr>
	</table>
</form>

<p class="auto-style5"><a href="./S_Menu.php">Back To Dashboard</a></p>
</center>
</body>

</html>