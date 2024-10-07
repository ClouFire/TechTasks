<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/csrf.php';
function addComment($username, $comment) {
    checkCSRF($_POST['csrf_token']);

    $query = DB::prepare("INSERT INTO users(username, comment, date) VALUES (:username, :comment, :date)");
    $query->execute([
        'username' => $username,
        'comment' => htmlspecialchars($comment),
        'date' => date('Y-m-d H:i:s', time()),
    ]);
    return True;
}

addComment($_POST['username'], $_POST['comment']);
header('location:CRUD.php');
