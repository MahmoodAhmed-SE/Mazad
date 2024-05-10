<?php
if (isset($_POST['submit'])) {

    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $pdo = require('../mysql_db_connection.php');

        $id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        require('../services/getUser.php');

        $user = getUser($pdo, $id, $role);

        if ($user === false) {
            header('Location: /Mazad/pages/LoginPage.php');
        }

        $seller_name = $_POST['seller_name'];
        $seller_email = $_POST['seller_email'];
        $seller_phone = $_POST['seller_phone'];
        $seller_password = $_POST['seller_password'];
        $seller_security_question = $_POST['seller_security_question'];
        $seller_security_answer = $_POST['seller_security_answer'];
        $seller_resident_id_number = $_POST['seller_resident_id_number'];
        $seller_resident_card_image = $_POST['seller_resident_card_image'];


        $query = $pdo->prepare('UPDATE Sellers SET seller_name = :seller_name, seller_email = :seller_email, seller_phone= :seller_phone, seller_password = :seller_password, seller_security_question = :seller_security_question, seller_security_answer = :seller_security_answer, seller_resident_id_number = :seller_resident_id_number, seller_resident_card_image = :seller_resident_card_image WHERE seller_id = :id');


        $query->bindParam(':id', $id);
        $query->bindParam(':seller_name', $seller_name);
        $query->bindParam(':seller_email', $seller_email);
        $query->bindParam(':seller_phone', $seller_phone);
        $query->bindParam(':seller_password', $seller_password);
        $query->bindParam(':seller_security_question', $seller_security_question);
        $query->bindParam(':seller_security_answer', $seller_security_answer);
        $query->bindParam(':seller_resident_id_number', $seller_resident_id_number);
        $query->bindParam(':seller_resident_card_image', $seller_resident_card_image);


        $status = $query->execute();


        print('Updated successfully');
    }
    else {
        header('Location: /Mazad/pages/LoginPage.php');
    }
}
?>