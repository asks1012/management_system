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
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="add_video.css">
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br><br><br><br><br><br>
    <form action="reset_password.php" method="post" class="create_video">
        <h2>Reset Password</h2>
        <input type="text" name="id" placeholder="Enter Student ID" required>
        <br>
        <input type="password" name="password" placeholder="Enter New Password" required>
        <br>
        <input type="submit" value="Reset Password" class="submit_button">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require '../../library/database_conn.php';
            $id = $_POST["id"];
            $password = md5($_POST["password"]);
            $fetch = "SELECT * FROM video_classes WHERE ID = '$id'";
            $result = mysqli_query($conn, $fetch);
            if(mysqli_num_rows($result) > 0) {
                $query = "UPDATE video_classes SET PASSWORD='$password' WHERE ID='$id'";
                if(mysqli_query($conn, $query)) {
                    echo "<p style='color:green;text-align:center;'>Reset Password Successful. <a href='index.php'>Go back</a></p>";
                } else {
                    echo "<p style='color:red;text-align:center;'>Failed to Reset Password. <a href='index.php'>Go back</a></p>";
                }
            }
            else {
                echo "<p style='color:red;text-align:center;'>Student ID does not exist/Failed to Update Password. <a href='index.php'>Go back</a></p>";
            }
        }
    ?>
    <br>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>