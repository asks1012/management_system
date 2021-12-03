<?php
    session_start();
    if ($_SESSION["id"] != "admin") {
        header("location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book</title>
    <link rel="shortcut icon" href="../../../images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="logo_container">
        <img src="../../images/logo.png" alt="Library Logo" id="logo">
        &nbsp;
        <h1>Library Management System</h1>
    </div>
    <br><br><br><br><br>
    <?php
        require '../../database_conn.php';
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        if (!isset($queries['b']) || $queries['b']=="") {
            header("location: ../index.php");
        }
        $query = "SELECT * FROM books WHERE TITLE='".$queries['b']."'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            echo "<div class='books_taken_div'>";
            echo "<h2>This Book Taken By</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Date</th></tr>";
            $book_title = $queries['b'];
            $query = "SELECT * FROM `$book_title`";
            if($result2 = mysqli_query($conn,$query)) {
                while($row = mysqli_fetch_assoc($result2)) {
                    echo "<tr><td>".$row['STUDENT_ID']."</td><td>".$row['ISSUE_DATE']."</td></tr>";
                }
                if(mysqli_num_rows($result2) == 0) {
                    echo "<tr><td colspan=2>Not Taken by any Student</td></tr>";
                }
            } else {
                echo "<tr><td colspan=2>Not Taken / Could Not Load Data</td></tr>";
            }
            echo "</table>";
            echo "</div>";
            echo "<br>";

            $book_info = mysqli_fetch_assoc($result);
            echo "<form action='' method='POST' target='dummyframe' class='book_info_form'>";
            echo "<h2>Book Info</h2>";
            echo "<label for='title'>Title :</label><br>";
            echo "<input type='text' name='title' readonly required value='".$book_info['TITLE']."'><br>";
            echo "<label for='author'>Author :</label><br>";
            echo "<input type='text' name='author' required value='".$book_info['AUTHOR']."'><br>";
            echo "<label for='country'>Country :</label><br>";
            echo "<input type='text' name='country' required value='".$book_info['COUNTRY']."'><br>";
            echo "<label for='language'>Language :</label><br>";
            echo "<input type='text' name='language' required value='".$book_info['LANGUAGE']."'><br>";
            echo "<label for='pages'>Pages :</label><br>";
            echo "<input type='text' name='pages' required value='".$book_info['PAGES']."'><br>";
            echo "<label for='year'>Year :</label><br>";
            echo "<input type='text' name='year' required value='".$book_info['YEAR']."'><br>";
            echo "<label for='copies'>Copies :</label><br>";
            echo "<input type='text' name='copies' required value='".$book_info['COPIES']."'><br>";
            echo "<input type='submit' name='delete' class='delete_button' value='Delete'>";
            echo "<input type='submit' name='update' class='edit_button' value='Update'>";
            echo "</form>";
        } else {
            die("Failed to get Book details : ".mysqli_connect_error());
        }
        if(isset($_POST["update"])) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $country = $_POST['country'];
            $language = $_POST['language'];
            $pages = $_POST['pages'];
            $year = $_POST['year'];
            $copies = $_POST['copies'];
            require '../../database_conn.php';
            $query = "SELECT * FROM books WHERE TITLE='".$queries['b']."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                $query = "UPDATE books SET
                TITLE = '$title',
                AUTHOR = '$author',
                COUNTRY = '$country',
                LANGUAGE = '$language',
                PAGES = '$pages',
                YEAR = '$year',
                COPIES = '$copies'
                WHERE TITLE='".$queries['b']."'";
                if(mysqli_query($conn, $query)) {
                    $queries['b'] = $title;
                    echo "<script>alert('Book Details Updated Successfully')</script>";
                } else {
                    echo "<script>alert('Failed to Update Book Details : The book title may already exist')</script>";
                }
            }
        }
        if(isset($_POST["delete"])) {
            $book_title = $_POST['title'];
            $query = "SELECT * FROM books WHERE TITLE='".$queries['b']."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                $query = "DELETE FROM books WHERE TITLE='$book_title'";
                if(mysqli_query($conn,$query)) {
                    header("location: ../index.php");
                    exit();
                } else {
                    echo "<script>alert('Could not delete the book')</script>";
                }
            } else {
                echo "<script>alert('Could not delete the book')</script>";
            }
        }
    ?>
    <br>
    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
    <form action="" method="post" class="book_info_form" target="dummyframe">
        <h2>Issue Book To</h2>
        <input type="text" name="id" required placeholder="Enter Student ID">
        <input type="submit" value="OK" name="issue_book" class="ok_button">
    </form>
    <br>
    <form action="" method="post" class="book_info_form" target="dummyframe">
        <h2>Collect Book From</h2>
        <input type="text" name="id" required placeholder="Enter Student ID">
        <input type="submit" value="OK" name="collect_book" class="ok_button">
    </form>
    <?php
        if(isset($_POST["issue_book"])) {
            require '../../database_conn.php';
            $id = $_POST['id'];
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $book_title = $queries['b'];
            $query = "SELECT * FROM students WHERE ID='$id'";
            $result = mysqli_query($conn,$query);
            if($book_info['COPIES'] > 0) {
                if(mysqli_num_rows($result) > 0) {
                    $query = "CREATE TABLE IF NOT EXISTS $id (
                        BOOK_TITLE VARCHAR(100) UNIQUE,
                        ISSUE_DATE DATE,
                        FOREIGN KEY (BOOK_TITLE) REFERENCES books (TITLE)
                    )";
                    if(mysqli_query($conn,$query)) {
                        $date = date('Y-m-d');
                        $query = "INSERT INTO $id VALUES('$book_title','$date')";
                        if(mysqli_query($conn,$query)) {
                            $query = "CREATE TABLE IF NOT EXISTS `$book_title` (
                                STUDENT_ID VARCHAR(15) UNIQUE,
                                ISSUE_DATE DATE,
                                FOREIGN KEY (STUDENT_ID) REFERENCES students (ID)
                            )";
                            if(mysqli_query($conn,$query)) {
                                $query = "INSERT INTO `$book_title` VALUES('$id','$date')";
                                if(mysqli_query($conn,$query)) {
                                    $query = "UPDATE books SET COPIES=COPIES-1 WHERE TITLE='$book_title'";
                                    if (mysqli_query($conn,$query)) {
                                        echo "<script>alert('Book is successfully issued')</script>";
                                    } else {
                                        echo "<script>alert('Failed to update book copies')</script>";
                                    }
                                } else {
                                    echo "<script>alert('Failed to insert data into specific book table')</script>";
                                }
                            } else {
                                echo "<script>alert('Failed to create specific book table')</script>";
                            }
                        } else {
                            echo "<script>alert('Failed to insert into student table (only 1 copy can be issued to a student)')</script>";
                        }
                    } else {
                        echo "<script>alert('Failed to create table for student')</script>";
                    }
                } else {
                    echo "<script>alert('User ID does not exist')</script>";
                }
            } else {
                echo "<script>alert('Book Copies are insufficient')</script>";
            }
        }


        if(isset($_POST["collect_book"])) {
            require '../../database_conn.php';
            $id = $_POST['id'];
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $book_title = $queries['b'];
            $query = "SELECT * FROM students WHERE ID='$id'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0) {
                $query = "SELECT * FROM $id WHERE BOOK_TITLE='$book_title'";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0) {
                    $query = "DELETE FROM $id WHERE BOOK_TITLE='$book_title'";
                    if(mysqli_query($conn,$query)) {
                        $query = "DELETE FROM `$book_title` WHERE STUDENT_ID='$id'";
                        if(mysqli_query($conn,$query)) {
                            $query = "UPDATE books SET COPIES=COPIES+1 WHERE TITLE='$book_title'";
                            if(mysqli_query($conn,$query)) {
                                echo "<script>alert('Successfully Collected Book')</script>";
                            }  else {
                                echo "<script>alert('Could not update the copies of book')</script>";
                            }                         
                        } else {
                            echo "<script>alert('Could not delete student name from book table')</script>";
                        }
                    } else {
                        echo "<script>alert('Could not delete book from student table')</script>";
                    }
                } else {
                    echo "<script>alert('This book is not taken by $id')</script>";
                }
            } else {
                echo "<script>alert('User ID does not exist')</script>";
            }
        }
    ?>
    <br>
    <footer>
        Copyright &copy; 2018 Library, University of Hyderabad, Prof. CR Rao Road, Gachibowli, Hyderabad, Telangana, India-500046
    </footer>
</body>
</html>