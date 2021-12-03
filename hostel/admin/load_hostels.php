<?php
    session_start();
    if ($_SESSION["uid"] != "admin") {
        header("location: ../index.php");
    }
    
    require '../../library/database_conn.php';
    $query = "SELECT * FROM hostels";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $hostel = $row['NAME'];
            $query = "SELECT COUNT(*) FROM `$hostel`";
            $rooms = mysqli_query($conn,$query);
            while($room = mysqli_fetch_assoc($rooms)) {
                $total_rooms = $room['COUNT(*)'];
            }
            $query = "SELECT COUNT(*) FROM `$hostel` WHERE ALLOCATED_TO IS NULL";
            $free = mysqli_query($conn,$query);
            while($free_room = mysqli_fetch_assoc($free)) {
                $total_free_rooms = $free_room['COUNT(*)'];
            }
            echo "<a class='hostel' href='manage_hostel/index.php?b=$hostel'>";
            echo "<div>";
            echo "<h3>$hostel</h3>";
            echo "<p class='hostel_text'><span class='hostel_headings'>No. of Rooms - </span>$total_rooms</p>";
            echo "<p class='hostel_text'><span class='hostel_headings'>Rooms Free - </span>$total_free_rooms</p>";
            echo "</div>";
            echo "</a>";
        }
    } else {
        echo "0 Hostels Found";
    }
    mysqli_close($conn);
?>