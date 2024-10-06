<?php
require_once __DIR__ . '/Database.php';
function addComment($username, $comment) {
    $query = DB::prepare("INSERT INTO users(username, comment, date) VALUES (:username, :comment, :date)");
    $query->execute([
        'username' => $username,
        'comment' => $comment,
        'date' => date('Y-m-d H:i:s', time()),
    ]);
    return True;
}

addComment($_POST['username'], $_POST['comment']);
header('location:CRUD.php');
