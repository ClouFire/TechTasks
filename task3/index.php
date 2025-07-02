<?php

require_once __DIR__ . '/config.php';
require_once HELPERS;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Task3</title>
</head>
<body>
<ul class="comment-section">

    <?php foreach(getComments() as $row) : ?>
    <li class="users-comments wrapper">
        <div class="about-user">
            <a href="#"><?=htmlspecialchars($row['username'])?></a>
            <br>
        </div><p><?=htmlspecialchars($row['comment'])?></p>
        <?php endforeach ?>

</ul>
<ul class="writing-section">
    <form action="helpers.php" method="POST">
        <?= getCsrfField(); ?>
        <div>
            <label for="getUser">Введите ваше имя: </label>
            <input type="text" class="getUser" name="username" id="getUser" maxlength="25">
        </div>
        <label for="write"></label>
        <textarea id="write" placeholder="Напишите комментарий..." name="comment" maxlength="250" required></textarea>
        <div class="button">
            <input type="submit" class="send" name="submitComment">
        </div>
    </form>
</ul>
</body>
</html>