<?php
// Check if the email address exists for a different user
$check_email = $db->prepare("SELECT * FROM users WHERE email = :email AND id != :id");
$check_email->execute([
    ':email' => $_POST['email'],
    ':id'    => $_POST['id']
]);

if ($check_email->fetch(PDO::FETCH_ASSOC)) {
    // Email is used by another - show error
    $errors["email_double"] = "The email address already exists.";
} else {
    // We can update
    $query = $db->prepare("UPDATE users 
                           SET surname = :surname, 
                               first_name = :first_name, 
                               email = :email, 
                               post_code = :post_code 
                           WHERE id = :id");

    $query->execute([
        ':surname'    => $_POST['surname'],
        ':first_name' => $_POST['first_name'],
        ':email'      => $_POST['email'],
        ':post_code'  => $_POST['post_code'],
        ':id'         => $_POST["id"]
    ]);
}

   // Header("Location: ../index.php");
?>