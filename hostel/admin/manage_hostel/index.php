<?php
    session_start();
    if ($_SESSION["uid"] != "admin") {
        header("location: ../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hostel</title>
    <link rel="shortcut icon" href="../../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../../images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br><br><br><br><br>
    <?php
        require '../../../library/database_conn.php';
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $hostel = $queries['b'];
        if (!isset($queries['b']) || $queries['b']=="") {
            header("location: ../index.php");
        }
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
    ?>
    <div>
        <form action="index.php?b=<?php echo $hostel?>" method="post" class="hostel_info_form">
            <h2>Hostel Info</h2>
            <label for="name">Hostel Name : </label>
            <br>
            <input type="text" name="name" value="<?php echo $hostel ?>">
            <br>
            <label for="rooms">No. of Rooms :</label>
            <br>
            <input type="text" name="rooms" value="<?php echo $total_rooms?>" readonly>
            <br>
            <label for="free">Free Rooms : </label>
            <br>
            <input type="text" name="free" value="<?php echo $total_free_rooms ?>" readonly>
            <input type="submit" name="delete" value="Delete Hostel" class="delete_button">
            <input type="submit" name="update" value="Update Hostel" class="update_button">
        </form>
    </div>
    <?php
        if(isset($_POST['update'])) {
            $name = $_POST['name'];
            $query = "SELECT * FROM hostels WHERE NAME='$name'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 0) {
                $query = "SELECT * FROM hostel_students WHERE HOSTEL='$hostel'";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $query = "UPDATE hostel_students SET HOSTEL='$name' WHERE ID='".$row['ID']."'";
                        if(!mysqli_query($conn,$query)) {
                            echo "<p style='color:red;text-align:center;'>Could not update hostel_students table. <a href='../index.php'>Go Back</a></p>";
                        }
                    }
                }
                $query = "UPDATE hostels SET NAME='$name' WHERE NAME='$hostel'";
                if(mysqli_query($conn,$query)) {
                    $query = "RENAME TABLE `$hostel` to `$name`";
                    if(mysqli_query($conn,$query)) {
                        header("location: ../index.php");
                    } else {
                        echo "<p style='color:red;text-align:center;'>Could not Rename $hostel table. <a href='../index.php'>Go Back</a></p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Could not update hostels table. <a href='../index.php'>Go Back</a></p>";
                }
            } else {
                echo "<p style='color:red;text-align:center;'>Hostel with name $name already exists. <a href='../index.php'>Go Back</a></p>";
            }
        }
        if(isset($_POST['delete'])) {
            $query = "SELECT * FROM `$hostel` WHERE ALLOCATED_TO IS NOT NULL";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 0) {
                $query = "DELETE FROM hostels WHERE NAME='$hostel'";
                if(mysqli_query($conn,$query)) {
                    $query = "DROP TABLE `$hostel`";
                    if(mysqli_query($conn,$query)) {
                        header("location: ../index.php");
                    } else {
                        echo "<p style='color:red;text-align:center;'>Could not delete $hostel table. <a href='../index.php'>Go Back</a></p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Could not delete hostel from hostels table. <a href='../index.php'>Go Back</a></p>";
                }
            } else if(mysqli_num_rows($result) > 0) {
                echo "<p style='color:red;text-align:center;'>Hostel Rooms are Not Free. <a href='../index.php'>Go Back</a></p>";
            } else {
                echo "<p style='color:red;text-align:center;'>Error Occured. <a href='../index.php'>Go Back</a></p>";
            }
        }
    ?>
    <br>
    <form action="index.php?b=<?php echo $hostel?>" method="post" class="hostel_info_form">
        <h2>Add Room in <?php echo $hostel?></h2>
        <input type="text" name="room_no" required placeholder="Enter Room Number">
        <input type="submit" value="Add Room" name="add_room" class="update_button">
    </form>
    <?php
        if(isset($_POST['add_room'])) {
            $room_no = $_POST['room_no'];
            $query = "SELECT * FROM `$hostel` WHERE ROOM_NUMBER='$room_no'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0) {
                echo "<p style='color:red;text-align:center;'>Room Number $room_no Already Exists!. <a href='../index.php'>Go Back.</a></p>";
            } else if(mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO `$hostel` (ROOM_NUMBER) VALUES ('$room_no')";
                if(mysqli_query($conn,$query)) {
                    echo "<p style='color:green;text-align:center;'>Successfully Added Room '$room_no' in '$hostel'. <a href='../index.php'>Go Back.</a></p>";
                } else {
                    echo "<p style='color:red;text-align:center;'>Could not insert room into hostel table!</p>";
                }
            } else {
                echo "<p style='color:red;text-align:center;'>Error Occured!</p>";
            }
        }
    ?>
    <br>
    <form action="index.php?b=<?php echo $hostel?>" method="post" class="hostel_info_form">
        <h2>Delete Room in <?php echo $hostel?></h2>
        <input type="text" name="room_no" required placeholder="Enter Room Number">
        <input type="submit" value="Delete Room" name="delete_room" class="delete_button">
    </form>
    <?php
        if(isset($_POST['delete_room'])) {
            $room_no = $_POST['room_no'];
            $query = "SELECT * FROM `$hostel` WHERE ROOM_NUMBER='$room_no'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $is_free = $row['ALLOCATED_TO'];
                }
                if($is_free == NULL) {
                    $query = "DELETE FROM `$hostel` WHERE ROOM_NUMBER='$room_no'";
                    if(mysqli_query($conn,$query)) {
                        echo "<p style='color:green;text-align:center;'>Successfully Deleted Room '$room_no' in '$hostel'. <a href='../index.php'>Go Back.</a></p>";
                    } else {
                        echo "<p style='color:red;text-align:center;'>Could not Delete room-$room_no in hostel table!</p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Room Number $room_no is Not Free!. <a href='../index.php'>Go Back.</a></p>";
                }
            } else if(mysqli_num_rows($result) == 0) {
                echo "<p style='color:red;text-align:center;'>Room Number $room_no Does not Exist!. <a href='../index.php'>Go Back.</a></p>";
            } else {
                echo "<p style='color:red;text-align:center;'>Error Occured!</p>";
            }
        }
    ?>
    <br>
    <form action="index.php?b=<?php echo $hostel?>" method="post" class="hostel_info_form">
        <h2>Allocate Room in <?php echo $hostel?></h2>
        <input type="text" name="id" required placeholder="Enter Student ID">
        <input type="number" name="room_no" required placeholder="Enter Room Number">
        <input type="submit" value="Allocate Room" name="allocate_room" class="update_button">
    </form>
    <?php
        if(isset($_POST['allocate_room'])) {
            $id = $_POST['id'];
            $room_no = $_POST['room_no'];
            $query = "SELECT * FROM hostel_students WHERE ID='$id'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 0) {
                echo "<p style='color:red;text-align:center;'>No Account found with Student ID $id. <a href='../index.php'>Go Back.</a></p>";
            } else if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $room = $row['ROOM'];
                }
                if($room == null) {
                    $query = "SELECT * FROM `$hostel` WHERE ROOM_NUMBER='$room_no'";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result) == 0) {
                        echo "<p style='color:red;text-align:center;'>Room Number $room_no Does not exist in $hostel. <a href='../index.php'>Go Back.</a></p>";
                    } else if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $is_free = $row['ALLOCATED_TO'];
                        }
                        if($is_free == null) {
                            $query = "UPDATE `$hostel` SET ALLOCATED_TO='$id' WHERE ROOM_NUMBER='$room_no'";
                            if(mysqli_query($conn,$query)) {
                                $date = date('Y-m-d');
                                $query = "UPDATE hostel_students SET
                                DATE_ALLOTED='$date',
                                HOSTEL='$hostel',
                                ROOM='$room_no'
                                WHERE ID='$id'";
                                if(mysqli_query($conn,$query)) {
                                    echo "<p style='color:green;text-align:center;'>Successfully Allocated Room-$room_no to $id <a href='../index.php'>Go Back.</a></p>";
                                } else {
                                    echo "<p style='color:red;text-align:center;'>Could not insert hostel details in hostel_students table. <a href='../index.php'>Go Back.</a></p>";
                                }
                            } else {
                                echo "<p style='color:red;text-align:center;'>Could not insert student id in $hostel table. <a href='../index.php'>Go Back.</a></p>";
                            }
                        } else {
                            echo "<p style='color:red;text-align:center;'>Room $room_no is Not Free. <a href='../index.php'>Go Back.</a></p>";
                        }
                    } else {
                        echo "<p style='color:red;text-align:center;'>Could not retrieve Room Details. <a href='../index.php'>Go Back.</a></p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Room Number $room is already allocated to $id. <a href='../index.php'>Go Back.</a></p>";
                }
            } else {
                echo "<p style='color:red;text-align:center;'>Error Occured. <a href='../index.php'>Go Back.</a></p>";
            }
        }
    ?>
    <br>
    <form action="index.php?b=<?php echo $hostel?>" method="post" class="hostel_info_form">
        <h2>Deallocate Room in <?php echo $hostel?></h2>
        <input type="text" name="id" required placeholder="Enter Student ID">
        <input type="number" name="room_no" required placeholder="Enter Room Number">
        <input type="submit" value="Deallocate Room" name="deallocate_room" class="delete_button">
    </form>
    <?php
        if(isset($_POST['deallocate_room'])) {
            $id = $_POST['id'];
            $room_no = $_POST['room_no'];
            $query = "SELECT * FROM hostel_students WHERE ID='$id'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 0) {
                echo "<p style='color:red;text-align:center;'>No Account found with Student ID $id. <a href='../index.php'>Go Back.</a></p>";
            } else if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $room = $row['ROOM'];
                }
                if($room == $room_no) {
                    $query = "SELECT * FROM `$hostel` WHERE ROOM_NUMBER='$room_no'";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result) == 0) {
                        echo "<p style='color:red;text-align:center;'>Room Number $room_no Does not exist in $hostel. <a href='../index.php'>Go Back.</a></p>";
                    } else if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $is_free = $row['ALLOCATED_TO'];
                        }
                        if($is_free == null) {
                            echo "<p style='color:red;text-align:center;'>Room $room_no is Not Allocated to Anyone. <a href='../index.php'>Go Back.</a></p>";
                        } else {
                            $query = "UPDATE `$hostel` SET ALLOCATED_TO=NULL WHERE ROOM_NUMBER='$room_no'";
                            if(mysqli_query($conn,$query)) {
                                $query = "UPDATE hostel_students SET
                                DATE_ALLOTED=NULL,
                                HOSTEL=NULL,
                                ROOM=NULL
                                WHERE ID='$id'";
                                if(mysqli_query($conn,$query)) {
                                    echo "<p style='color:green;text-align:center;'>Successfully Deallocated Room-$room_no for $id <a href='../index.php'>Go Back.</a></p>";
                                } else {
                                    echo "<p style='color:red;text-align:center;'>Could not update hostel details in hostel_students table. <a href='../index.php'>Go Back.</a></p>";
                                }
                            } else {
                                echo "<p style='color:red;text-align:center;'>Could not update $hostel table. <a href='../index.php'>Go Back.</a></p>";
                            }
                        }
                    } else {
                        echo "<p style='color:red;text-align:center;'>Could not retrieve Room Details. <a href='../index.php'>Go Back.</a></p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Room Number $room is Not alloted to $id. <a href='../index.php'>Go Back.</a></p>";
                }
            } else {
                echo "<p style='color:red;text-align:center;'>Error Occured. <a href='../index.php'>Go Back.</a></p>";
            }
        }
    ?>
    <br>
    <?php
        echo "<div class='hostel_alloc_div'>";
        echo "<h2>Hostel Allocation Info</h2>";
        echo "<table>";
        echo "<tr><th>Room Number</th><th>Alloted To</th></tr>";
        $query = "SELECT * FROM `$hostel` ORDER BY ROOM_NUMBER";
        if($result = mysqli_query($conn,$query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row['ROOM_NUMBER']."</td><td>".$row['ALLOCATED_TO']."</td></tr>";
            }
            if(mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan=2>No Rooms in $hostel</td></tr>";
            }
        } else {
            echo "<tr><td colspan=2>No Rooms / Could not Load Rooms</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    ?>
    <br>
    <footer>
        Copyright &copy; Hostels, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>