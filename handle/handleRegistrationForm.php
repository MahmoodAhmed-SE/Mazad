<?PHP

$name = $_POST['name'];
$pword = $_POST['password'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$idNumber = $_POST['idNumber'];
$residentCard = $_POST['residentCard'];
$securityQuestion = $_POST['securityQuestion'];
$securityAnswer = $_POST['securityAnswer'];
$role = $_POST['role'];



if(isset($_POST['submitButton'])) {
	# if any of the form entries are empty, a warning message will show up
	if (empty($name) || empty($pword) || empty($email) || empty($phoneNumber) || empty($idNumber) || empty($residentCard) || empty($securityQuestion) || empty($securityAnswer) || empty($role)) {
        print("not all fields are filled");
    } 
    else {
    	// db connection
	    $pdo = require('../mysql_db_connection.php');
	    
	    
	    
	    try {
	   		// mysql query based on role of user 
	    	$query = NULL;
	    	
	    	switch ($role) {
	    		case 'admin':
	    			//Preparing INSERT statement
	    			$query = $pdo->prepare("INSERT INTO Administrators(administrator_name, administrator_password) VALUES(:name, :password);");
	    			
	    			// Binding parameters
				    $query->bindParam(':name', $name);
				    $query->bindParam(':password', $pword); 
				       
	    			break;
	    			
	    		case 'seller':
	    			//Preparing INSERT statement
					$query = $pdo->prepare("INSERT INTO Sellers(seller_name, seller_email, seller_phone, seller_password, seller_security_question, seller_security_answer, seller_resident_id_number, seller_resident_card_image, seller_status) VALUES(:name, :email, :phoneNumber, :pword, :securityQuestion, :securityAnswer, :idNumber, :residentCard, FALSE);");
	    			
	    			// Binding parameters
				    $query->bindParam(':name', $name);
				    $query->bindParam(':email', $email);
				    $query->bindParam(':phoneNumber', $phoneNumber);
				    $query->bindParam(':pword', $pword);
				    $query->bindParam(':securityQuestion', $securityQuestion);
				    $query->bindParam(':securityAnswer', $securityAnswer);
				    $query->bindParam(':idNumber', $idNumber);
				    $query->bindParam(':residentCard', $residentCard);   
				    
	    			break;
	    			
	    		case 'bidder':
	    			//Preparing INSERT statement
	    			$query = $pdo->prepare("INSERT INTO Bidders(bidder_name, bidder_email, bidder_password, bidder_security_question, bidder_security_answer, bidder_resident_id_number, bidder_resident_card_image, bidder_status) VALUES(:name, :email, :pword, :securityQuestion, :securityAnswer, :idNumber, :residentCard, FALSE);");
	    			
	    			// Binding parameters
				    $query->bindParam(':name', $name);
				    $query->bindParam(':email', $email);
				    $query->bindParam(':pword', $pword);
				    $query->bindParam(':securityQuestion', $securityQuestion);
				    $query->bindParam(':securityAnswer', $securityAnswer);
				    $query->bindParam(':idNumber', $idNumber);
				    $query->bindParam(':residentCard', $residentCard);
				    
	    			break;
	    			
				default:
					break;    			
	    	}
	    	   	
		
		    
		
		    // Insert user into respective table (Administrators, Sellers, or Bidders)
		    $query->execute();
		    
		    

			session_start();
			
			$lastId = $pdo->lastInsertId();
			
			$_SESSION['user_id'] = $lastId;
			$_SESSION['role'] = $role;


			switch ($role) {
				case 'seller':
					header('Location: /Mazad/pages/seller/S_Menu.php');
				break;
				case 'bidder':
					header('Location: /Mazad/pages/bidder/B_Menu.php');
				break;
				case 'admin':
					header('Location: /Mazad/pages/administrator/A_Menu.php');
				break;
				default: break;
			}
			
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
    }
}
?>