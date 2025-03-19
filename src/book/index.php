<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/">Home</a>

    <?php
        $book_id = $_GET["id"];

        $connection = mysqli_connect('mysql_db', 'root', 'root', "library");

        $book = $connection->query("SELECT * FROM `books` WHERE id = $book_id")->fetch_assoc();
        $orders = $connection->query("SELECT users.full_name name
            FROM `orders` 
            INNER JOIN `users` ON `orders`.user_id = `users`.id
            WHERE book_id = $book_id
        ");

        echo "<p>Id: ".$book["id"]."</p>";
        echo "<p>Title: ".$book["title"]."</p>";
        echo "<p>Author: ".$book["author"]."</p>";
        echo "<p>Publication year: ".$book["publication_year"]."</p>";
        
        echo "<p>Owned by: ";
        while ($order = $orders->fetch_array(MYSQLI_ASSOC)) {
            echo  $order['name'].', ';
        }

        echo "</p>";
    ?>
</body>
</html>