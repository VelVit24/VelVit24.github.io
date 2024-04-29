<?php
/**
 * Реализовать возможность входа с паролем и логином с использованием
 * сессии для изменения отправленных данных в предыдущей задаче,
 * пароль и логин генерируются автоматически при первоначальной отправке формы.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
include('../sql.php');
$db = new PDO('mysql:host=localhost;dbname=u67330', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Массив для временного хранения сообщений пользователю.
    $messages = array();

    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    // Выдаем сообщение об успешном сохранении.
    if (!empty($_COOKIE['save'])) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('save', '', 100000);
        setcookie('login', '', 100000);
        setcookie('pass', '', 100000);
        // Выводим сообщение пользователю.
        $messages[] = 'Спасибо, результаты сохранены.';
        // Если в куках есть пароль, то выводим сообщение.
        if (!empty($_COOKIE['pass'])) {
            $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
                strip_tags($_COOKIE['login']),
                strip_tags($_COOKIE['pass']));
        }
    }

    // Складываем признак ошибок в массив.
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['phone'] = !empty($_COOKIE['phone_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gen_error']);
    $errors['bio'] = !empty($_COOKIE['bio_error']);
    $errors['lang'] = !empty($_COOKIE['lang_error']);
    $errors['check'] = !empty($_COOKIE['check_error']);

    // Выдаем сообщения об ошибках.
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


    //подключение к БД


    // Если нет предыдущих ошибок ввода, есть кука сессии, начали сессию и
    // ранее в сессию записан факт успешного логина.

    $fl = false;
    foreach($errors as $er) if ($er) $fl = true;
    if (!$fl && !empty($_COOKIE[session_name()]) &&
        session_start() && !empty($_SESSION['login'])) {

        $stmt = $db->prepare("SELECT * FROM application WHERE id_app = ?");
        $stmt->execute([$_SESSION['uid']]);
        $data = $stmt->fetch();
        $values['name'] = $data['name'];
        $values['phone'] = $data['phone_number'];
        $values['email'] = $data['email'];
        $values['date'] = $data['birthday'];
        $values['gen'] = $data['gender'];
        $values['bio'] = $data['biography'];

        $stmt = $db->prepare("SELECT * FROM applications_languages WHERE id_app = ?");
        $stmt->execute([$_SESSION['uid']]);
        $t = "||";
        while ($row = $stmt->fetch()) {
            $t = $t . $row['id_lang'] . "|";
        }
        $values['lang'] = $t;
        // TODO: загрузить данные пользователя из БД
        // и заполнить переменную $values,
        // предварительно санитизовав.
        printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
    }

    // Включаем содержимое файла form.php.
    // В нем будут доступны переменные $messages, $errors и $values для вывода
    // сообщений, полей с ранее заполненными данными и признаками ошибок.
    include('form.php');
} // Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
    // Проверяем ошибки.
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^.{1,150}$/u', $_POST['name'])) {
        setcookie('name_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $_POST['name'])) {
        setcookie('name_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('name_value1', $_POST['name'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['phone'])) {
        setcookie('phone_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^.{11}$/', $_POST['phone'])) {
        setcookie('phone_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^(7|8)[0-9]{10}$/', $_POST['phone'])) {
        setcookie('phone_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('phone_value1', $_POST['phone'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^.{5,256}$/u', $_POST['email'])) {
        setcookie('email_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])) {
        setcookie('email_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('email_value1', $_POST['email'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['birthday'])) {
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^(0[1-9]|[12][0-9]|3[01])[\.](0[1-9]|1[012])[\.](19|20)\d\d$/', $_POST['birthday'])) {
        setcookie('date_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('date_value1', $_POST['birthday'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('gen_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('gen_value1', $_POST['gender'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['biography'])) {
        setcookie('bio_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^.{1,1000}$/u', $_POST['biography'])) {
        setcookie('bio_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^[\w\.,-;:@%!"\s]+$/um', $_POST['biography'])) {
        setcookie('bio_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('bio_value1', $_POST['biography'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['check'])) {
        setcookie('check_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }

    if (empty($_POST['languages'])) {
        setcookie('lang_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        $t = "||";
        foreach ($_POST['languages'] as $lg) {
            $t = $t . $lg . "|";
        }
        setcookie('lang_value1', $t, time() + 365 * 24 * 60 * 60);
    }

// *************
//
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

    if ($errors) {
        // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
        header('Location: index.php');
        exit();
    } else {
        // Удаляем Cookies с признаками ошибок.
        setcookie('name_error', '', 100000);
        setcookie('phone_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gen_error', '', 100000);
        setcookie('lang_error', '', 100000);
        setcookie('bio_error', '', 100000);
        setcookie('check_error', '', 100000);
    }

    // Проверяем меняются ли ранее сохраненные данные или отправляются новые.
    if (!empty($_COOKIE[session_name()]) &&
        session_start() && !empty($_SESSION['login'])) {
        $stmt = $db->prepare("UPDATE application SET name = ?, phone_number = ?, email = ?, birthday = ?, gender = ?, biography = ? WHERE id_app = ?");
        $stmt->execute([$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['gender'],$_POST['biography'],$_SESSION['uid']]);
        $stmt = $db->prepare("DELETE FROM applications_languages WHERE id_app = ?");
        $stmt->execute([$_SESSION['uid']]);
        foreach ($_POST['languages'] as $language) {
            $stmt = $db->prepare("INSERT INTO applications_languages SET id_app = ?, id_lang = ?");
            $stmt->execute([$_SESSION['uid'], $language]);
        }
        // кроме логина и пароля.
        //print($_SESSION['uid']);
    } else {
        session_start();
        // Генерируем уникальный логин и пароль.
        $login = 'user';
        $pass = rand(100000, 999999);

        // Сохраняем в Cookies.
        setcookie('pass', $pass);

        try {
            $stmt = $db->prepare("INSERT INTO application SET name = ?, phone_number = ?, email = ?, birthday = ?, gender = ?, biography = ?");
            $stmt->execute([$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['gender'],$_POST['biography']]);
            $li = $db->lastInsertId();
            foreach ($_POST['languages'] as $language) {
                $stmt = $db->prepare("INSERT INTO applications_languages SET id_app = ?, id_lang = ?");
                $stmt->execute([$li, $language]);
            }
            $login = 'user' . $li;
            $stmt = $db->prepare("INSERT INTO users SET login = ?, pass = ?, id_app = ?");
            $stmt->execute([$login, md5($pass), $li]);
        }
        catch(PDOException $e){
            echo ('Error : ' . $e->getMessage());
            exit();
        }
        setcookie('login', $login);
    }

    // Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');

    // Делаем перенаправление.
    header('Location: ./');
}
