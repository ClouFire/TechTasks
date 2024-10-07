<?php
require_once __DIR__ . '/Database.php';
session_start();
function checkCSRF($csrf_token) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!(isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $csrf_token))) {
            return False;
        }
    }
    return True;
}

function addComment($username, $comment) {
    if(!checkCSRF($_POST['csrf_token'])) {
        die('CSRF токен невалиден. Запрос отклонен.');
    }
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
