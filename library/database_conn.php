<?php
    // Connecting to the MySQL
    $conn = mysqli_connect('localhost', 'root', '');
    if(!$conn) {
        die("Connection Failed : ".mysqli_connect_error());
    }

    //Selecting the "uoh" database
    if(!mysqli_select_db($conn, "uoh")) {
        die("Error Selecting Database : ".mysqli_error($conn));
    }
?>