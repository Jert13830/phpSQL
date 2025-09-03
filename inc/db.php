<?php

    $servername = 'localhost';
    $username = 'root';
    $password = 'root';

    try{
        $db = new PDO("mysql:host=$servername;dbname=sql_tau", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Erreur: " . $e->getMessage();
    }
?>
