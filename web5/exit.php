<?php
if (isset($_POST['act_exit'])) {
    setcookie(session_name(), '', 100000);
    session_destroy();
    setcookie('name_value', '', 100000);
    setcookie('phone_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('date_value', '', 100000);
    setcookie('gen_value', '', 100000);
    setcookie('lang_value', '', 100000);
    setcookie('bio_value', '', 100000);
    setcookie('check_value', '', 100000);
    header('Location: ./');
}