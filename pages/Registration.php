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
	font-size: large;
}
.auto-style6 {
	font-size: x-large;
}
.auto-style7 {
	border: 2px solid #000000;
	text-align: left;
}
</style>
</head>

<body style="background-color: #9DC8C6">
<center>
<form action="../handle/handleRegistrationForm.php" method="post" enctype="multipart/form-data" style="width: 690px">
	<table class="auto-style2" style="width: 100%">
		<tr>
			<td class="auto-style4" colspan="2"><strong>Registration</strong></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Name:</td>
			<td class="auto-style7">
			<input name="name" style="width: 246px" type="text" required/>&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Password:</td>
			<td class="auto-style7">
			<input name="password" style="width: 245px" type="text" required />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="height: 64px; width: 271px">Email 
			Address:</td>
			<td class="auto-style7">
			<input name="email" style="width: 243px" type="email" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Phone Number:</td>
			<td class="auto-style7">
			<input name="phoneNumber" style="width: 242px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Resident ID Number:</td>
			<td class="auto-style7">
			<input name="idNumber" style="width: 172px" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Resident Card <em>
			(Please upload)</em>:</td>
			<td class="auto-style7">
			<input name="residentCard" style="width: 305px" type="file" /></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Security Question:</td>
			<td class="auto-style1">
			<select name="securityQuestion" style="width: 407px">
			<option value="Who is your favorite person?">Who is your favorite person?
			</option>
			</select></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Security Answer:</td>
			<td class="auto-style7">
			<input name="securityAnswer" type="text" style="width: 223px" /></td>
		</tr>
		<tr>
			<td class="auto-style3" style="width: 271px">Role:</td>
			<td class="auto-style1">
				<input checked="checked" name="role" type="radio" class="auto-style5" value="seller" /><span class="auto-style5">Seller
				</span>
				<input name="role" type="radio" class="auto-style5" value="bidder" /><span class="auto-style5">Bidder
				</span>
			</td>
		</tr>
		<tr>
			<td class="auto-style1" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
			<input name="submitButton" type="submit" value="REGISTER" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;<input name="resetButton" type="reset" value="CANCEL" />&nbsp;</td>
		</tr>
	</table>
</form>

<p class="auto-style6"><a href="../pages/HomePage.php">Homepage</a></p>
</center>
</body>

</html>
