<?php 
    $dsn = 'mysql:host=localhost;dbname=msu_movies'; 
    $username = 'admin'; 
    $password = 'Cggradmin1'; 

    try { 
        $db = new PDO($dsn, $username, $password); 
    } catch (PDOException $e) { 
        $error_message = $e->getMessage(); 
        include('./database_error.php'); 
        exit(); 
    } 
?>
