<?php
if (isset($_POST['submit'])) {

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

        
        $bidder_name = $_POST['bidder_name'];
        $bidder_email = $_POST['bidder_email'];
        $bidder_phone = $_POST['bidder_phone'];
        $bidder_resident_id_number = $_POST['bidder_resident_id_number'];
        $bidder_resident_card_image = $_POST['bidder_resident_card_image'];
        $bidder_security_question = $_POST['bidder_security_question'];
        $bidder_security_answer = $_POST['bidder_security_answer'];


        $query = $pdo->prepare('UPDATE Bidders SET bidder_name = :bidder_name, bidder_email = :bidder_email, bidder_phone= :bidder_phone, bidder_security_question = :bidder_security_question, bidder_security_answer = :bidder_security_answer, bidder_resident_id_number = :bidder_resident_id_number, bidder_resident_card_image = :bidder_resident_card_image WHERE bidder_id = :id');


        $query->bindParam(':id', $id);
        $query->bindParam(':bidder_name', $bidder_name);
        $query->bindParam(':bidder_email', $bidder_email);
        $query->bindParam(':bidder_phone', $bidder_phone);
        $query->bindParam(':bidder_security_question', $bidder_security_question);
        $query->bindParam(':bidder_security_answer', $bidder_security_answer);
        $query->bindParam(':bidder_resident_id_number', $bidder_resident_id_number);
        $query->bindParam(':bidder_resident_card_image', $bidder_resident_card_image);


        $query->execute();



        echo '<script>
            alert("Profile updated successfully!");
            window.location.href = "/Mazad/pages/bidder/B_Menu.php";
            </script>';
        exit();
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>




