<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $connection = mysqli_connect('mysql_db', 'root', 'root');        

        if ($connection) {
            echo "Mysql connection established <br>";
        }
        else {
            echo "Mysql connection not established";
        }

        $dbname = "Library";

        if (
            $connection->query("CREATE DATABASE IF NOT EXISTS `$dbname`;")
        ) {
            echo "Database successfully created <br>";
        } else {
            echo "Error occurred when creating database: $connection->error";
        }

        $connection->select_db($dbname);

        if (
            $connection->query("CREATE TABLE IF NOT EXISTS `users` (
                id INT PRIMARY KEY AUTO_INCREMENT,
                full_name VARCHAR(50),
                created_at DATETIME DEFAULT NOW()
            )")
        ) {
            echo "Table `users` successfully created";
        }
        else {
            "Error occurred when creating table `users`: $connection->error";
        }
    ?>

    <table>
        <h4>Users</h4>
        <thead>
            <th>Id</th>
            <th>Full name</th>
            <th>Created date</th>
        </thead>

        <tbody>
            <?php
                $users = $connection->query("SELECT * FROM `users`");

                while ($row = $users->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['id']."</td>  
                        <td>".$row['full_name']."</td>  
                        <td>".$row['created_at']."</td>  
                    </tr>";
                }
            ?>
        </tbody>
    </table>
    
    <table>
        <h4>Books</h4>
        <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publication Year</th>
        </thead>

        <tbody>
            <?php
                $books = $connection->query("SELECT * FROM `books`");

                while ($row = $books->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['id']."</a></td>  
                        <td><a href='/lab1/books.php?id=".$row['id']."'>".$row['title']."</td>  
                        <td>".$row['author']."</td>  
                        <td>".$row['publication_year']."</td>  
                    </tr>";
                }
            ?>
        </tbody>
    </table>

    <table>
        <h4>Orders</h4>
        <thead>
            <th>User</th>
            <th>Book</th>
            <th>Issue date</th>
            <th>Return date</th>
        </thead>

        <tbody>
            <?php
                $orders = $connection->query(
                    "SELECT 
                        `users`.full_name username, books.title book_title, issue_date, return_date 
                        FROM `orders` 
                        INNER JOIN `users` ON `orders`.user_id = `users`.id
                        INNER JOIN `books` ON `orders`.book_id = `books`.id
                    "
                );

                while ($row = $orders->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['username']."</td>  
                        <td>".$row['book_title']."</td>  
                        <td>".$row['issue_date']."</td>  
                        <td>".$row['return_date']."</td>  
                    </tr>";
                }
            ?>
        </tbody>
    </table>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</body>
</html>