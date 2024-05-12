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
<p class="auto-style1"><strong>View Bidder Details</strong></p>
<table align="center" style="width: 70%; height: 23px">
	<tr>
		<td class="auto-style2" style="width: 169px">
		<strong>Bidder ID</strong></td>
		<td class="auto-style2" style="width: 187px">
		<strong>Bidder Name</strong></td>
		<td class="auto-style5" style="width: 181px"><strong>Bidder Email</strong></td>
		<td class="auto-style2" style="width: 137px"><strong>Bidder Phone</strong></td>
		<td class="auto-style2"><strong>Resident Card ID</strong></td>
		<td class="auto-style2"><strong>Resident Card</strong></td>
		<td class="auto-style2"><strong>Approve</strong></td>
		<td class="auto-style2"><strong>Deny</strong></td>
	</tr>
	
	<?php
$pdo = require('../../mysql_db_connection.php');
$query = $pdo->prepare("SELECT * FROM Bidders WHERE bidder_status=0;");
$query->execute();
$rows=$query->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
	{
		echo "<tr>";
			echo "<td><center>{$row['bidder_id']}</center></td>";
			echo "<td><center>{$row['bidder_name']}</center></td>";
			echo "<td><center>{$row['bidder_email']}</center></td>";
			echo "<td><center>{$row['bidder_resident_id_number']}</center></td>";
			echo "<td><center><img=src'{$row['bidder_resident_card_image']}'></center></td>";
			echo "<td><center><a href='../../hanlde/handleApproveBidder.php?sid={$row['bidder_id']}'onclick=\"return confirm('Do you want to approve the bidder?');\">Approve</a><center></td>";
			echo "<td><center><a href='../../hanlde/handleDenyBidder.php?sid={$row['bidder_id']}'onclick=\"return confirm('Do you want to deny the bidder?');\">Deny</a><center></td>";
		echo "</tr>";
	}
	
	?>
</table>
<p>&nbsp;</p>
<p class="auto-style4"><strong><a href="A_Menu.php">Homepage</a></strong></p>

</body>

</html>
