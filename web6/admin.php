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
var_dump($row2);
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
    }
    ?>

</table>

Удаление данных
<?php include('admin_delete_db.php');
if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
}
?>
<form action="" method="POST">
    <label> ID пользователя<br/>
    <input type="text" name="del_id" <?php if ($errors['del_id']) {print 'class="error"';} ?> >
    </label><br/>
    <input type="submit" name="delete" value="Удалить">
</form>

