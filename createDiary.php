<?php

session_start();

if (!isset($_SESSION['userId'])) {
    echo '<script type="text/javascript">';
    echo 'window.alert("You need to login first.");';
    echo 'window.location.href = "/Facial-Diary/login.php";'; // Redirect back to login page
    echo '</script>';
}

if (isset($_POST['createDiary'])) {
    $id = $_SESSION['userId'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $createdAt = date('Y-m-d'); // 오늘 날짜
    $facial = $_POST['facial'];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'Facial-Diary';

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

    $query = "INSERT INTO Diary (userId, title, content, facial, createdAt) VALUES ('$id', '$title', '$content', '$facial', '$createdAt');";


    $result = mysqli_query($db, $query) or die(mysqli_error($db));


    echo '<script type="text/javascript">';
    echo 'window.alert("Create Complete");';
    echo 'window.location.href = "/Facial-Diary/myDiary.php";'; // Redirect back to myDiary page
    echo '</script>';

} else {
    echo '<script type="text/javascript">';
    echo 'window.alert("Fail to create new diary");';
    echo 'window.location.href = "/Facial-Diary/write.php";'; // Redirect back to login page
    echo '</script>';
}

?>