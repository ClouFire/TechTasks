<?php
require_once __DIR__ . '/show-comments.php';
function addComment($username, $comment, $pdo) {
    $stmt = $pdo->prepare("INSERT INTO comments(username, comment, date) VALUES (:username, :comment, :date)");
    $stmt->execute([
        'username' => $username,
        'comment' => $comment,
        'date' => date('Y-m-d H:i:s', time()),
    ]);
    return True;
}

addComment($_GET['username'], $_GET['comment'], getPDO());
header('location:CRUD.php');
