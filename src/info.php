<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $connection = mysqli_connect('mysql_db', 'root', 'root', 'library', 3306);

        $table_counts = $connection->query("
            SELECT 'users' as table_name, COUNT(*) as row_count FROM users
            UNION
            SELECT 'books' as table_name, COUNT(*) as row_count FROM books
        ");

        $user_counts = $table_counts->fetch_assoc()['row_count'];
        $book_counts = $table_counts->fetch_assoc()['row_count'];

        $last_month_users = $connection->query("
            SELECT COUNT(*) as users_count 
            FROM users 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE);
        ")->fetch_row()[0];
        
        $last_month_books = $connection->query("
            SELECT COUNT(*) as books_count 
            FROM books 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE) AND YEAR(created_at) = YEAR(CURRENT_DATE);
        ")->fetch_row()[0];

        $last_book_row = $connection->query("SELECT * FROM books ORDER BY id DESC LIMIT 1")->fetch_assoc();

        $popular_book = $connection->query("
            SELECT books.id, books.title, books_orders_count.books_count as books_count
            FROM (
                SELECT orders.book_id as book_id, COUNT(orders.book_id) as books_count FROM orders GROUP BY orders.book_id
            ) as books_orders_count
            INNER JOIN books ON books.id = books_orders_count.book_id
            ORDER BY books_count DESC
            LIMIT 1;          
        ")->fetch_assoc();
    ?>
    <a href="/">Home</a>

    <p>Total users: <?php echo $user_counts?></p>
    <p>Total books: <?php echo $book_counts ?></p>
    <p>Created users in this month: <?php echo $last_month_users ?></p>
    <p>Created books in this month: <?php echo $last_month_books ?></p>
    <p>Last book: <?php echo $last_book_row['id']." <a href=\"/book?id=".$last_book_row['id']."\">".$last_book_row['title']."</a>"?></p>
    <p>Popular book: <?php echo $popular_book['id']." <a href=\"/book?id=".$popular_book['id']."\">".$popular_book['title']."</a>" ?></p>
</body>
</html>