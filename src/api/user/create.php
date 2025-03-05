<?php
    $user = json_decode(file_get_contents('php://input'), true);

    $full_name = $user['full_name'];

    $connection = mysqli_connect("mysql_db", "root", "root", "Library");
    $connection->query("INSERT INTO `users`(full_name) VALUES('".$full_name."')");
    $connection->close(); 
    
    echo 'ok';
?>