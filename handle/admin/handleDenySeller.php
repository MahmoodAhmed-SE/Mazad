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
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<?php
$sid = $_GET["sid"];
$query = $pdo->prepare("UPDATE sellers SET seller_status='0', administrator_id =:aid WHERE seller_id =:sid;");
$query->bindParam(':aid', $id);
$query->bindParam(':sid', $sid);
$query->execute();

echo "Seller Profile has been approved.<br><br>";
echo "<a href='ViewSellerByAdmin.php'>BACK</a>";
?>
</body>

</html>
