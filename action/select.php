<?php

    $query = $db->prepare("SELECT * FROM users");
    $query -> execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

?>