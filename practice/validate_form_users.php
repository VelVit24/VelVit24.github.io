<?php

$errors = FALSE;
if (empty($_POST['first_name'])) {
    setcookie('pr_reg_first_name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^.{1,50}$/u', $_POST['first_name'])) {
    setcookie('pr_reg_first_name_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $_POST['first_name'])) {
    setcookie('pr_reg_first_name_error', '3', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    setcookie('pr_reg_first_name_value', $_POST['first_name'], time() + 365 * 24 * 60 * 60);
}
if (empty($_POST['last_name'])) {
    setcookie('pr_reg_last_name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^.{1,50}$/u', $_POST['last_name'])) {
    setcookie('pr_reg_last_name_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $_POST['last_name'])) {
    setcookie('pr_reg_last_name_error', '3', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    setcookie('pr_reg_last_name_value', $_POST['last_name'], time() + 365 * 24 * 60 * 60);
}

if (empty($_POST['phone'])) {
    setcookie('pr_reg_phone_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^.{11}$/', $_POST['phone'])) {
    setcookie('pr_reg_phone_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^(7|8)[0-9]{10}$/', $_POST['phone'])) {
    setcookie('pr_reg_phone_error', '3', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    setcookie('pr_reg_phone_value', $_POST['phone'], time() + 365 * 24 * 60 * 60);
}

if (empty($_POST['email'])) {
    setcookie('pr_reg_email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^.{5,256}$/u', $_POST['email'])) {
    setcookie('pr_reg_email_error', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
} else if (!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])) {
    setcookie('pr_reg_email_error', '3', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    setcookie('pr_reg_email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
}

if (empty($_POST['date'])) {
    setcookie('pr_reg_date_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    setcookie('pr_reg_date_value', $_POST['date'], time() + 365 * 24 * 60 * 60);
}
