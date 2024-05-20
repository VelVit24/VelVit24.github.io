<?php
$messages = array();
if (!empty($_COOKIE['id_upd'])) {
    $messages['id_upd'] = 'Загружены данные пользователя '.htmlspecialchars($_COOKIE['id_upd']);
}

$errors = array();
$errors['name'] = !empty($_COOKIE['name_error']);
$errors['phone'] = !empty($_COOKIE['phone_error']);
$errors['email'] = !empty($_COOKIE['email_error']);
$errors['date'] = !empty($_COOKIE['date_error']);
$errors['gender'] = !empty($_COOKIE['gen_error']);
$errors['bio'] = !empty($_COOKIE['bio_error']);
$errors['lang'] = !empty($_COOKIE['lang_error']);
$errors['check'] = !empty($_COOKIE['check_error']);


if ($errors['name']) {
    if ($_COOKIE['name_error'] == 1)
        $messages[] = '<div class="error">Заполните имя.</div>';
    if ($_COOKIE['name_error'] == 2)
        $messages[] = '<div class="error">Длина имени должна быть от 1 до 150 символов.</div>';
    if ($_COOKIE['name_error'] == 3)
        $messages[] = '<div class="error">Имя должно содержать только русские буквы и пробелы.</div>';
    setcookie('name_error', '', 100000);
}
if ($errors['phone']) {
    if ($_COOKIE['phone_error'] == 1)
        $messages[] = '<div class="error">Заполните номер телефона.</div>';
    if ($_COOKIE['phone_error'] == 2)
        $messages[] = '<div class="error">Неправильный номер телефона: номер должен состоять из 11 цифр.</div>';
    if ($_COOKIE['phone_error'] == 3)
        $messages[] = '<div class="error">Неправильный номер телефона: номер должен начинаться с 7 или 8 и состоять только из цифр.</div>';
    setcookie('phone_error', '', 100000);
}
if ($errors['email']) {
    if ($_COOKIE['email_error'] == 1)
        $messages[] = '<div class="error">Заполните Email.</div>';
    if ($_COOKIE['email_error'] == 2)
        $messages[] = '<div class="error">Длина Email должна быть от 5 до 256 символов.</div>';
    if ($_COOKIE['email_error'] == 3)
        $messages[] = '<div class="error">Неправильный Email: должен содержать только строчные латинские буквы и символы _-.@</div>';
    setcookie('email_error', '', 100000);
}
if ($errors['date']) {
    if ($_COOKIE['date_error'] == 1)
        $messages[] = '<div class="error">Заполните дату рождения.</div>';
    if ($_COOKIE['date_error'] == 2)
        $messages[] = '<div class="error">Неправильная дата рождения: дата должна быть в формате DD.MM.YYYY</div>';
    setcookie('date_error', '', 100000);
}
if ($errors['gender']) {
    if ($_COOKIE['gen_error'] == 1)
        $messages[] = '<div class="error">Выберите пол.</div>';
    setcookie('gen_error', '', 100000);
}
if ($errors['lang']) {
    if ($_COOKIE['lang_error'] == 1)
        $messages[] = '<div class="error">Укажите хотя бы 1 язык программирования.</div>';
    setcookie('lang_error', '', 100000);
}
if ($errors['bio']) {
    if ($_COOKIE['bio_error'] == 1)
        $messages[] = '<div class="error">Заполните биографию.</div>';
    if ($_COOKIE['bio_error'] == 2)
        $messages[] = '<div class="error">Длина биографии должна быть от 1 до 1000 символов.</div>';
    if ($_COOKIE['bio_error'] == 3)
        $messages[] = '<div class="error">Биография должна содержать только буквы, цифры, пробелы и символы .,-;:@%!"</div>';
    setcookie('bio_error', '', 100000);
}
if ($errors['check']) {
    if ($_COOKIE['check_error'] == 1)
        $messages[] = '<div class="error">Отметьте галочку напротив "С контрактом ознакомлен(а)"</div>';
    setcookie('check_error', '', 100000);
}

// Складываем предыдущие значения полей в массив, если есть.
$values = array();
$values['name'] = empty($_COOKIE['name_value1']) ? '' : $_COOKIE['name_value1'];
$values['phone'] = empty($_COOKIE['phone_value1']) ? '' : $_COOKIE['phone_value1'];
$values['email'] = empty($_COOKIE['email_value1']) ? '' : $_COOKIE['email_value1'];
$values['date'] = empty($_COOKIE['date_value1']) ? '' : $_COOKIE['date_value1'];
$values['gen'] = empty($_COOKIE['gen_value1']) ? '' : $_COOKIE['gen_value1'];
$values['lang'] = empty($_COOKIE['lang_value1']) ? '' : $_COOKIE['lang_value1'];
$values['bio'] = empty($_COOKIE['bio_value1']) ? '' : $_COOKIE['bio_value1'];

