<?php
if (isset($_POST['act_exit'])) {
    session_start();
    setcookie(session_name(), '', 100000);
    $_SESSION = array();
    session_destroy();
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    setcookie('name_value1', '', 100000);
    setcookie('phone_value1', '', 100000);
    setcookie('email_value1', '', 100000);
    setcookie('date_value1', '', 100000);
    setcookie('gen_value1', '', 100000);
    setcookie('lang_value1', '', 100000);
    setcookie('bio_value1', '', 100000);
    setcookie('check_value1', '', 100000);
    header('Location: ./');
}