<?php
$stmt = $db->prepare("UPDATE application SET name = ?, phone_number = ?, email = ?, birthday = ?, gender = ?, biography = ? WHERE id_app = ?");
$stmt->execute([$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['gender'],$_POST['biography'],$_SESSION['uid']]);
$stmt = $db->prepare("DELETE FROM applications_languages WHERE id_app = ?");
$stmt->execute([$_SESSION['uid']]);
foreach ($_POST['languages'] as $language) {
    $stmt = $db->prepare("INSERT INTO applications_languages SET id_app = ?, id_lang = ?");
    $stmt->execute([$_SESSION['uid'], $language]);
}