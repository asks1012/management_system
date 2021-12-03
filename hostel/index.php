<?php
    session_start();
    if(!isset($_SESSION["uid"])) {
        $_SESSION['uid']='';
    }
    if($_SESSION["uid"] == "admin") {
        header("location: admin/index.php");
    }
    if($_SESSION["uid"] != "") {
        header("location: student/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <script src="../library/index.js"></script>
</head>
<body>
    <div class="logo_container">
        <img src="images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br>
    <div class="boxes">
        <div class="slideshow-container">
            <div class="mySlides">
                <div class="numbertext">1 / 3</div>
                <img class="img" src="images/1.jpg" style="width:100%" alt="UoH image1">
            </div>
            <div class="mySlides">
                <div class="numbertext">2 / 3</div>
                <img class="img" src="images/2.jpg" style="width:100%" alt="UoH image1">
            </div>
            <div class="mySlides">
                <div class="numbertext">3 / 3</div>
                <img class="img" src="images/3.jpg" style="width:100%" alt="UoH image1">
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
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
        Copyright &copy; Hostels, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>