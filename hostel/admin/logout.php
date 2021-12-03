<?php
    session_start();
    if ($_SESSION["uid"] == '') {
        header("location: ../index.php");
    }
    session_unset();
    session_destroy();
    header("location: ../index.php");
?>