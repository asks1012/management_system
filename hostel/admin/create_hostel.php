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
    <title>Create New Hostel</title>
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="create_hostel.css">
</head>
<body>
    <div class="logo_container">
        <img src="../images/logo.jpg" alt="Hostel Logo" id="logo">
        &nbsp;
        <h1>Hostel Management System</h1>
    </div>
    <br><br><br><br><br>
    <form action='create_hostel.php' method='POST' class='create_hostel_form' >
    <h2>Create Hostel</h2>
    <input type='text' name='name' required placeholder='Enter Hostel Name'><br>
    <input type='submit' name='create_hostel' class='submit_button' value='Create Hostel'>
    </form>
    <br>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST') {
            require '../../library/database_conn.php';
            $name = $_POST['name'];
            $query = "CREATE TABLE `$name` (
                ROOM_NUMBER INT,
                ALLOCATED_TO VARCHAR(15),
                PRIMARY KEY (ROOM_NUMBER),
                FOREIGN KEY (ALLOCATED_TO) REFERENCES hostel_students (ID)
            )";
            if(mysqli_query($conn, $query)) {
                $query = "CREATE TABLE IF NOT EXISTS hostels (
                    NAME VARCHAR(15),
                    PRIMARY KEY (NAME)
                )";
                if(mysqli_query($conn,$query)) {
                    $query = "INSERT INTO hostels VALUES ('$name')";
                    if(mysqli_query($conn,$query)) {
                        echo "<p style='color: green;text-align:center'>Hostel Created Successfully. <a href='index.php'>Go Back</a></p>";
                    } else {
                        echo "<p style='color: red;text-align:center'>Could not insert into hostels table. <a href='index.php'>Go Back</a></p>";
                        echo mysqli_error($conn);
                    }
                } else {
                    echo "<p style='color: red;text-align:center'>Could not create hostels table. <a href='index.php'>Go Back</a></p>";
                }
            } else {
                echo "<p style='color: red;text-align:center'>Hostel Already Exists / Could not Create Hostel. <a href='index.php'>Go Back</a></p>";
                echo mysqli_error($conn);
            }
        }
    ?>
    <footer>
        Copyright &copy; Hostels, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>