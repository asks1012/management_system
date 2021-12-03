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
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="create_user.css">
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.png" alt="Library Logo" id="logo">
        &nbsp;
        <h1>Library Management System</h1>
    </div>
    <br><br><br><br><br><br>
    <form action="reset_password.php" method="post" class="create_user_form">
        <h2>Reset Password</h2>
        <input type="text" name="id" class="input" placeholder="Enter Student ID" required>
        <br>
        <input type="password" name="password" class="input" placeholder="Enter Password" required>
        <br>
        <input type="submit" value="Reset Password" class="create_user_submit">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require '../database_conn.php';
            $id = $_POST["id"];
            $password = md5($_POST["password"]);
            $fetch = "SELECT * FROM students WHERE ID = '$id'";
            $result = mysqli_query($conn, $fetch);
            if(mysqli_num_rows($result) > 0) {
                $query = "UPDATE students SET PASSWORD='$password' WHERE ID='$id'";
                if(mysqli_query($conn, $query)) {
                    echo "<p class='success'>Reset Password Successful. <a href='index.php'>Go back</a></p>";
                } else {
                    echo "<p class='error'>Failed to Reset Password. <a href='index.php'>Go back</a></p>";
                }
            }
            else {
                echo "<p class='error'>Student ID does not exist. <a href='index.php'>Go back</a></p>";
            }
        }
    ?>
</body>
</html>