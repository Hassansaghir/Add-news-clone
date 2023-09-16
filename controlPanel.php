<?php
//Check if the session is the same or not
session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../login/login");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>control Panel</title>
    <link rel="stylesheet" href="../Stylessheet/controlPanel.css">
</head>
<body>
    <div class="top">
        <h1>Control Panel</h1>
    </div>
    <div>
        <h2>Please choose your option:</h2>
    </div>
    <div class="list">
        <ul>
            <li><a href="../add news/addNews.php">Add news</a></li>
            <li><a href="../Listnews/ListNews.php">List news</a></li>
            <li><a href="../login/logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>