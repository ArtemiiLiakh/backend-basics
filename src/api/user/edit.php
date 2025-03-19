<?php
    $user_id = $_GET["id"];

    $user = json_decode(file_get_contents('php://input'), true);

    $full_name = $user["full_name"];

    $connection = mysqli_connect('mysql_db', 'root', 'root', 'library');
    $connection->query(query: "UPDATE `users` SET full_name='".$full_name."' WHERE id=".$user_id);
    $connection->close(); 
    
    echo 'ok';
?>