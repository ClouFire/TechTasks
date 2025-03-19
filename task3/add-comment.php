<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/csrf.php';
function addComment($username, $comment) {
    checkCSRF($_POST['csrf_token']);

    $query = DB::prepare("INSERT INTO users(username, comment, date) VALUES (:username, :comment, :date)");
    $query->execute([
        'username' => $username ?: "Аноним",
        'comment' => $comment,
        'date' => date('Y-m-d H:i:s', time()),
    ]);

    return True;
}

if($_SERVER['REQUEST_METHOD'] !== "POST")
{
    header('location:index.php');
    exit();
}
else
{
    if(trim($_POST['comment'])) {
        addComment($_POST['username'], $_POST['comment']);
        header('location:index.php');
    }
}

header('location:index.php');
exit();