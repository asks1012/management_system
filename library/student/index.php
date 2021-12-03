<?php
    session_start();
    if ($_SESSION["id"] == '') {
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
    <link rel="stylesheet" href="../admin/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="load_books.js"></script>
    <link rel="stylesheet" href="index.css">
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
            <a href="../admin/logout.php"><img src="../images/logout.png" alt="logout" width="30px" height="30px"></a>
        </div>
        <div class="username_div">
            <img src="../images/user_logo.jpg" alt="user logo" width="30px" height="30px">
            &nbsp;&nbsp;
            <p id="username"><?php echo $_SESSION["id"]; ?></p>
            &nbsp;&nbsp;
        </div>
    </div>
    <hr>
    </div>
    <div class="input_div">
        <input type="text" name="search" placeholder="Search Book Title..." id="search_input">
    </div>

    <?php
        require '../database_conn.php';
        $query = "SELECT * FROM ".$_SESSION["id"];
        echo "<div class='books_taken_div'>";
        echo "<h2>Books Taken</h2>";
        echo "<table>";
        echo "<tr><th>Book Title</th><th>Date</th></tr>";
        if($result = mysqli_query($conn,$query)) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row['BOOK_TITLE']."</td><td>".$row['ISSUE_DATE']."</td></tr>";
            }
            if(mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan=2>No Books Taken</td></tr>";
            }
        } else {
            echo "<tr><td colspan=2>No Books Taken/Could not Load Data</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    ?>
    <br>
    <h2>Available Books :</h2>
    <div id="books_div"></div>
    <br><br>
    <footer>
        Copyright &copy; 2018 Library, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>
