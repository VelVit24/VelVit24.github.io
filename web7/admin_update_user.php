<?php
if (isset($_POST['submit'])) {
    include('db_conn.php');
    include('validate.php');

    if ($errors) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
        setcookie('phone_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gen_error', '', 100000);
        setcookie('lang_error', '', 100000);
        setcookie('bio_error', '', 100000);
        setcookie('check_error', '', 100000);
    }

    include('db_update.php');
    db_update($_COOKIE['id_upd']);

    setcookie('admin_upd', '', 100000);
}


// Делаем перенаправление.
header('Location: admin.php');