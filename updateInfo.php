<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    echo "You need to login first.";
    echo "<a href='/Facial-Diary/login.php'>login</a>";
}

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Facial-Diary';

// Create connection
$db = new mysqli($servername, $username, $password, $dbname) or die("Connection failed:");

// Get the user ID from the session
$userId = $_SESSION['userId'];

// Fetch user data
$query = "SELECT * FROM `User` WHERE id = '$userId';";
$result = mysqli_query($db, $query) or die(mysqli_error($db));

if ($row = mysqli_fetch_assoc($result)) {
    $id = htmlspecialchars($row['id']);
    $pw = htmlspecialchars($row['pw']);
    $nickname = htmlspecialchars($row['nickname']);
    $gender = htmlspecialchars($row['gender']);
} else {
    die("User not found.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
            height: 100%;
            width: 100%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: x-large;
            gap: 10px;
            margin-top: 80px; /* To account for fixed navbar */
        }

        input {
            width: 200px;
            height: 30px;
            padding: 5px;
            font-size: 18px;
            border: 1px solid #00bcd4;
            border-radius: 5px;
            text-align: center;
        }

        .submitBtn {
            margin: 20px 0;
            width: 200px;
            height: 40px;
            background-color: #00bcd4;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
        }

        .submitBtn:hover {
            background-color: #0097a7;
        }

        .gender {
            font-size: 18px;
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .gender input {
            width: 20px;
            height: 20px;
        }

        .valueSection {
            width: 200px;
            height: 30px;
            font-size: 18px;
            text-align: center;
            background-color: #e0f7fa;
            border: 1px solid #00bcd4;
            border-radius: 5px;
            line-height: 30px; /* Center text vertically */
        }

        .navbarElement {
            text-decoration-line: none;ㄴ
            color: black;
        }
    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

    <form method="post" action="/Facial-Diary/updateUserInfo.php" class="container">
        <p>id</p>
        <div class="valueSection"><?php echo $id; ?></div>
        <p>password</p>
        <input id="pw" type="password" name="pw" placeholder="password" value="<?php echo $pw; ?>" required />
        <p>nickname</p>
        <input type="text" name="nickname" id="nickname" value="<?php echo $nickname; ?>" placeholder="nickname" required />
        <p>gender</p>
        <label class="gender" for="gender">
            <input type='radio' name='gender' value='female' <?php if($gender == 'female') echo 'checked'; ?> /><span>female</span>
            <input type='radio' name='gender' value='male' <?php if($gender == 'male') echo 'checked'; ?> /><span>male</span>
        </label>
        <input class="submitBtn" type="submit" name="update" value="update" />
    </form>

</body>

</html>
