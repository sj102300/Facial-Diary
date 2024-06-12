<?php
session_unset();

session_start();
if (isset($_POST['login'])) {

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'Facial-Diary';

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

    $userId = $_POST['id'];
    // Fetch user data

    $query = "SELECT * FROM `User` WHERE id = '$userId';";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));


    if ($row = mysqli_fetch_assoc($result)) {
        if ($_POST['pw'] != $row["pw"]){
            echo '<script type="text/javascript">';
            echo 'window.alert("Wrong password!");';
            echo 'window.location.href = "/Facial-Diary/login.php";'; // Redirect back to login page
            echo '</script>';
        }
        else {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['nickname'] = $row['nickname'];
            echo '<script type="text/javascript">';
            // echo 'window.alert("Login success!");';
            echo 'window.location.href = "/Facial-Diary/mypage.php";'; // Redirect to mypage
            echo '</script>';
        }
    } else {
        die("User not found.");
    }

    $id = htmlspecialchars($row['id']);
    $pw = htmlspecialchars($row['pw']);
    $nickname = htmlspecialchars($row['nickname']);
    $gender = htmlspecialchars($row['gender']);

}
?>
