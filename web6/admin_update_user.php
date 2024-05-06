<?php
include ('db_conn.php');
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

$stmt = $db->prepare("UPDATE application SET name = ?, phone_number = ?, email = ?, birthday = ?, gender = ?, biography = ? WHERE id_app = ?");
$stmt->execute([$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['gender'],$_POST['biography'],$_COOKIE['id_upd']]);
$stmt = $db->prepare("DELETE FROM applications_languages WHERE id_app = ?");
$stmt->execute([$_COOKIE['id_upd']]);
foreach ($_POST['languages'] as $language) {
    $stmt = $db->prepare("INSERT INTO applications_languages SET id_app = ?, id_lang = ?");
    $stmt->execute([$_COOKIE['id_upd'], $language]);
}

setcookie('admin_upd', '', 100000);


// Делаем перенаправление.
header('Location: admin.php');