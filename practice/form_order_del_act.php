<?php

include('db_conn.php');
session_start();
$errors = FALSE;
if (empty($_POST['id_order'])) {
    setcookie('pr_order_del_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
} else {
    $stmt = $db->prepare("SELECT * FROM pr_orders WHERE id_order = ?");
    $stmt->execute([$_POST['id_order']]);
    if (empty($row = $stmt->fetch())) {
        $errors = TRUE;
        setcookie('pr_order_del_error', '2', time() + 24 * 60 * 60);
    }
}
if ($errors) {
    header('Location: index.php');
    exit();
} else {
    setcookie('pr_order_del_error', '', 100000);
}

try {
    $stmt = $db->prepare("DELETE pr FROM pr_order_price pr join pr_orders ord on pr.id_order = ord.id_order WHERE pr.id_order = ? and ord.id_user = ?");
    $stmt->execute([$_POST['id_order'], $_SESSION['practice_login']]);
    $stmt = $db->prepare("DELETE FROM pr_orders WHERE id_order = ? and id_user = ?");
    $stmt->execute([$_POST['id_order'], $_SESSION['practice_login']]);
} catch (PDOException $e) {
    echo('Error : ' . $e->getMessage());
    exit();
}

setcookie('order_del', '1');
header('Location: index.php');