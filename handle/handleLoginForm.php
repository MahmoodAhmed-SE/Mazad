<?PHP

$name = $_POST['name'];
$pword = $_POST['password'];
$role = $_POST['role'];


if (isset($_POST['submitButton'])) {
	if (empty($name) || empty($pword) || empty($role)) {
		print("not all fields are filled");
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
				$query = $pdo->prepare("SELECT * FROM Sellers WHERE seller_name = :name AND seller_password = :password AND seller_status=1;");
    			
    			// Binding parameters
			    $query->bindParam(':name', $name);
			    $query->bindParam(':password', $pword);			    
    			break;
    		case 'bidder':
    			//Preparing SELECT statement
    			$query = $pdo->prepare("SELECT * FROM Bidders WHERE bidder_name = :name AND bidder_password = :password AND bidder_status=1;");
    			
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
			print('Please register! or Your Registration is Pending.');
		}
		else {
			session_start();

			switch ($role) {
				case 'seller':
					$_SESSION['user_id'] = $user['seller_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/S_Menu.php');
				break;
				case 'bidder': 
					$_SESSION['user_id'] = $user['bidder_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/B_Menu.php');
				break;
				case 'admin': 
					$_SESSION['user_id'] = $user['administrator_id'];
					$_SESSION['role'] = $role;

					header('Location: /Mazad/pages/A_Menu.php');
				break;
				default: break;
			}
		}
		
	}
	
}

?>
