<?php
include ('db_conn.php');
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
setcookie('id_upd', $_POST['upd_id']);
header('Location: admin.php');
