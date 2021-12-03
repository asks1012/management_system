<?php
    session_start();
    if ($_SESSION["vid"] != "admin") {
        header("location: ../index.php");
    }
    
    require '../../library/database_conn.php';
    $query = "SELECT * FROM videos";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row['TITLE'];
            $description = $row['DESCRIPTION'];
            $course_code = $row['COURSE_CODE'];
            $url = $row['URL'];
            echo "<a class='video' href='manage_video/index.php?b=$title'>";
            echo "<div>";
            echo "<p class='video_headings'>Title :</p>";
            echo "<p class='video_text'>$title</p>";
            echo "<p class='video_headings'>Description :</p>";
            echo "<p class='video_text'>$description</p>";
            echo "<p class='video_headings'>Course Code :</p>";
            echo "<p class='video_text'>$course_code</p>";
            echo "<div class='iframe-container'>
                <iframe frameborder='0' allowfullscreen 
                src='".$url."'></iframe>
                </div>";
            echo "</div>";
            echo "</a>";
        }
    } else {
        echo "0 Hostels Found";
    }
    mysqli_close($conn);
?>