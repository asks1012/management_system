<?php
    session_start();
    if(!isset($_SESSION["vid"])) {
        $_SESSION['vid']='';
    }
    if($_SESSION["vid"] == "admin") {
        header("location: admin/index.php");
    }
    if($_SESSION["vid"] != "") {
        header("location: student/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Classes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="logo_container">
        <img src="images/logo.jpg" alt="Video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br>
    <div class="boxes">
        <div class="slideshow-container">
            <div class="mySlides">
                <img class="img" src="images/1.jpg" style="width:100%" alt="UoH image1">
            </div>
        </div>
        <div class="login_div">
            <p class="error">
            <?php
                if (isset($_SESSION["error"])) {
                    session_unset();
                    session_destroy();
                    echo 'Invalid Credentials';
                }
            ?>
            </p>
            <form action="verify_login.php" method="post">
                <h2>Login</h2>
                <input type="text" name="id" class="input" placeholder="Enter Student ID" required>
                <br>
                <input type="password" name="password" class="input" placeholder="Enter Password" required>
                <br>
                <input type="submit" value="Login" class="submit">
                <p class="suggestion">Don't have account? Contact Administrator</p>
            </form>
        </div>
    </div>
    <br><br>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>