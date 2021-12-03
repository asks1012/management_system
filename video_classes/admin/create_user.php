<?php
    session_start();
    if ($_SESSION["vid"] != "admin") {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="add_video.css">
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br><br><br><br><br><br>
    <form action="create_user.php" method="post" class="create_video">
        <h2>Create New User</h2>
        <input type="text" name="id" placeholder="Enter Student ID" required maxlength="14">
        <br>
        <input type="text" name="name" placeholder="Enter Name" required maxlength="99">
        <br>
        <input type="text" name="course_code" placeholder="Enter Course Code" required maxlength="15">
        <br>
        <input type="password" name="password" placeholder="Create Password" required maxlength="40">
        <br>
        <input type="submit" value="Create User" class="submit_button">
    </form>
    <br>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require '../../library/database_conn.php';
            $id = $_POST["id"];
            $name = $_POST["name"];
            $password = md5($_POST["password"]);
            $course_code = $_POST["course_code"];
            $fetch = "SELECT * FROM video_classes WHERE ID = '$id'";
            $result = mysqli_query($conn, $fetch);
            if(mysqli_num_rows($result) > 0) {
                echo "<p style='color: red;text-align:center;'>User with ID '$id' already exists. <a href='index.php'>Go back</a></p>";
            }
            else {
                $query = "INSERT INTO video_classes VALUES ('$id','$password','$course_code','$name')";
                if(mysqli_query($conn, $query)) {
                    echo "<p style='color:green;text-align:center;'>New User Account Created Successfully. <a href='index.php'>Go back</a></p>";
                } else {
                    die("User Creation Failed : ".mysqli_error($conn));
                }
            }
        }
    ?>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>