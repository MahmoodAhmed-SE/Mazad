<?php
  session_start();
  
  if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
	$pdo = require('../../mysql_db_connection.php');
	$id = $_SESSION['user_id'];
	$role = $_SESSION['role'];

	require('../../services/getUser.php');
	
	$user = getUser($pdo, $id, $role);

	if ($user === false) {
		echo '<script>
			alert("Either Your Registration is Pending or Not Registered yet!");
			window.location.href = "/Mazad/pages/HomePage.php";
			</script>';
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
$query = $pdo->prepare("UPDATE sellers SET seller_status='1', administrator_id =:aid WHERE seller_id =:sid;");
$query->bindParam(':aid', $id);
$query->bindParam(':sid', $sid);
$query->execute();


echo '<script>
	alert("Seller Profile has been approved!");
	window.location.href = "/Mazad/pages/administrator/A_Menu.php";
	</script>';
?>
</body>

</html>
