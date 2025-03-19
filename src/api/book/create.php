<?php
    $book = json_decode(file_get_contents('php://input'), true);

    $title = $book['title'];
    $author = $book['author'];
    $year = $book['year'];

    $connection = mysqli_connect("mysql_db", "root", "root", database: "library");
    $connection->query("INSERT INTO `books`(title, author, publication_year) VALUES('".$title."', '".$author."', ".$year.")");
    $connection->close(); 
    
    echo 'ok';
?>