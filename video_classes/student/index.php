<?php
    session_start();
    if ($_SESSION["vid"] == "") {
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
    <title>Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../admin/index.css">
    <link rel="stylesheet" href="../admin/add_video.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="load_videos.js"></script>
</head>
<body>
    <?php
        require '../../library/database_conn.php';
        $query = "SELECT * FROM video_classes WHERE ID='".$_SESSION['vid']."'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['NAME'];
            $course_code = $row['PROGRAM_CODE'];
        } else {
            echo "<p style='color:red;text-align:center'>Failed to retrieve student info</p>";
        }
    ?>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br><br><br><br><br>
    <div class="top_div">
        <div class="logout_div">
            <a href="../admin/logout.php"><img src="../images/logout.jpg" alt="logout" width="30px" height="30px"></a>
        </div>
        <div class="username_div">
            <img src="../images/user_logo.jpg" alt="user logo" width="30px" height="30px">
            &nbsp;&nbsp;
            <p id="username"><?php echo $_SESSION["vid"]; ?></p>
            &nbsp;&nbsp;
        </div>
    </div>
    <hr>
    <div class="create_video" style="text-align:center">
        <p class="video_headings">ID : <span class="video_text"><?php echo $_SESSION['vid']?></span></p>
        <p class="video_headings">Name : <span class="video_text"><?php echo $name?></span></p>
        <p class="video_headings">Course Code : <span class="video_text"><?php echo $course_code?></span></p>
    </div>
    <div class="input_div">
        <input type="text" name="search" placeholder="Search Video Title or Couse Code..." id="search_input">
    </div>
    <br>
    <h2>Available Videos :</h2>
    <div id="videos_div"></div>
    <br>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>
