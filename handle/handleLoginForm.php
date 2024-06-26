<?PHP

$name = $_POST['name'];
$pword = $_POST['password'];
$role = $_POST['role'];


if (isset($_POST['submitButton'])) {
	if (empty($name) || empty($pword) || empty($role)) {
		echo '<script>
            alert("Not All fields entered!");
            window.location.href = "/Mazad/pages/LoginPage.php";
            </script>';
	}
	else {
		// connecting to sql database
		$pdo = require('../mysql_db_connection.php');
		
		$query = NULL;
		
		switch ($role) {
	    	case 'admin':
		    	//Preparing SELECT statement
				$query = $pdo->prepare("SELECT * FROM Administrators WHERE administrator_name = :name AND administrator_password = :password;");
				
				// Binding parameters
			    $query->bindParam(':name', $name);
			    $query->bindParam(':password', $pword); 
		    	break;
		    	
	    case 'seller':
			//Preparing SELECT statement
			$query = $pdo->prepare("SELECT * FROM Sellers WHERE seller_name = :name AND seller_password = :password;");
			
			// Binding parameters
		    $query->bindParam(':name', $name);
		    $query->bindParam(':password', $pword);			    
			break;
    		case 'bidder':
    			//Preparing SELECT statement
    			$query = $pdo->prepare("SELECT * FROM Bidders WHERE bidder_name = :name AND bidder_password = :password;");
    			
    			// Binding parameters
			    $query->bindParam(':name', $name);
			    $query->bindParam(':password', $pword);			    
    			break;
    			
			default:
				break;  
		}
		
		
		$query->execute();
	
		$user = $query->fetch(PDO::FETCH_ASSOC);

    
		if ($user === false) {
			echo '<script>
				alert("Please Register first!");
				window.location.href = "/Mazad/pages/Registration.php";
				</script>';
			exit();
		} else if ($role != 'admin' && $user[$role . '_status'] === 0) {
			echo '<script>
				alert("Please Wait for admin approval!");
				window.location.href = "/Mazad/pages/HomePage.php";
				</script>';
			exit();
		}
		else {
			session_start();

			switch ($role) {
				case 'seller':
					$_SESSION['user_id'] = $user['seller_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/seller/S_Menu.php');
				break;
				case 'bidder': 
					$_SESSION['user_id'] = $user['bidder_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/bidder/B_Menu.php');
				break;
				case 'admin': 
					$_SESSION['user_id'] = $user['administrator_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/administrator/A_Menu.php');
				break;
				default: break;
			}
		}
		
	}
	
}

?>
