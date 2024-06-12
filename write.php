<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write</title>

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
            justify-content: center;
            align-items: center;
            font-size: large;
            gap: 15px;
            padding: 20px 20px;
            width: 100%;
            margin-top:40px;
            max-width: 500px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            box-sizing: border-box;
        }

        p{
            font-size: larger;
            margin: 0;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            height: 250px;
            resize:none;
        }

        .submitBtn {
            background-color: #00acc1;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
        }

        .submitBtn:hover {
            background-color: #007c91;
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
                padding: 80px 20px 20px;
                width: calc(100% - 40px);
                margin: 0 10px;
            }
        }
    </style>

</head>


<body>

    <?php include "navbar.php"; ?>

    <form method="post" action="/Facial-Diary/createDiary.php" class="container">
        <p>emotion</p>
        <select name="facial">
            <option value="good">good</option>
            <option value="relieved">relieved</option>
            <option value="sad">sad</option>
            <option value="angry">angry</option>
        </select>

        <p>title</p>
        <input id="title" name="title" placeholder="title" />

        <p>content</p>
        <textarea id="content" name="content" placeholder="content"></textarea>

        <input class="submitBtn" type="submit" name="createDiary" value="Post" />
    </form>

</body>

</html>