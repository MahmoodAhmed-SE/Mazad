<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>LOGIN PAGE</title>
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
	font-size: large;
}
.auto-style6 {
	font-size: x-large;
}
</style>
</head>

<body style="background-color: #9DC8C6">
<center>

<form action="../handle/handleLoginForm.php" method="post" style="width: 479px">
	<table class="auto-style3" style="width: 100%">
		<tr>
			<td class="auto-style1" colspan="2"><strong>LOGIN PAGE</strong></td>
		</tr>
		<tr>
			<td class="auto-style4">Name</td>
			<td class="auto-style2">
			<input name="name" style="width: 186px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4">Password</td>
			<td class="auto-style2">
			<input name="password" style="width: 187px" type="password" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style4">Role:</td>
			<td class="auto-style2">
			<input checked="checked" name="role" type="radio" class="auto-style5" value="seller" /><span class="auto-style5">Seller
			</span>
			<input name="role" type="radio" class="auto-style5" value="bidder"/><span class="auto-style5" >Bidder
			</span>
			<input name="role" type="radio" class="auto-style5" value="admin"/><span class="auto-style5">Administrator</span></td>
		</tr>
		<tr>
			<td class="auto-style2" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="submitButton" type="submit" value="LOG-IN" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="resetButton" type="reset" value="CANCEL" />&nbsp;</td>
		</tr>
	</table>
</form>
<p class="auto-style6"><a href="../pages/ForgetPassword.php">Forget Password</a></p>
</center>
</body>

</html>
