<?php
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