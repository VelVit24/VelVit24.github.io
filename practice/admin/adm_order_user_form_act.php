<?php
include ('../db_conn.php');
$error = FALSE;
if (empty($_POST['id_user'])) {
    $error = TRUE;
    setcookie('pr_adm_order_user_error', '1', time() + 24 * 60 * 60);
}
else {
    $stmt = $db->prepare('SELECT * FROM pr_users where id_user = ?');
    $stmt->execute([$_POST['id_user']]);
    if (empty($stmt->fetch())) {
        setcookie('pr_adm_order_user_error', '2', time() + 24 * 60 * 60);
        $error = TRUE;
    }
}
if ($error) {
    header('Location: admin.php');
    exit();
} else {
    setcookie('pr_adm_order_user_error', '', 100000);
}
setcookie('pr_adm_order_user_value', $_POST['id_user'], time() + 24 * 60 * 60);
header('Location: admin.php');