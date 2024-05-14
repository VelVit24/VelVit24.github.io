<?php
if (isset($_POST['act_exit'])) {
    session_start();
    setcookie(session_name(), '', 100000);
    $_SESSION = array();
    session_destroy();
    setcookie('practice_login', '', 100000);
    setcookie('practice_pass', '', 100000);
    setcookie('pr_reg_first_name_value', '', 100000);
    setcookie('pr_reg_last_name_value', '', 100000);
    setcookie('pr_reg_phone_value', '', 100000);
    setcookie('pr_reg_email_value', '', 100000);
    setcookie('pr_reg_date_value', '', 100000);
    header('Location: ./');
}