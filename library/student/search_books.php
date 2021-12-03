<?php
    session_start();
    if ($_SESSION["id"] == "") {
        header("location: ../index.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '../database_conn.php';
        $input = $_POST['input'];
        $query = "SELECT * FROM books WHERE TITLE LIKE '%$input%'";
        $result = mysqli_query($conn, $query);
        $rows = array();
        if (mysqli_num_rows($result) > 0) {
            while($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        } else {
            echo json_encode("");
        }
        mysqli_close($conn);
    }
?>