<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
$session_started = false;
if ($_COOKIE[session_name()] && session_start()) {
    $session_started = true;
    if (!empty($_SESSION['login'])) {
        // Если есть логин в сессии, то пользователь уже авторизован.
        // TODO: Сделать выход (окончание сессии вызовом session_destroy()
        //при нажатии на кнопку Выход).
        // Делаем перенаправление на форму.
        header('Location: ./');
        exit();
    }
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_COOKIE['login_error']) {
        print('<div id="messages">Неверный логин или пароль</div>');
        setcookie('login_error', '', 100000);
    }
    ?>

    <form action="" method="post">
        <input name="login"/>
        <input name="pass"/>
        <input type="submit" value="Войти"/>
    </form>

    <?php
} // Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
    include('../sql.php');
    $db = new PDO('mysql:host=localhost;dbname=u67330', $user, $pass,
        [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $db->query("SELECT * FROM users");
    $fl = false;
    while ($row = $stmt->fetch()) {
        if ($row['login'] == $_POST['login'] and $row['pass'] == md5($_POST['pass'])) {
            $fl = true;
            $uid = $row['id_app'];
            break;
        }
    }

    // TODO: Проверть есть ли такой логин и пароль в базе данных.
    // Выдать сообщение об ошибках.

    if (!$session_started) {
        session_start();
    }
    if ($fl) {
        // Если все ок, то авторизуем пользователя.
        $_SESSION['login'] = $_POST['login'];
        // Записываем ID пользователя.
        $_SESSION['uid'] = $uid;

        // Делаем перенаправление.
        header('Location: ./');
    }
    else {
        setcookie('login_error', '1', time() + 24 * 60 * 60);
        header('Location: login.php');
    }
}
