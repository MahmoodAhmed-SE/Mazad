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

        $seller_name = $_POST['seller_name'];
        $seller_email = $_POST['seller_email'];
        $seller_phone = $_POST['seller_phone'];
        $seller_security_question = $_POST['seller_security_question'];
        $seller_security_answer = $_POST['seller_security_answer'];
        $seller_resident_id_number = $_POST['seller_resident_id_number'];
        $seller_resident_card_image = $_POST['seller_resident_card_image'];


        $query = $pdo->prepare('UPDATE Sellers SET seller_name = :seller_name, seller_email = :seller_email, seller_phone= :seller_phone, seller_security_question = :seller_security_question, seller_security_answer = :seller_security_answer, seller_resident_id_number = :seller_resident_id_number, seller_resident_card_image = :seller_resident_card_image WHERE seller_id = :id');


        $query->bindParam(':id', $id);
        $query->bindParam(':seller_name', $seller_name);
        $query->bindParam(':seller_email', $seller_email);
        $query->bindParam(':seller_phone', $seller_phone);
        $query->bindParam(':seller_security_question', $seller_security_question);
        $query->bindParam(':seller_security_answer', $seller_security_answer);
        $query->bindParam(':seller_resident_id_number', $seller_resident_id_number);
        $query->bindParam(':seller_resident_card_image', $seller_resident_card_image);


        $query->execute();


        echo '<script>
                alert("Profile Updated Successfully!");
                window.location.href = "/Mazad/pages/seller/S_Menu.php";
                </script>';
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>