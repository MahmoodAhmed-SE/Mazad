<?php

function getUser($pdo, $id, $role) {
	$query = NULL;

	switch ($role) {
		case 'admin':
			//Preparing SELECT statement
			$query = $pdo->prepare("SELECT * FROM Administrators WHERE administrator_id = :id;");
			
			// Binding parameters
			$query->bindParam(':id', $id); 
			break;
			
		case 'seller':
			//Preparing SELECT statement
			$query = $pdo->prepare("SELECT * FROM Sellers WHERE seller_id = :id AND seller_status=1;");
			
			// Binding parameters
			$query->bindParam(':id', $id);			    
			break;
		case 'bidder':
			//Preparing SELECT statement
			$query = $pdo->prepare("SELECT * FROM Bidders WHERE bidder_id = :id AND bidder_status=1;");
			
			// Binding parameters
			$query->bindParam(':id', $id);			    
			break;
			
		default:
			break;  
	}


	$query->execute();
	
	$user = $query->fetch(PDO::FETCH_ASSOC);

    return $user;
}

?>