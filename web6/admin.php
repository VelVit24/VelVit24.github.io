<?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы..
header('Content-Type: text/html; charset=UTF-8');
include('db_conn.php');
$stmt = $db->query("SELECT * FROM admin");
$row = $stmt->fetch();
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $row['login']||
    md5($_SERVER['PHP_AUTH_PW']) != $row['pass']) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

print('Вы успешно авторизовались и видите защищенные паролем данные.');


// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********

$stmt = $db->query('SELECT * FROM application');
$stmt2 = $db->query('SELECT app.id_app, pr.name_lang FROM applications_languages app, programming_language pr WHERE app.id_lang = pr.id_lang');
$row = $stmt->fetch();
$row2 = $stmt2->fetchAll();
?>
<link rel="stylesheet" href='style.css' type="text/css">
<table>
    <tr>
        <th>id_app</th>
        <th>name</th>
        <th>phone</th>
        <th>email</th>
        <th>birthday</th>
        <th>gender</th>
        <th>biography</th>
    </tr>
    <?php while ($row = $stmt->fetch()) {
        print('<tr>');

        for($i = 0; $i < 7; $i++) {
            print('<td>'.$row[$i].'</td>');
        }
        print('<td>');
        foreach ($row2 as $i) {
            if ($row['id_app'] == $i['id_app']) {
                print($i['name_lang'].'<br/>');
            }
        }
        print('</td>');
    }
    ?>

</table>

Удаление данных
<?php
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
if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
}
?>
<form action="admin_delete_db.php" method="POST">
    <label> ID пользователя<br/>
    <input type="text" name="del_id" <?php if ($errors['del_id']) {print 'class="error"';} ?> >
    </label><br/>
    <input type="submit" name="delete" value="Удалить">
</form>

Редактирование данных
<?php
if (empty($_COOKIE['admin_upd'])) {
    $messages = array();
    if (!empty($_COOKIE['admin_upd'])) {
        $messages[] = 'Загружены данные пользователя '.$_COOKIE['id_upd'];
    }
    $errors = array();
    $errors['upd_id'] = !empty($_COOKIE['upd_id_error']);
    if ($errors['upd_id']) {
        if ($_COOKIE['upd_id_error'] == 1)
            $messages[] = '<div class="error">Заполните ID пользователя.</div>';
        if ($_COOKIE['upd_id_error'] == 2)
            $messages[] = '<div class="error">Такого пользователя нет.</div>';
        setcookie('upd_id_error', '', 100000);
    }
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
    ?>
<form action="admin_update.php" method="POST">
    <label> ID пользователя<br/>
        <input type="text" name="upd_id" <?php if ($errors['upd_id']) {print 'class="error"';} ?> >
    </label><br/>
    <input type="submit" name="update1" value="Сохранить">
</form>
    <?php
    }
else {
    include('admin_upd_form2.php');
}
