<?php
    session_start();
    if ($_SESSION["uid"] != "admin") {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="manage_hostel/index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br><br><br><br><br><br><br>
    <form action="delete_user.php" method="post" class="hostel_info_form">
        <h2>Delete a User</h2>
        <input type="text" name="id" placeholder="Enter Username" required>
        <br>
        <input type="submit" value="Delete User" class="update_button">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            require '../../library/database_conn.php';
            $id = $_POST["id"];
            $fetch = "SELECT * FROM hostel_students WHERE ID = '$id'";
            $result = mysqli_query($conn, $fetch);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $is_allocated = $row['ROOM'];
                }
                if($is_allocated == null) {
                    $query = "DELETE FROM hostel_students WHERE ID='$id'";
                    if(mysqli_query($conn,$query)) {
                        echo "<p style='color:green;text-align:center'>User '$id' Deleted Successfully. <a href='index.php'>Go back</a></p>";
                    } else {
                        echo "<p style='color:red;text-align:center'>Error Occured while deleting $id. <a href='index.php'>Go back</a></p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center'>Hostel is allocated to Student. Deallocate it first. <a href='index.php'>Go back</a></p>";
                }
            }
            else {
                echo "<p style='color:red;text-align:center'>User with ID '$id' doesn't exist/Error Occured <a href='index.php'>Go back</a></p>";
            }
        }
    ?>
</body>
</html>