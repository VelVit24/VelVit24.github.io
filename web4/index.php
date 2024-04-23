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
    $errors['bio'] = !empty($_COOKIE['bio_error']);
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

    // TODO: тут выдать сообщения об ошибках в других полях.

    // Складываем предыдущие значения полей в массив, если есть.
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
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
    else if (preg_match('//^.{1,150}$//', $_POST['name'])) {
        setcookie('name_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else if (preg_match('/^[а-яА-ЯёЁ\s]+$/', $_POST['name'])) {
        setcookie('name_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
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
        // TODO: тут необходимо удалить остальные Cookies.
    }

    // Сохранение в БД.
    // ...

    // Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');

    // Делаем перенаправление.
    header('Location: index.php');
}
