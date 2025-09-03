<?php

    $query = $db->prepare("INSERT INTO  users (surname,first_name,email,post_code) VALUES (:surname, :first_name, :email, :post_code)");

    $query->execute([
        ':surname' => $_POST['surname'],
        ':first_name' => $_POST['firs_tname'],
        ':email' => $_POST['email'],
        ':post_code' => $_POST['post_code']
    ]);

    Header("Location: ../index.php");
?>