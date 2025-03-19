<?php
    $connection = mysqli_connect("mysql_db", "root", "root", "library");
    $user_id = $_GET["id"];

    $user = $connection->query("SELECT * FROM `users` WHERE id=".$user_id)->fetch_assoc();
    $connection->close(); 

    echo json_encode($user);
?>