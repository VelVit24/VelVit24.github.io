<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    if (!empty($_COOKIE['admin_upd'])) {
        $messages[] = 'Загружены данные пользователя '.$_COOKIE['id_upd'];
    }
    $errors = array();
    $errors['upd_id'] = !empty($_COOKIE['del_id_error']);
    if ($errors['upd_id']) {
        if ($_COOKIE['upd_id_error'] == 1)
            $messages[] = '<div class="error">Заполните ID пользователя.</div>';
        if ($_COOKIE['upd_id_error'] == 2)
            $messages[] = '<div class="error">Такого пользователя нет.</div>';
        setcookie('upd_id_error', '', 100000);
    }
} else if (!empty($_POST['update1'])) {
    $errors = false;
    if (empty($_POST['upd_id'])) {
        setcookie('upd_id_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    } else {
        $stmt = $db->query('SELECT id_app FROM application');
        $fl = false;
        while ($row = $stmt->fetch()) {
            if ($row['id_app'] == $_POST['upd_id']) $fl = true;
        }
        if (!$fl) {
            $errors = true;
            setcookie('upd_id_error', '2', time() + 24 * 60 * 60);
        }
    }
    if ($errors) {
        // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
        header('Location: admin.php');
        exit();
    } else {
        // Удаляем Cookies с признаками ошибок.
        setcookie('upd_id_error', '', 100000);
    }
    setcookie('admin_upd', '1');
    setcookie('id_upd', $_POST['del_id']);
    header('Location: admin.php');
}