<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

header('Content-Type: text/html; charset=UTF-8');

$session_started = false;
if ($_COOKIE[session_name()] && session_start()) {
    $session_started = true;
    if (!empty($_SESSION['practice_login'])) {
        header('Location: ./');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_COOKIE['practice_login_error'])) {
        print('<div id="messages">Неверный логин или пароль</div>');
        setcookie('practice_login_error', '', 100000);
    }
    ?>
    <html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href='style.css' type="text/css">
    </head>
    <body>
    <div class="log-wrap">
        <div class="log-title">
            <div class="login-title"><h2>Вход</h2></div>
        <div class="log-box">
            <form action="" method="post">
                <label>Логин<br/>
                    <input name="login"/>
                </label><br/>
                <label>Пароль<br/>
                    <input name="pass"/>
                </label><br/>
                <input type="submit" value="Войти"/>
            </form>
        </div>
    </div>
    </body>
    </html>

    <?php
} // Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
    include('db_conn.php');
    $stmt = $db->query("SELECT * FROM pr_logins");
    $fl = false;
    while ($row = $stmt->fetch()) {
        if ($row['login'] == $_POST['login'] and $row['pass'] == md5($_POST['pass'])) {
            $fl = true;
            $uid = $row['id_user'];
            break;
        }
    }

    // Выдать сообщение об ошибках.

    if (!$session_started) {
        session_start();
    }
    if ($fl) {
        // Если все ок, то авторизуем пользователя.
        $_SESSION['practice_login'] = $_POST['login'];
        // Записываем ID пользователя.
        $_SESSION['practice_uid'] = $uid;

        // Делаем перенаправление.
        header('Location: ./');
    }
    else {
        setcookie('practice_login_error', '1', time() + 24 * 60 * 60);
        header('Location: login.php');
    }
}
