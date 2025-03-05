<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $connection = mysqli_connect('mysql_db', 'root', 'root', 'Library');        

        if ($connection) {
            echo "Mysql connection established <br>";
        }
        else {
            die ("Mysql connection not established");
        }
    ?>

    <h4>Users</h4>
    <table>
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
                        <td>
                            <a href=\"/user/edit.html?id=".$row['id']."\">Edit</a>
                            <a href=\"/api/user/delete.php?id=".$row['id']."\">Delete</a>
                        </td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="/user/create.html" class="submit-btn">Create user</a>

    <h4>Books</h4>
    <table>
        <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publication Year</th>
        </thead>

        <tbody id="books-items"></tbody>
    </table>
    <a href="/book/create.html" class="submit-btn">Create books</a>

    <label for="book-sortBy">Sort books by:</label>
    <select name="book-sortBy" id="book-sortBy">
        <option value="id" selected>Id</option>
        <option value="title">Title</option>
        <option value="author">Author</option>
        <option value="publication_year">Year</option>
    </select>

    <script>
        function fetchTable (sortBy = 'id') {
            fetch(`/api/book/getAll.php?sortBy=${sortBy}`)
                .then(async (res) => {
                    books_items.innerHTML = '';
                    for (const book of await res.json()) {
                        books_items.innerHTML += `
                        <tr>
                            <td>${book.id}</td>  
                            <td>${book.title}</td>  
                            <td>${book.author}</td>  
                            <td>${book.publication_year}</td>  
                            <td>
                                <a href=/book/edit.html?id=${book.id}>Edit</a>
                                <a href=/api/book/delete.php?id=${book.id}>Delete</a>
                            </td>
                        </tr>
                        `
                    }
            });
        }
        
        const select_form = document.getElementById('book-sortBy');
        const books_items = document.getElementById('books-items'); 
        fetchTable();

        select_form.onchange = (e) => {
            fetchTable(e.target.value);
        }

    </script>

    <h4>Orders</h4>
    <table>
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
        .submit-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 5px;
            background-color: darkgray;
            border-radius: 5px;
            text-decoration: none;
            color: black;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</body>
</html>