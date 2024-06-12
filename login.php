<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background-color: #e0f7fa;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px; /* To account for fixed navbar */
        }

        .container p {
            margin: 0;
            font-weight: bold;
            color: #006064;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: calc(100% - 20px);
            /* width: 100%; */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #00bcd4;
            border-radius: 5px;
        }

        .submitBtn {
            width: 100%;
            padding: 10px;
            background-color: #00bcd4;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .submitBtn:hover {
            background-color: #0097a7;
        }
    </style>
</head>

<body>

<?php include "navbar.php"; ?>

    <form method="post" action="/Facial-Diary/loginCheck.php" class="container">
        <p>id</p>
        <input id="id" name="id" placeholder="id" type="text"/>

        <p>password</p>
        <input id="pw" name="pw" placeholder="password" type="password"/>

        <input class="submitBtn" type="submit" name="login" value="login"/>
    </form>

</body>

</html>
