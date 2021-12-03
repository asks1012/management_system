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
    <title>Create New Hostel</title>
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="add_video.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br><br><br><br><br>
    <form action='add_video.php' method='POST' class='create_video' >
    <h2>Add Video</h2>
    <input type='text' name='title' required maxlength="99" placeholder='Enter Video Title'><br>
    <textarea name="description" cols="30" rows="10" required placeholder="Enter Video Description" maxlength="199"></textarea><br>
    <input type='text' name='course_code' required maxlength="14" placeholder='Enter Course Code'><br>
    <input type='text' name='video_code' required maxlength="20" placeholder='Enter Youtube Video Code (Ex: AhP5Tg_BLIk)'><br>
    <input type='submit' name='create_video' class='submit_button' value='Add Video'>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST') {
            require '../../library/database_conn.php';
            $title = $_POST['title'];
            $description = $_POST['description'];
            $course_code = $_POST['course_code'];
            $video_code = $_POST['video_code'];
            $url = "https://www.youtube.com/embed/".$video_code;
            $query = "SELECT * FROM videos WHERE TITLE='$title'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0) {
                echo "<p style='color: red;text-align:center'>Video Title Already Exists. <a href='index.php'>Go Back</a></p>";
            } else if(mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO videos VALUES (
                    '$title',
                    '$description',
                    '$course_code',
                    '$url'
                )";
                if(mysqli_query($conn,$query)) {
                    echo "<p style='color: green;text-align:center'>Successfully Added Video. <a href='index.php'>Go Back</a></p>";
                } else {
                    echo "<p style='color: red;text-align:center'>Could not add video. <a href='index.php'>Go Back</a></p>";
                }
            } else {
                echo "<p style='color: red;text-align:center'>Error Occured. <a href='index.php'>Go Back</a></p>";
            }
        }
    ?>
    <h2>How to Get the Video Code From Youtube :</h2>
    <div class="help_image_div">
        <img src="../images/help.png" alt="help image" class="help_image">
    </div>
    <br><br>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>