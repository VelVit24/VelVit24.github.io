<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    if (!empty($_COOKIE['del_save'])) {
        setcookie('del_save', '', 100000);
        $messages[] = 'Пользователь удален.';
    }
    $errors = array();
    $errors['del_id'] = !empty($_COOKIE['del_id_error']);
    if ($errors['del_id']) {
        if ($_COOKIE['del_id_error'] == 1)
            $messages[] = '<div class="error">Заполните ID пользователя.</div>';
        if ($_COOKIE['del_id_error'] == 2)
            $messages[] = '<div class="error">Такого пользователя нет.</div>';
        setcookie('del_id_error', '', 100000);
    }
}
else if (!empty($_POST['delete'])) {
    $errors = false;
    if (empty($_POST['del_id'])) {
        setcookie('del_id_error','1',time() + 24 * 60 * 60);
        $errors = true;
    }
    else {
        $stmt = $db->query('SELECT id_app FROM application');
        $fl = false;
        while ($row = $stmt->fetch()) {
            if ($row['id_app'] == $_POST['del_id']) $fl = true;
        }
        if (!$fl) {
            $errors = true;
            setcookie('del_id_error','2',time() + 24 * 60 * 60);
        }
    }
    if ($errors) {
        // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
        header('Location: admin.php');
        exit();
    } else {
        // Удаляем Cookies с признаками ошибок.
        setcookie('del_id_error', '', 100000);
    }
    try {
        $stmt3 = $db->prepare('DELETE FROM application WHERE id_app = ?');
        $stmt3->execute([$_POST['del_id']]);
        $stmt3 = $db->prepare("DELETE FROM applications_languages WHERE id_app = ?");
        $stmt3->execute([$_POST['del_id']]);
    }
    catch(PDOException $e){
        echo ('Error : ' . $e->getMessage());
        exit();
    }
    setcookie('del_save', '1');
    header('Location: admin.php');
}