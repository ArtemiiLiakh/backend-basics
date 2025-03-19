<?php
    $book_id = $_GET["id"];
    $book = json_decode(file_get_contents('php://input'), true);

    $title = $book['title'];
    $author = $book['author'];
    $year = $book['year'];
    
    $connection = mysqli_connect("mysql_db", "root", "root", database: "library");
    $connection->query("UPDATE `books` SET title='".$title."', author='".$author."', publication_year=".$year." WHERE id=".$book_id);
    $connection->close();
    
    echo 'ok';
?>