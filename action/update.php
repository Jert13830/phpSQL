<?php

    $query = $db->prepare("UPDATE users SET surname = :surname, first_name = :first_name, email = :email, post_code = :post_code WHERE id = :id");

    $query->execute([
        ':surname' => $_POST['surname'],
        ':first_name' => $_POST['first_name'],
        ':email' => $_POST['email'],
        ':post_code' => $_POST['post_code'],
        ':id' => $_POST["id"]
    ]);

   // Header("Location: ../index.php");
?>