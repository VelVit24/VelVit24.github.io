<?php

$messages = array();

// В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
// Выдаем сообщение об успешном сохранении.
if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    setcookie('practice_login', '', 100000);
    setcookie('practice_pass', '', 100000);
    // Выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
    // Если в куках есть пароль, то выводим сообщение.
    if (!empty($_COOKIE['practice_pass'])) {
        $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
            strip_tags($_COOKIE['practice_login']),
            strip_tags($_COOKIE['practice_pass']));
    }
}

$errors = array();
$errors['first_name'] = !empty($_COOKIE['pr_reg_first_name_error']);
$errors['last_name'] = !empty($_COOKIE['pr_reg_last_name_error']);
$errors['phone'] = !empty($_COOKIE['pr_reg_phone_error']);
$errors['email'] = !empty($_COOKIE['pr_reg_email_error']);
$errors['date'] = !empty($_COOKIE['pr_reg_date_error']);

if ($errors['first_name']) {
    if ($_COOKIE['pr_reg_first_name_error'] == 1)
        $messages[] = '<div class="error">Заполните имя.</div>';
    if ($_COOKIE['pr_reg_first_name_error'] == 2)
        $messages[] = '<div class="error">Длина имени должна быть от 1 до 150 символов.</div>';
    if ($_COOKIE['pr_reg_first_name_error'] == 3)
        $messages[] = '<div class="error">Имя должно содержать только русские буквы.</div>';
    setcookie('pr_reg_first_name_error', '', 100000);
}
if ($errors['last_name']) {
    if ($_COOKIE['pr_reg_last_name_error'] == 1)
        $messages[] = '<div class="error">Заполните фамилию.</div>';
    if ($_COOKIE['pr_reg_last_name_error'] == 2)
        $messages[] = '<div class="error">Длина фамилии должна быть от 1 до 150 символов.</div>';
    if ($_COOKIE['pr_reg_last_name_error'] == 3)
        $messages[] = '<div class="error">Фамилия должно содержать только русские буквы.</div>';
    setcookie('pr_reg_last_name_error', '', 100000);
}
if ($errors['phone']) {
    if ($_COOKIE['pr_reg_phone_error'] == 1)
        $messages[] = '<div class="error">Заполните номер телефона.</div>';
    if ($_COOKIE['pr_reg_phone_error'] == 2)
        $messages[] = '<div class="error">Неправильный номер телефона: номер должен состоять из 11 цифр.</div>';
    if ($_COOKIE['pr_reg_phone_error'] == 3)
        $messages[] = '<div class="error">Неправильный номер телефона: номер должен начинаться с 7 или 8 и состоять только из цифр.</div>';
    setcookie('pr_reg_phone_error', '', 100000);
}
if ($errors['email']) {
    if ($_COOKIE['pr_reg_email_error'] == 1)
        $messages[] = '<div class="error">Заполните Email.</div>';
    if ($_COOKIE['pr_reg_email_error'] == 2)
        $messages[] = '<div class="error">Длина Email должна быть от 5 до 256 символов.</div>';
    if ($_COOKIE['pr_reg_email_error'] == 3)
        $messages[] = '<div class="error">Неправильный Email: должен содержать только строчные латинские буквы и символы _-.@</div>';
    setcookie('pr_reg_email_error', '', 100000);
}
if ($errors['date']) {
    if ($_COOKIE['pr_reg_date_error'] == 1)
        $messages[] = '<div class="error">Заполните дату рождения.</div>';
    if ($_COOKIE['pr_reg_date_error'] == 2)
        $messages[] = '<div class="error">Неправильная дата рождения: дата должна быть в формате DD.MM.YYYY</div>';
    setcookie('pr_reg_date_error', '', 100000);
}

$values = array();
$values['first_name'] = empty($_COOKIE['pr_reg_first_name_value']) ? '' : $_COOKIE['pr_reg_first_name_value'];
$values['last_name'] = empty($_COOKIE['pr_reg_last_name_value']) ? '' : $_COOKIE['pr_reg_last_name_value'];
$values['phone'] = empty($_COOKIE['pr_reg_phone_value']) ? '' : $_COOKIE['pr_reg_phone_value'];
$values['email'] = empty($_COOKIE['pr_reg_email_value']) ? '' : $_COOKIE['pr_reg_email_value'];
$values['date'] = empty($_COOKIE['pr_reg_date_value']) ? '' : $_COOKIE['pr_reg_date_value'];

$fl = false;
foreach($errors as $er) if ($er) $fl = true;
if (!$fl && !empty($_COOKIE[session_name()]) &&
    session_start() && !empty($_SESSION['practice_login'])) {
    include('db_conn.php');
    $stmt = $db->prepare("SELECT * FROM pr_users WHERE id_user = ?");
    $stmt->execute([$_SESSION['practice_uid']]);
    $data = $stmt->fetch();
    $values['first_name'] = $data['first_name'];
    $values['last_name'] = $data['last_name'];
    $values['phone'] = $data['phone'];
    $values['email'] = $data['email'];
    $values['date'] = $data['birthday'];
}
if (!empty($messages)) {
    print('<div id="messages">');
    // Выводим все сообщения.
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>
<form action="form_reg_act.php" method="POST">
    <label>Имя<br/>
        <input name="first_name" <?php if ($errors['first_name']) {print 'class="error"';} ?> value="<?php print $values['first_name']; ?>">
    </label><br/>
    <label>Фамилия<br/>
        <input name="last_name" <?php if ($errors['last_name']) {print 'class="error"';} ?> value="<?php print $values['last_name']; ?>">
    </label><br/>
    <label>Дата рождения<br/>
        <input name="date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
    </label><br/>
    <label>Номер телефона<br/>
        <input name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php print $values['phone']; ?>">
    </label><br/>
    <label>E-mail<br/>
        <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
    </label><br/>
    <input type="submit" name="ok" value="Сохранить">
</form>
<?php
if (!empty($_SESSION['practice_login'])) {
    print('<form action="exit.php" method="POST">');
    print('<input type="submit" name="act_exit" value="Выход"></from>');
}
?>
