<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<meta content="en-us" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
	font-family: Calibri;
	font-size: xx-large;
	color: #663300;
}
.auto-style2 {
	font-family: Calibri;
	text-align: center;
	color: #663300;
	font-size: large;
}
.auto-style4 {
	font-family: Calibri;
}
.auto-style5 {
	font-family: Calibri, sans-serif;
	text-align: center;
	color: #663300;
	font-size: large;
}
</style>
</head>

<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="auto-style1"><strong>View Seller Details</strong></p>
<table align="center" style="width: 70%; height: 23px">
	<tr>
		<td class="auto-style2" style="width: 169px">
		<strong>Seller ID</strong></td>
		<td class="auto-style2" style="width: 187px">
		<strong>Seller Name</strong></td>
		<td class="auto-style5" style="width: 181px"><strong>Seller Email</strong></td>
		<td class="auto-style2" style="width: 137px"><strong>Seller Phone</strong></td>
		<td class="auto-style2"><strong>Resident Card ID</strong></td>
		<td class="auto-style2"><strong>Resident Card</strong></td>
		<td class="auto-style2"><strong>Approve</strong></td>
		<td class="auto-style2"><strong>Deny</strong></td>
	</tr>
	
	<?php
$pdo = require('../../mysql_db_connection.php');
$query = $pdo->prepare("SELECT * FROM Sellers WHERE seller_status=0;");
$query->execute();
$rows=$query->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
	{
		echo "<tr>";
			echo "<td><center>{$row['seller_id']}</center></td>";
			echo "<td><center>{$row['seller_name']}</center></td>";
			echo "<td><center>{$row['seller_email']}</center></td>";
			echo "<td><center>{$row['seller_phone']}</center></td>";
			echo "<td><center>{$row['seller_resident_id_number']}</center></td>";
			echo "<td><center><img=src'{$row['seller_resident_card_image']}'></center></td>";
			echo "<td><center><a href='approveseller.php?sid={$row['seller_id']}'onclick=\"return confirm('Do you want to approve the seller?');\">Approve</a><center></td>";
			echo "<td><center><a href='denyseller.php?sid={$row['seller_id']}'onclick=\"return confirm('Do you want to deny the seller?');\">Deny</a><center></td>";
		echo "</tr>";
	}
	
	?>
</table>
<p>&nbsp;</p>
<p class="auto-style4"><strong><a href="A_Menu.php">Homepage</a></strong></p>

</body>

</html>
