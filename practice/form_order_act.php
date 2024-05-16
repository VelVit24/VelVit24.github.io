<?php
include ('db_conn.php');
session_start();
$errors = FALSE;
if (empty($_POST['order'])) {
    setcookie('pr_order_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
}
else {
    $t = "||";
    foreach ($_POST['order'] as $lg) {
        $t = $t . $lg . "|";
    }
    setcookie('pr_order_value', $t, time() + 365 * 24 * 60 * 60);
}
if ($errors) {
    header('Location: index.php');
    exit();
} else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('pr_order_error', '', 100000);
}

try {
    $stmt = $db->query('SELECT id_perf FROM pr_performers');
    $rows = $stmt->fetchAll();
    $id_perf = $rows[rand(0,count($rows)-1)][0];
    $stmt = $db->prepare("INSERT INTO pr_orders SET id_user = ?, date = ?, id_perf = ?");
    $stmt->execute([$_SESSION['practice_uid'], date("Y-m-d"), $id_perf]);
    $li = $db->lastInsertId();
    foreach ($_POST['order'] as $i) {
        $stmt = $db->prepare("INSERT INTO pr_order_price SET id_order = ?, id_price = ?");
        $stmt->execute([$li, $i]);
    }
}
catch(PDOException $e){
    echo ('Error : ' . $e->getMessage());
    exit();
}

setcookie('order_save', '1');

// Делаем перенаправление.
header('Location: ./');