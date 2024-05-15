<?php

include('../db_conn.php');
if (isset($_POST['red'])) {
    $error = FALSE;
    if (empty($_POST['id_user'])) {
        setcookie('pr_user_id_user_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else if (isset($_POST['red'])) {
        $stmt = $db->prepare('SELECT * FROM pr_users where id_user = ?');
        $stmt->execute([$_POST['id_user']]);
        if (empty($stmt->fetch())) {
            setcookie('pr_user_id_user_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        }
    } else {
        setcookie('pr_user_id_user_value', $_POST['id_user'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['last_name'])) {
        setcookie('pr_user_last_name_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_user_last_name_value', $_POST['last_name'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['first_name'])) {
        setcookie('pr_user_first_name_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_user_first_name_value', $_POST['first_name'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['date'])) {
        setcookie('pr_user_date_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_user_date_value', $_POST['date'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['phone'])) {
        setcookie('pr_user_phone_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_user_phone_value', $_POST['phone'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['email'])) {
        setcookie('pr_user_email_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_user_email_value', $_POST['email'], time() + 24 * 60 * 60);
    }
    if ($error) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_user_id_user_error', '', 100000);
        setcookie('pr_user_last_name_error', '', 100000);
        setcookie('pr_user_first_name_error', '', 100000);
        setcookie('pr_user_date_error', '', 100000);
        setcookie('pr_user_phone_error', '', 100000);
        setcookie('pr_user_email_error', '', 100000);
    }
    try {
        $stmt = $db->prepare('UPDATE pr_users SET last_name=?, first_name=?, birthday=?, phone=?, email=? where id_user = ?');
        $stmt->execute([$_POST['last_name'], $_POST['first_name'], $_POST['date'], $_POST['phone'], $_POST['email'], $_POST['id_user']]);
    } catch (PDOException $e) {
        echo('Error : ' . $e->getMessage());
        exit();
    }
} else {
    $error = FALSE;
    if (empty($_POST['id_user'])) {
        setcookie('pr_user_id_user_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        $stmt = $db->prepare('SELECT * FROM pr_users where id_user = ?');
        $stmt->execute([$_POST['id_user']]);
        if (empty($stmt->fetch())) {
            setcookie('pr_user_id_user_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        } else {
            setcookie('pr_user_id_user_value', $_POST['id_user'], time() + 24 * 60 * 60);
        }
    }
    if ($error) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_user_id_user_error', '', 100000);
    }
    try {
        $stmt = $db->prepare('DELETE FROM pr_logins WHERE id_user = ?');
        $stmt->execute([$_POST['id_user']]);
        $stmt = $db->prepare('DELETE FROM pr_users WHERE id_user = ?');
        $stmt->execute([$_POST['id_user']]);
    } catch (PDOException $e) {
        echo('Error : ' . $e->getMessage());
        exit();
    }
}

setcookie('pr_user_save', '1');

// Делаем перенаправление.
header('Location: admin.php');