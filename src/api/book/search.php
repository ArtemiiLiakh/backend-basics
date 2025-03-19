<?php
    $searchText = $_GET["search"];
    $publicationYearFrom = $_GET["publicationFromYear"];
    $publicationYearTo = $_GET["publicationToYear"];

    $connection = mysqli_connect('mysql_db', 'root', 'root', 'library');
    
    $filter = '1 AND ';

    if (!empty($searchText)) {
        $filter = $filter."(title LIKE '%".$searchText."%' OR
            author LIKE '%".$searchText."%' OR
            title REGEXP '".$searchText."' OR
            author REGEXP '".$searchText."'
            ) AND ";
    }

    if (!empty($publicationYearFrom)) {
        $filter = $filter."publication_year >= ".$publicationYearFrom." AND ";
    }

    if (!empty($publicationYearTo)) {
        $filter = $filter."publication_year <= ".$publicationYearTo." AND ";
    }

    $filter = $filter."1";
    
    $books = $connection->query("
        SELECT * FROM books 
        WHERE ".$filter."
    ");

    $connection->close();

    $result = [];

    while ($row = $books->fetch_assoc()) {
        array_push($result, $row);
    }

    echo json_encode($result);
?>