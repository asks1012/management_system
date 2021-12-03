<?php
    session_start();
    if ($_SESSION["uid"] == "") {
        header("location: ../index.php");
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require '../../library/database_conn.php';
        $input = $_POST['input'];
        $query = "SELECT * FROM hostels WHERE NAME LIKE '%$input%'";
        $result = mysqli_query($conn, $query);
        $hostels = array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $temp = array();
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
                $temp['NAME'] = $hostel;
                $temp['TOTAL_ROOMS'] = $total_rooms;
                $temp['FREE_ROOMS'] = $total_free_rooms;
                array_push($hostels,$temp);
            }
            echo json_encode($hostels);
        } else {
            echo json_encode("");
        }
        mysqli_close($conn);
    }
?>