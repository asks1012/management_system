<?php
    session_start();
    if ($_SESSION["uid"] != "admin") {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="load_hostels.js"></script>
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br><br><br><br><br>
    <div class="top_div">
        <div class="logout_div">
            <a href="logout.php"><img src="../images/logout.jpg" alt="logout" width="30px" height="30px"></a>
        </div>
        <div class="username_div">
            <img src="../images/user_logo.jpg" alt="user logo" width="30px" height="30px">
            &nbsp;&nbsp;
            <p id="username"><?php echo $_SESSION["uid"]; ?></p>
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
        <a href="create_hostel.php">
            <div class="admin_links">Create Hostel</div>
        </a>
        <a href="reset_password.php">
            <div class="admin_links">Reset Password</div>
        </a>
    </div>
    <br>
    <div class="input_div">
        <input type="text" name="search" placeholder="Search Hostel Name..." id="search_input">
    </div>
    <br>
    <h2>Available Hostels :</h2>
    <div id="hostels_div"></div>
    <footer>
        Copyright &copy; Hostels, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>
