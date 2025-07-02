<?php
require_once __DIR__ . '/config.php';
require_once DATABASE;

session_start();
function db(): DataBase
{
    return DataBase::getInstance();
}

function getComments(): array
{
    return db()->getComments();
}

function addComment($username, $comment): void
{
    db()->addComment($username, $comment);
}

function getCsrfToken(): string
{
    if(empty($_SESSION['csrf_token']))
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function checkCsrfToken($csrf_token): bool
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!(isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $csrf_token))) {
            die('CSRF токен невалиден. Запрос отклонен');
        }
    }
    return True;
}

function getCsrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . getCsrfToken() . '">';
}

function submitComment()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST' and trim($_POST['comment']))
    {
        checkCsrfToken($_POST['csrf_token']);
        addComment($_POST['username'], $_POST['comment']);
        header('Location:index.php');
        die;
    }
    else {
        $_SESSION['error'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='width: 50%'>"
        . "<strong>Внимание!</strong><br> Ваш комментарий не будет отображен на странице."
        . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header('Location:index.php');
        die;
    }
}

if(isset($_POST['submitComment']))
{
    submitComment();
}