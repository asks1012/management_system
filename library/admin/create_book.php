<?php
    session_start();
    if ($_SESSION["id"] != "admin") {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Book</title>
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="manage_book/index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.png" alt="Library Logo" id="logo">
        &nbsp;
        <h1>Library Management System</h1>
    </div>
    <br><br><br><br><br>

    <form action='create_book.php' method='POST' class='book_info_form'>
    <h2>Create Book</h2>
    <label for='title'>Title :</label><br>
    <input type='text' name='title' required><br>
    <label for='author'>Author :</label><br>
    <input type='text' name='author' required><br>
    <label for='country'>Country :</label><br>
    <input type='text' name='country' required><br>
    <label for='language'>Language :</label><br>
    <input type='text' name='language' required><br>
    <label for='pages'>Pages :</label><br>
    <input type='text' name='pages' required><br>
    <label for='year'>Year :</label><br>
    <input type='text' name='year' required><br>
    <label for='copies'>Copies :</label><br>
    <input type='text' name='copies' required><br>
    <input type='submit' name='create_book' class='edit_button' value='Create Book'>
    </form>
    <br>

    <?php
        if($_SERVER['REQUEST_METHOD']=='POST') {
            require '../database_conn.php';
            $title = $_POST['title'];
            $author = $_POST['author'];
            $country = $_POST['country'];
            $language = $_POST['language'];
            $pages = $_POST['pages'];
            $year = $_POST['year'];
            $copies = $_POST['copies'];
            $query = "SELECT * FROM books WHERE TITLE='$title'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                echo "<p style='color: red;text-align:center'>A Book with that Title already exists</p>";
            } else {
                $query = "INSERT INTO books VALUES (
                    '$author',
                    '$country',
                    '$language',
                    '$pages',
                    '$title',
                    '$year',
                    '$copies'
                )";
                if(mysqli_query($conn,$query)) {
                    echo "<p style='color: green;text-align:center'>Successfully Created Boook. <a href='index.php'>Go back</a></p>";
                } else {
                    echo "<p style='color: red;text-align:center'>Could not Create Book</p>";
                }
            }
        }
    ?>

    <footer>
        Copyright &copy; 2018 Library, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>