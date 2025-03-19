<?php
    $connection = mysqli_connect("mysql_db", 'root', 'root', 'library');
    $book_id = $_GET['id'];
    
    $rows = $connection->query("SELECT id FROM `books` WHERE id=".$book_id)->num_rows;

    if ($rows == 0) {
        die("Book with id ".$book_id." is not found");
    }

    $connection->query("DELETE FROM `books` WHERE id=".$book_id);
    $connection->close(); 

    echo '<script>window.location.href = \'/\';</script>';
?>
