<?php
    session_start();
    if ($_SESSION["uid"] == "") {
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <title>Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../admin/index.css">
    <link rel="stylesheet" href="../admin/manage_hostel/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="load_hostels.js"></script>
</head>
<body>
    <?php
        require '../../library/database_conn.php';
        $query = "SELECT * FROM hostel_students WHERE ID='".$_SESSION['uid']."'";
        if($result = mysqli_query($conn,$query)) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['NAME'];
            $date = $row['DATE_ALLOTED'];
            if($date==null) $date='N/A';
            $hostel = $row['HOSTEL'];
            if($hostel==null) $hostel='N/A';
            $room = $row['ROOM'];
            if($room==null) $room='N/A';
        } else {
            echo "<p style='color:red;text-align:center'>Error Occured</p>";
        }
    ?>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br><br><br><br><br>
    <div class="top_div">
        <div class="logout_div">
            <a href="../admin/logout.php"><img src="../images/logout.jpg" alt="logout" width="30px" height="30px"></a>
        </div>
        <div class="username_div">
            <img src="../images/user_logo.jpg" alt="user logo" width="30px" height="30px">
            &nbsp;&nbsp;
            <p id="username"><?php echo $_SESSION["uid"]; ?></p>
            &nbsp;&nbsp;
        </div>
    </div>
    <hr>
    <br>
    <div class="hostel_info_form" style="text-align:center">
        <h2>Student Info</h2>
        <p class='hostel_headings'>ID : <span class='hostel_text'><?php echo $_SESSION['uid']?></span></p>
        <p class='hostel_headings'>Name : <span class='hostel_text'><?php echo $name?></span></p>
        <p class='hostel_headings'>Hostel : <span class='hostel_text'><?php echo $hostel?></span></p>
        <p class='hostel_headings'>Room : <span class='hostel_text'><?php echo $room?></span></p>
        <p class='hostel_headings'>Date Alloted : <span class='hostel_text'><?php echo $date?></span></p>
    </div>
    <br>
    <div class="input_div">
        <input type="text" name="search" placeholder="Search Hostel Name..." id="search_input">
    </div>
    <br>
    <h2>Available Hostels :</h2>
    <div id="hostels_div"></div>
    <br><br>
    <footer>
        Copyright &copy; Hostels, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>
