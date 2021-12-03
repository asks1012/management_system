<?php
    session_start();
    if ($_SESSION["uid"] != "admin") {
        header("location: index.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '../library/database_conn.php';
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $fetch = "SELECT * FROM hostel_students WHERE ID = '$id' AND PASSWORD = '$password'";
        $result = mysqli_query($conn, $fetch);
        if(mysqli_num_rows($result) > 0) {
            if ($id=="admin") {
                $_SESSION['uid'] = 'admin';
                header('location: admin');
            } else {
                $_SESSION['uid'] = $id;
                header('location: student');
            }
        }
        else {
            $_SESSION["error"] = 1;
            header('location: index.php');
        }
    }
?>