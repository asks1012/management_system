<?php
    session_start();
    if ($_SESSION["id"] == '') {
        header("location: ../index.php");
    }
    session_unset();
    session_destroy();
    header("location: ../index.php");
?>