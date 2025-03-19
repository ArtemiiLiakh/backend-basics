<?php
    $connection = mysqli_connect("mysql_db", 'root', 'root', 'library');
    $user_id = $_GET['id'];
    
    $rows = $connection->query("SELECT id FROM `users` WHERE id=".$user_id)->num_rows;

    if ($rows == 0) {
        die("User with id ".$user_id." is not found");
    }

    $connection->query("DELETE FROM `users` WHERE id=".$user_id);
    $connection->close(); 

    echo '<script>window.location.href = \'/\';</script>';
?>
