<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $message = '';
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    $message = 'Спасибо, результаты сохранены.';
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
$message = '';
if (empty($_POST['name'])) {
    $message += ('Заполните имя.<br/>');
  $errors = TRUE;
}
elseif (!preg_match('/^[a-zA-ZА-Яа-яЁё ]+$/u',$_POST['name'])) {
    $message += 'Поле имени должно содержать только буквы и пробелы.<br/>';
    $errors = TRUE;
}
elseif (strlen($_POST['name'])>=150) {
    $message += 'Поле имени должно содержать до 150 символов.<br/>';
    $errors = TRUE;
}
if (empty($_POST['phone'])) {
    $message += ('Заполните телефон.<br/>');
    $errors = TRUE;
}
else {
    $phone = preg_replace('/\D/', '', $_POST['phone']);
    if (strlen($phone) != 11) {
        $message +=('Неверный номер телефона.<br/>');
        $errors = TRUE;
    }
}
if (empty($_POST['email'])) {
    $message += ('Заполните E-mail.<br/>');
    $errors = TRUE;
}
elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message += 'Неверный e-mail.<br/>';
    $errors = TRUE;
}
if (empty($_POST['birthday'])) {
    $message += ('Заполните дату рождения.<br/>');
    $errors = TRUE;
}
$fl = true;
foreach ($_POST['languages'] as $language) {
    if (!empty($language)) $fl = false;
}
if ($fl) {
    $message += ('Выберите хотя бы 1 язык программирования.<br/>');
    $errors = TRUE;
}
if (empty($_POST['biography'])) {
    $message += ('Заполните биографию.<br/>');
    $errors = TRUE;
}
/*
elseif (!is_numeric($_POST['birthday']) || !preg_match('/^\d+$/', $_POST['birthday'])) {
    print('Неверная дата.<br/>');
    $errors = TRUE;
}
*/

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u67330'; // Заменить на ваш логин uXXXXX
$pass = '3199779'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u67330', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO application SET name = ?, phone_number = ?, email = ?, birthday = ?, gender = ?, biography = ?");
    $stmt->execute([$_POST['name'],$phone,$_POST['email'],$_POST['birthday'],$_POST['gender'],$_POST['biography']]);
    $li = $db->lastInsertId();
    foreach ($_POST['languages'] as $language) {
        $stmt = $db->prepare("INSERT INTO applications_languages SET id_app = ?, id_lang = ?");
        $stmt->execute([$li, $language]);
    }
}
catch(PDOException $e){
    $message += ('Error : ' . $e->getMessage());
  exit();
}

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
