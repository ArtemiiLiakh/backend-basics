<?php
    $sortBy = $_GET["sortBy"] ?? 'id';

    $connection = mysqli_connect('mysql_db', 'root', 'root', 'Library');
    
    $result = [];

    $books = $connection->query("SELECT * FROM books ORDER BY ".$sortBy." DESC");

    while ($row = $books->fetch_assoc()) {
        array_push($result, $row);
    }

    $connection->close();

    echo json_encode($result);
?>