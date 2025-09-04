<?php

//Check if the email address exists
$check_email = $db->prepare("SELECT * FROM users WHERE email = :email");
$check_email->execute([
    ':email' => $_POST['email']
]);

if ($check_email->fetch(PDO::FETCH_ASSOC)) {
    $errors["email_double"] = "The email address already exists.";
} else {

    // the email address does not exist 
    $query = $db->prepare(" INSERT INTO users (surname, first_name, email, post_code) VALUES (:surname, :first_name, :email, :post_code)
    ");

    $query->execute([
        ':surname'    => $_POST['surname'],
        ':first_name' => $_POST['first_name'],
        ':email'      => $_POST['email'],
        ':post_code'  => $_POST['post_code']
    ]);

    // header("Location: ../index.php"); // Uncomment when ready
}
?>