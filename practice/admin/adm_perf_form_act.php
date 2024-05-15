<?php
include('../db_conn.php');
if (isset($_POST['add']) or isset($_POST['red'])) {
    $error = FALSE;
    if (empty($_POST['id_perf'])) {
        setcookie('pr_id_perf_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else if (isset($_POST['red'])) {
        $stmt = $db->prepare('SELECT * FROM pr_performers where id_perf = ?');
        $stmt->execute([$_POST['id_perf']]);
        if (empty($stmt->fetch())) {
            setcookie('pr_id_perf_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        }
    } else {
        setcookie('pr_id_perf_value', $_POST['id_perf'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['last_name'])) {
        setcookie('pr_last_name_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_last_name_value', $_POST['last_name'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['first_name'])) {
        setcookie('pr_first_name_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_first_name_value', $_POST['first_name'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['date'])) {
        setcookie('pr_date_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_date_value', $_POST['date'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['phone'])) {
        setcookie('pr_phone_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_phone_value', $_POST['phone'], time() + 24 * 60 * 60);
    }
    if (empty($_POST['email'])) {
        setcookie('pr_email_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        setcookie('pr_email_value', $_POST['email'], time() + 24 * 60 * 60);
    }
    if ($error) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_id_perf_error', '', 100000);
        setcookie('pr_last_name_error', '', 100000);
        setcookie('pr_first_name_error', '', 100000);
        setcookie('pr_date_error', '', 100000);
        setcookie('pr_phone_error', '', 100000);
        setcookie('pr_email_error', '', 100000);
    }
    if (isset($_POST['add'])) {
        try {
            $stmt = $db->prepare('INSERT INTO pr_performers (id_perf, last_name, first_name, birthday, phone, email) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$_POST['id_perf'], $_POST['last_name'], $_POST['first_name'], $_POST['date'], $_POST['phone'], $_POST['email']]);
        } catch (PDOException $e) {
            echo('Error : ' . $e->getMessage());
            exit();
        }
    } else {
        try {
            $stmt = $db->prepare('UPDATE pr_performers SET last_name=?, first_name=?, birthday=?, phone=?, email=? where id_perf=?');
            $stmt->execute([$_POST['last_name'], $_POST['first_name'], $_POST['date'], $_POST['phone'], $_POST['email'], $_POST['id_perf']]);
        } catch (PDOException $e) {
            echo('Error : ' . $e->getMessage());
            exit();
        }
    }
} else {
    $error = FALSE;
    if (empty($_POST['id_perf'])) {
        setcookie('pr_id_perf_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    } else {
        $stmt = $db->prepare('SELECT * FROM pr_performers where id_perf = ?');
        $stmt->execute([$_POST['id_perf']]);
        if (empty($stmt->fetch())) {
            setcookie('pr_id_perf_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        } else {
            setcookie('pr_id_perf_value', $_POST['id_perf'], time() + 24 * 60 * 60);
        }
    }
    if ($error) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_id_perf_error', '', 100000);
    }
    try {
        $stmt = $db->prepare('delete pr from pr_order_price pr join pr_orders ord on pr.id_order = ord.id_order where ord.id_perf = ?');
        $stmt->execute([$_POST['id_perf']]);
        $stmt = $db->prepare('DELETE FROM pr_orders WHERE id_perf = ?');
        $stmt->execute([$_POST['id_perf']]);
        $stmt = $db->prepare('DELETE FROM pr_performers WHERE id_perf = ?');
        $stmt->execute([$_POST['id_perf']]);
    } catch (PDOException $e) {
        echo('Error : ' . $e->getMessage());
        exit();
    }
}

setcookie('pr_perf_save', '1');

// Делаем перенаправление.
header('Location: admin.php');