<?php
include('../db_conn.php');
$error = FALSE;
if (empty($_POST['date1']) or empty($_POST['date2'])) {
    $error = TRUE;
    setcookie('pr_adm_order_date_error', '1', time() + 24 * 60 * 60);
} else if ($_POST['date1'] > $_POST['date2']) {
    $error = TRUE;
    setcookie('pr_adm_order_date_error', '2', time() + 24 * 60 * 60);
}
if ($error) {
    header('Location: admin.php');
    exit();
} else {
    setcookie('pr_adm_order_date_error', '', 100000);
}
setcookie('pr_adm_order_date_value1', $_POST['date1'], time() + 24 * 60 * 60);
setcookie('pr_adm_order_date_value2', $_POST['date2'], time() + 24 * 60 * 60);
header('Location: admin.php');