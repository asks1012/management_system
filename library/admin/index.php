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
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="index.css">
    <script src="load_books.js"></script>
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.png" alt="Library Logo" id="logo">
        &nbsp;
        <h1>Library Management System</h1>
    </div>
    <br><br><br><br><br>
    <div class="top_div">
        <div class="logout_div">
            <a href="logout.php"><img src="../images/logout.png" alt="logout" width="30px" height="30px"></a>
        </div>
        <div class="username_div">
            <img src="../images/user_logo.jpg" alt="user logo" width="30px" height="30px">
            &nbsp;&nbsp;
            <p id="username"><?php echo $_SESSION["id"]; ?></p>
            &nbsp;&nbsp;
        </div>
    </div>
    <hr>
    <div class="admin_links_div">
        <a href="create_user.php">
            <div class="admin_links">Create New User</div>
        </a>
        <a href="delete_user.php">
            <div class="admin_links">Delete a User</div>
        </a>
        <a href="create_book.php">
            <div class="admin_links">Add New Book</div>
        </a>
        <a href="reset_password.php">
            <div class="admin_links">Reset Password</div>
        </a>
    </div>
    <br>
    <h2>Available Books :</h2>
    <div id="books_div"></div>
    <footer>
        Copyright &copy; 2018 Library, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>
