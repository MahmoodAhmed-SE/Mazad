<?php
    $pdo = require('../mysql_db_connection.php');

    $bq = $pdo->prepare('SELECT * FROM Bidders where bidder_email = :email and bidder_phone = :phone and bidder_security_question = :question and bidder_security_answer = :answer;');
    $bq->bindParam(':email', $_POST['email']);
    $bq->bindParam(':phone', $_POST['phone']);
    $bq->bindParam(':question', $_POST['question']);
    $bq->bindParam(':answer', $_POST['answer']);
    $bq->execute();
    $bidder = $bq->fetch(PDO::FETCH_ASSOC);


    $sq = $pdo->prepare('SELECT * FROM Sellers where seller_email = :email and seller_phone = :phone and seller_security_question = :question and seller_security_answer = :answer;');
    $sq->bindParam(':email', $_POST['email']);
    $sq->bindParam(':phone', $_POST['phone']);
    $sq->bindParam(':question', $_POST['question']);
    $sq->bindParam(':answer', $_POST['answer']);
    $sq->execute();
    $seller = $sq->fetch(PDO::FETCH_ASSOC);


    if ($seller !== FALSE || $bidder !== FALSE) {
        if ($seller !== FALSE) {
            echo '<script>
            alert("Your password is: ' . $seller['seller_password'] . '\nrole: seller!");
            window.location.href = "/Mazad/pages/LoginPage.php";
            </script>';
            
        }
        else if ($bidder !== FALSE) {
            echo '<script>
            alert("Your password is: ' . $bidder['bidder_password'] . '\n role: bidder!");
            window.location.href = "/Mazad/pages/LoginPage.php";
            </script>';
        }
    } else {
        echo '<script>
        alert("Your details have not matched any user!");
        window.location.href = "/Mazad/pages/ForgetPassword.php";
        </script>';
    }
?>