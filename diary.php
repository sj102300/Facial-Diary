<?php
session_start();

if (!isset($_SESSION['userId'])) {
    echo "You need to login first.";
    echo "<a href='/Facial-Diary/login.php'>login</a>";
    exit();
}

if (!isset($_GET['postId'])) {
    echo "Invalid post ID.";
    exit();
}

$postId = $_GET['postId'];

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Facial-Diary';

$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$query = "SELECT * FROM Diary WHERE postId = '$postId' AND userId = '{$_SESSION['userId']}'";
$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Post not found or you do not have permission to view it.";
    exit();
}

$post = mysqli_fetch_assoc($result);
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Detail</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #006064;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        nav {
            width: 100%;
            background-color: #e0f7fa;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 40px;
            align-items: center;
        }

        nav h1 {
            margin: 0 10px;
            color: #006064;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 0;
        }

        nav ul a {
            text-decoration: none;
            color: #006064;
            margin: 0 15px;
            font-size: 18px;
        }

        nav ul a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 800px;
            padding: 20px;
            margin-top: 60px;
            box-sizing: border-box;
        }

        .diarybox {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid lightgrey;
            gap: 10px;
            padding: 20px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f0f0f0;
        }

        .diarybox img {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        .diarybox p {
            margin: 0;
            color: #333333;
        }

        .diarybox h2 {
            margin: 0;
            color: #006064;
        }

        .diarybox .content {
            margin-top: 10px;
            text-align: left;
            width: 100%;
            color: #444444;
        }

        @media (max-width: 600px) {
            nav h1 {
                font-size: 20px;
            }

            nav ul a {
                font-size: 16px;
                margin: 0 10px;
            }

            .container {
                padding: 80px 10px 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <main class="container">
        <div class="diarybox">
            <?php
            if ($post['facial'] === 'good') {
                echo '<img src="https://simpleicon.com/wp-content/uploads/smile.svg" alt="happy" />';
            } elseif ($post['facial'] === 'relieved') {
                echo '<img src="https://cdn-icons-png.flaticon.com/128/4746/4746811.png" alt="relieved" />';
            } elseif ($post['facial'] === 'sad') {
                echo '<img src="http://simpleicon.com/wp-content/uploads/sad_emotion.png" alt="sad" />';
            } elseif ($post['facial'] === 'angry') {
                echo '<img src="https://cdn-icons-png.flaticon.com/128/3852/3852243.png" alt="angry" />';
            }
            ?>

            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p><?php echo $post['createdAt']; ?></p>
            <div class="content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
        </div>
    </main>
</body>

</html>
