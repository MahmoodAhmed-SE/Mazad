<?php

if(isset($_POST['submit'])) {
    if (empty($_POST['password']) || empty($_POST['new_password']) || empty($_POST['retype_new_password'])) {
        print("Please make sure you filled all entries!");   
        echo '<script>
            alert("Please make sure you filled all entries!");
            window.location.href = "/Mazad/pages/ChangePassword.php";
            </script>';
    }
    else if ($_POST['new_password'] !== $_POST['retype_new_password']) {
        print("Please make sure you retype the same password!");   
        echo '<script>
            alert("Please make sure you retype the same password!");
            window.location.href = "/Mazad/pages/ChangePassword.php";
            </script>';
    }
    else {
        session_start();
    
        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            $pdo = require('../mysql_db_connection.php');
            $id = isset($_SESSION['user_id']);
            $role = isset($_SESSION['role']);
            
            $password = $_POST['password'];
            $new_password = $_POST['new_password'];
            
            require('../services/getUser.php');
    
            $user = getUser($pdo, $id, $role);
            
            
            if ($user === false) {
                echo '<script>
                alert("Either Your Registration is Pending or Not Registered yet!");
                window.location.href = "/Mazad/pages/HomePage.php";
                </script>';
            }
    
            $query = NULL;
            switch ($role) {
                case 'admin':
                    if ($user['administrator_password'] === $password) {
                        $query = $pdo->prepare("UPDATE Administrators SET administrator_password = :p WHERE administrator_id = :id;");
                        $query->bindParam(':p', $new_password);
                        $query->bindParam(':id', $id);
                    } else {
                        echo '<script>
                        alert("Make sure you enter the correct password!");
                        window.location.href = "/Mazad/pages/LoginPage.php";
                        </script>';
                    }
                    break;
                    
                case 'seller':
                    if ($user['seller_password'] === $password) {
                        $query = $pdo->prepare("UPDATE Sellers SET seller_password = :p WHERE seller_id = :id;");
                        $query->bindParam(':p', $new_password);
                        $query->bindParam(':id', $id);
                    } else {
                        echo '<script>
                        alert("Make sure you enter the correct password!");
                        window.location.href = "/Mazad/pages/LoginPage.php";
                        </script>';
                    }	    
                    break;
                case 'bidder':
                    if ($user['bidder_password'] === $password) {
                        $query = $pdo->prepare("UPDATE Bidders SET bidder_password = :p WHERE bidder_id = :id;");
                        $query->bindParam(':p', $new_password);
                        $query->bindParam(':id', $id);
                    } else {
                        echo '<script>
                        alert("Make sure you enter the correct password!");
                        window.location.href = "/Mazad/pages/LoginPage.php";
                        </script>';
                    }		    
                    break;
                    
                    default:
                    break;  
                }
                
            
            if($query && $query->execute()) {
                print("password changed successfully!");
                echo '<script>
                alert("Password changed successfully!");
                window.location.href = "/Mazad/pages/LoginPage.php";
                </script>';
            }          

        }
        else {
            header('Location: /Mazad/pages/LoginPage.php');
        }
    }
}

?>