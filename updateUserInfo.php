<?php

session_start();

if (!isset($_SESSION['userId'])) {
    echo "You need to login first.";
    echo "<a href='/Facial-Diary/login.php'>login</a>";
}

if (isset($_POST['update'])) {
    $id = $_SESSION['userId'];
    $pw = $_POST['pw'];
    $nickname = $_POST['nickname'];
    $gender = $_POST['gender'];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'Facial-Diary';

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

    // Create the query to insert the data into the users table
    $query = "UPDATE User SET pw='$pw', nickname='$nickname', gender='$gender' WHERE id='$id'";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    echo '<script type="text/javascript">';
    echo 'window.alert("Update Complete");';
    echo 'window.location.href = "/Facial-Diary/mypage.php";'; // Redirect back to login page
    echo '</script>';

} else {
    echo '<script type="text/javascript">';
    echo 'window.alert("Fail to upadate");';
    echo 'window.location.href = "/Facial-Diary/mypage.php";'; // Redirect back to login page
    echo '</script>';
}

?>