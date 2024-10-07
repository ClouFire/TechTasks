<?php
require_once __DIR__ . '/show-comments.php';

date_default_timezone_set('Europe/Moscow');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <ul class="comment-section">

        <?php
        showComments();
        ?>

    </ul>
    <ul class="writing-section">
            <form action="add-comment.php" method="POST">
                <div>
                    <label for="getUser">Введите ваше имя: </label>
                    <input type="text" class="getUser" name="username" id="getUser">
                </div>
                <label for="write"></label>
                <textarea id="write" placeholder="Напишите комментарий..." name="comment"></textarea>
                <div class="button">
                    <input type="submit" class="send">
                </div>
            </form>
    </ul>
</body>
</html>
