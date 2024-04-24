<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

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
        // Если есть параметр save, то выводим сообщение пользователю.
        $messages[] = 'Спасибо, результаты сохранены.';
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
            $messages[] = '<div class="error">Имя должно содержать только буквы кириллицы и пробелы</div>';
        setcookie('name_error', '', 100000);
    }
    if ($errors['phone']) {
        if ($_COOKIE['phone_error'] == 1)
            $messages[] = '<div class="error">Заполните номер телефона.</div>';
        if ($_COOKIE['phone_error'] == 2)
            $messages[] = '<div class="error">Неправильный номер телефона: номер должен начинаться с +7, 7 или 8 и состоять из цифр</div>';
        setcookie('phone_error', '', 100000);
    }
    if ($errors['email']) {
        if ($_COOKIE['email_error'] == 1)
            $messages[] = '<div class="error">Заполните Email.</div>';
        if ($_COOKIE['email_error'] == 2)
            $messages[] = '<div class="error">Длина Email должна быть от 5 до 256 символов.</div>';
        if ($_COOKIE['email_error'] == 3)
            $messages[] = '<div class="error">Неправильный Email: должен содержать только строчные латинские буквы, нижнее подчеркивание, дефис и точку.</div>';
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
            $messages[] = '<div class="error">Выберите пол</div>';
        setcookie('gen_error', '', 100000);
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
            $messages[] = '<div class="error">С контрактом ознакомлен</div>';
        setcookie('check_error', '', 100000);
    }
    if ($errors['lang']) {
        if ($_COOKIE['lang_error'] == 1)
            $messages[] = '<div class="error">Укажите хотя бы 1 язык программирования</div>';
        setcookie('lang_error', '', 100000);
    }
    // TODO: тут выдать сообщения об ошибках в других полях.

    // Складываем предыдущие значения полей в массив, если есть.
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['phone'] = empty($_COOKIE['phone_value']) ? '' : $_COOKIE['phone_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
    $values['gen'] = empty($_COOKIE['gen_value']) ? '' : $_COOKIE['gen_value'];
    $values['lang'] = empty($_COOKIE['lang_value']) ? '' : $_COOKIE['lang_value'];
    $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];

    // TODO: аналогично все поля.

    // Включаем содержимое файла form.php.
    // В нем будут доступны переменные $messages, $errors и $values для вывода
    // сообщений, полей с ранее заполненными данными и признаками ошибок.
    include('form.php');
} // Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
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
        setcookie('name_value', $_POST['name'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['phone'])) {
        setcookie('phone_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (!preg_match('/^(\+7|7|8)[0-9]{10}$/', $_POST['phone'])) {
        setcookie('phone_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('phone_value', $_POST['phone'], time() + 365 * 24 * 60 * 60);
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
        setcookie('email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
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
        setcookie('date_value', $_POST['birthday'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('gen_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('gen_value', $_POST['gender'], time() + 365 * 24 * 60 * 60);
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
        setcookie('bio_value', $_POST['biography'], time() + 365 * 24 * 60 * 60);
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
        setcookie('lang_value', $_POST['languages'], time() + 365 * 24 * 60 * 60);
    }
// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
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
        // TODO: тут необходимо удалить остальные Cookies.
    }

    // Сохранение в БД.
    // ...

    // Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');

    // Делаем перенаправление.
    header('Location: index.php');
}
