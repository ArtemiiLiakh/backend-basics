<?php
    $book_id = $_GET["id"];

    $connection = mysqli_connect('mysql_db', 'root', 'root', 'library');
    
    $book = $connection->query("SELECT * FROM books WHERE id=".$book_id)->fetch_assoc();
    $connection->close();

    echo json_encode($book);
?>