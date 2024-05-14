<?php
include('db_conn.php');
include('validate_form_users.php');

if ($errors) {
    header('Location: index.php');
    exit();
} else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('pr_reg_first_name_error', '', 100000);
    setcookie('pr_reg_last_name_error', '', 100000);
    setcookie('pr_reg_phone_error', '', 100000);
    setcookie('pr_reg_email_error', '', 100000);
    setcookie('pr_reg_date_error', '', 100000);
}

if (!empty($_COOKIE[session_name()]) &&
    session_start() && !empty($_SESSION['practice_login'])) {
    include ('db_conn.php');
    $stmt = $db->prepare("UPDATE pr_users SET last_name = ?, first_name = ?, phone = ?, email = ?, birthday = ?,  WHERE id_user = ?");
    $stmt->execute([$_POST['last_name'],$_POST['first_name'],$_POST['phone'],$_POST['email'],$_POST['date'],$_SESSION['practice_uid']]);
} else {
    session_start();
    // Генерируем уникальный логин и пароль.
    $login = 'user';
    $pass = rand(100000, 999999);

    // Сохраняем в Cookies.
    setcookie('practice_pass', $pass);

    try {
        $stmt = $db->prepare("INSERT INTO pr_users SET last_name = ?, first_name = ?, phone = ?, email = ?, birthday = ?");
        $stmt->execute([$_POST['last_name'],$_POST['first_name'],$_POST['phone'],$_POST['email'],$_POST['date']]);
        $li = $db->lastInsertId();
        $login = 'user' . $li;
        $stmt = $db->prepare("INSERT INTO pr_logins SET id_user = ?, login = ?, pass = ?");
        $stmt->execute([$li,$login, md5($pass)]);
    }
    catch(PDOException $e){
        echo ('Error : ' . $e->getMessage());
        exit();
    }
    setcookie('practice_login', $login);
}

// Сохраняем куку с признаком успешного сохранения.
setcookie('save', '1');

// Делаем перенаправление.
header('Location: ./');