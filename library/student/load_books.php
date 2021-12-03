<?php
    session_start();
    if ($_SESSION["id"] == "") {
        header("location: ../index.php");
    }
    
    require '../database_conn.php';
    $query = "SELECT * FROM books";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='book'>";
            echo "<p class='book_text'><span class='book_headings'>Title : </span>";
            echo $row['TITLE']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Author : </span>";
            echo $row['AUTHOR']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Country : </span>";
            echo $row['COUNTRY']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Language : </span>";
            echo $row['LANGUAGE']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Pages : </span>";
            echo $row['PAGES']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Year : </span>";
            echo $row['YEAR']."</p>";
            echo "<p class='book_text'><span class='book_headings'>Copies : </span>";
            echo $row['COPIES']."</p>";
            echo "</div>";
        }
    } else {
        echo "0 Books Found";
    }
    mysqli_close($conn);
?>