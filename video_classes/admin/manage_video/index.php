<?php
    session_start();
    if ($_SESSION["vid"] != "admin") {
        header("location: ../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Video</title>
    <link rel="shortcut icon" href="../../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../add_video.css">
</head>
<body>
    <div class="logo_container">
        <img src="../../images/logo.jpg" alt="Video Logo" id="logo">
        &nbsp;
        <h1>Video Classes</h1>
    </div>
    <br><br><br><br><br>
    <?php
        require '../../../library/database_conn.php';
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $video = $queries['b'];
        if (!isset($queries['b']) || $queries['b']=="") {
            header("location: ../index.php");
        }
        $query = "SELECT * FROM videos WHERE TITLE='$video'";
        if($result = mysqli_query($conn,$query)) {
            $row = mysqli_fetch_assoc($result);
            $description = $row['DESCRIPTION'];
            $course_code = $row['COURSE_CODE'];
            $url = $row['URL'];
        } else {
            echo "<p style='color:red;text-align:center'>Could not get video details.</p>";
        }
    ?>
    <form action="index.php?b=<?php echo $video?>" method="post" class="create_video">
        <h2>Video Info</h2>
        <label for="title">Video Title : </label>
        <br>
        <input type="text" name="title" value="<?php echo $video ?>" required maxlength="99">
        <br>
        <label for="description">Description :</label>
        <br>
        <textarea name="description" id="" cols="30" rows="10" required maxlength="199"><?php echo $description?></textarea>
        <br>
        <label for="course_code">Course Code : </label>
        <br>
        <input type="text" name="course_code" value="<?php echo $course_code ?>" required maxlength="14">
        <br>
        <label for="url">Video URL : </label>
        <br>
        <input type="text" name="url" value="<?php echo $url ?>" required maxlength="199">
        <input type="submit" name="delete" value="Delete Video" class="delete_button">
        <input type="submit" name="update" value="Update Video" class="submit_button">
    </form>
    <?php
        if(isset($_POST['update'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $course_code = $_POST['course_code'];
            $url = $_POST['url'];
            $query = "SELECT * FROM videos WHERE TITLE='$title'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0 && $title != $video) {
                echo "<p style='color:red;text-align:center'>Video Title $title already exists. <a href='../index.php'>Go Back.</a></p>";
            } else if((mysqli_num_rows($result) == 1 && $title==$video) || mysqli_num_rows($result)==0) {
                $query = "UPDATE videos SET
                        TITLE = '$title',
                        DESCRIPTION = '$description',
                        COURSE_CODE = '$course_code',
                        URL = '$url'
                        WHERE TITLE='$video'";
                if(mysqli_query($conn,$query)) {
                    echo "<p style='color:green;text-align:center'>Successfully Updated Video Details. <a href='../index.php'>Go Back.</a></p>";
                } else {
                    echo "<p style='color:red;text-align:center'>Failed to update video details. <a href='../index.php'>Go Back.</a></p>";
                }
            } else {
                echo "<p style='color:red;text-align:center'>Error Occured. <a href='../index.php'>Go Back.</a></p>";
            }
        }
        if(isset($_POST['delete'])) {
            $query = "DELETE FROM videos WHERE TITLE='$video'";
            if(mysqli_query($conn,$query)) {
                header("location: ../index.php");
            } else {
                echo "<p style='color:red;text-align:center'>Could not delete video. <a href='../index.php'>Go Back.</a></p>";
            }
        }
    ?>
    <br>
    <footer>
        Copyright &copy; Video Classes, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>