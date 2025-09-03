<?php

    // Prepare and execute the delete statement
    $query = $db->prepare("DELETE FROM users WHERE id = :id");
    $query->execute([':id' => $userId]);
?>