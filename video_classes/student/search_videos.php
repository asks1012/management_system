<?php
    session_start();
    if ($_SESSION["vid"] == "") {
        header("location: ../index.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '../../library/database_conn.php';
        $input = $_POST['input'];
        $query = "SELECT * FROM videos WHERE TITLE LIKE '%$input%'
                  UNION 
                  SELECT * FROM videos WHERE COURSE_CODE LIKE '%$input%'";
        $result = mysqli_query($conn, $query);
        $videos = array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $temp = array();
                $temp['TITLE'] = $row['TITLE'];
                $temp['DESCRIPTION'] = $row['DESCRIPTION'];
                $temp['COURSE_CODE'] = $row['COURSE_CODE'];
                $temp['URL'] = $row['URL'];
                array_push($videos,$temp);
            }
            echo json_encode($videos);
        } else {
            echo json_encode("");
        }
        mysqli_close($conn);
    }
?>