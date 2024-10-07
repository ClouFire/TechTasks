<?php
session_start();

function createCSRF() {
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function checkCSRF($csrf_token) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!(isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $csrf_token))) {
            die('CSRF токен невалиден. Запрос отклонен.');
        }
    }
    return True;
}