$fl = false;
foreach($errors as $er) if ($er) $fl = true;
if (!$fl) {
    $stmt = $db->prepare("SELECT * FROM application WHERE id_app = ?");
    $stmt->execute([$_COOKIE['id_upd']]);
    $data = $stmt->fetch();
    $values['name'] = $data['name'];
    $values['phone'] = $data['phone_number'];
    $values['email'] = $data['email'];
    $values['date'] = $data['birthday'];
    $values['gen'] = $data['gender'];
    $values['bio'] = $data['biography'];

    $stmt = $db->prepare("SELECT * FROM applications_languages WHERE id_app = ?");
    $stmt->execute([$_COOKIE['id_upd']]);
    $t = "||";
    while ($row = $stmt->fetch()) {
        $t = $t . $row['id_lang'] . "|";
    }
    $values['lang'] = $t;
}
$values['name'] = htmlspecialchars($values['name']);
$values['phone'] = htmlspecialchars($values['phone']);
$values['email'] = htmlspecialchars($values['email']);
$values['date'] = htmlspecialchars($values['date']);
$values['gen'] = htmlspecialchars($values['gen']);
$values['lang'] = htmlspecialchars($values['lang']);
$values['bio'] = htmlspecialchars($values['bio']);
if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
}
?>
<form action="admin_update_user.php" method="POST">
    <label>Ваше ФИО<br/>
        <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>">
    </label><br/>
    <label>Номер телефона<br/>
        <input name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php print $values['phone']; ?>">
    </label><br/>
    <label>E-mail<br/>
        <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
    </label><br/>
    <label>Дата рождения<br/>
        <input name="birthday" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
    </label><br/>
    <label>Пол<br/>
        <input type="radio" name="gender" value="male" <?php if ($errors['gender']) {print 'class="error-ch"';} ?> <?php if ($values['gen']=="male") {print 'checked';} ?> >  Мужской<br/>
        <input type="radio" name="gender" value="female" <?php if ($errors['gender']) {print 'class="error-ch"';} ?> <?php if ($values['gen']=="female") {print 'checked';} ?> >  Женский
    </label><br/>
    <label>Языки программирования:<br/>
        <select multiple name="languages[]" <?php if ($errors['lang']) {print 'class="error"';} ?>>
            <option value="1" <?php if (strpos($values['lang'], "|1|")) {print 'selected';} ?>>Pascal</option>
            <option value="2" <?php if (strpos($values['lang'], "|2|")) {print 'selected';} ?>>C</option>
            <option value="3" <?php if (strpos($values['lang'], "|3|")) {print 'selected';} ?>>C++</option>
            <option value="4" <?php if (strpos($values['lang'], "|4|")) {print 'selected';} ?>>JavaScript</option>
            <option value="5" <?php if (strpos($values['lang'], "|5|")) {print 'selected';} ?>>PHP</option>
            <option value="6" <?php if (strpos($values['lang'], "|6|")) {print 'selected';} ?>>Python</option>
            <option value="7" <?php if (strpos($values['lang'], "|7|")) {print 'selected';} ?>>Java</option>
            <option value="8" <?php if (strpos($values['lang'], "|8|")) {print 'selected';} ?>>Haskel</option>
            <option value="9" <?php if (strpos($values['lang'], "|9|")) {print 'selected';} ?>>Clojure</option>
            <option value="10" <?php if (strpos($values['lang'], "|10|")) {print 'selected';} ?>>Prolog</option>
            <option value="11" <?php if (strpos($values['lang'], "|11|")) {print 'selected';} ?>>Scala</option>
        </select>
    </label><br/>
    <label>Биография<br/>
        <textarea name="biography" <?php if ($errors['bio']) {print 'class="error"';} ?> ><?php print $values['bio']; ?></textarea>
    </label><br/>
    <label for="cb" class="label-checkbox">
        <input name="check" type="checkbox" id="cb" value="1" <?php if ($errors['check']) {print 'class="error-ch"';} ?> > С контрактом ознакомлен(а).
    </label><br/>
    <input type="submit" name="ok" value="Сохранить">
</form>