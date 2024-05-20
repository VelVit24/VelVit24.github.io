<?php
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