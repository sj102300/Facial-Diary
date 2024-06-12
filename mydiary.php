<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내 일기장</title>

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
            width:100%;
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
            width: 90%;
            padding: 10px;
            flex-wrap: wrap;
            margin: 60px 5% 0 5%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap:20px;
        }

        .container form select,
        .container form button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .container form button {
            background-color: #00acc1;
            color: white;
            border: none;
            cursor: pointer;
        }

        .container form button:hover {
            background-color: #007c91;
        }


        .diary-container {
            display: flex;
            width:90%;
            gap:15px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .diarybox {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid lightgrey;
            gap: 10px;
            padding: 20px;
            width: 250px;
            font-size: larger;
        }
        .diarybox>p{
            margin:0;
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <main class="container">
        <form method="GET" action="">
            <select name="month">
                <option value="0">전체</option>
                <option value="1">1월</option>
                <option value="2">2월</option>
                <option value="3">3월</option>
                <option value="4">4월</option>
                <option value="5">5월</option>
                <option value="6">6월</option>
                <option value="7">7월</option>
                <option value="8">8월</option>
                <option value="9">9월</option>
                <option value="10">10월</option>
                <option value="11">11월</option>
                <option value="12">12월</option>
            </select>
            <button type="submit">검색</button>
        </form>

        <div class="diary-container">
            <?php
            session_start();

            if (!isset($_SESSION['userId'])) {
                echo "You need to login first.";
                echo "<a href='/Facial-Diary/login.php'>login</a>";
                exit();
            }

            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'Facial-Diary';

            $db = new mysqli($servername, $username, $password, $dbname);
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            $userId = $_SESSION['userId'];
            $month = isset($_GET['month']) ? (int)$_GET['month'] : 0;

            $query = "SELECT * FROM Diary WHERE userId = '$userId'";
            if ($month > 0) {
                $query .= " AND MONTH(createdAt) = '$month'";
            }
            $query .= " ORDER BY createdAt DESC";

            $result = mysqli_query($db, $query);
            if (!$result) {
                die('Error: ' . mysqli_error($db));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="diarybox" data-post-id="' . $row['postId'] . '">';
                if ( $row['facial'] === 'good'){
                    echo '<img width="200" height="200" src="https://simpleicon.com/wp-content/uploads/smile.svg" alt="happy" />';
                }
                else if( $row['facial'] === 'relieved') {
                    echo '<img width="200" height="200" src="https://cdn-icons-png.flaticon.com/128/4746/4746811.png" alt="relieved" />';
                }
                else if( $row['facial'] === 'sad') {
                    echo '<img width="200" height="200" src="http://simpleicon.com/wp-content/uploads/sad_emotion.png" alt="sad" />';
                }
                else if( $row['facial'] === 'angry'){
                    echo '<img width="200" height="200" src="https://cdn-icons-png.flaticon.com/128/3852/3852243.png" alt="sad" />';
                }
                echo '<p>' . $row['createdAt'] . '</p>';
                echo '<p>' . htmlspecialchars($row['title']) . '</p>';
                echo '</div>';
            }

            $db->close();
            ?>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const diaryBoxes = document.querySelectorAll('.diarybox');
            diaryBoxes.forEach(box => {
                box.addEventListener('click', function () {
                    const postId = this.getAttribute('data-post-id');
                    window.location.href = '/Facial-Diary/diary.php?postId=' + postId;
                });
            });
        });
        </script>
    </main>
</body>

</html>
