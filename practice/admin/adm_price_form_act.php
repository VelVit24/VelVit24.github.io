<?php
include ('../db_conn.php');
if (isset($_POST['add']) or isset($_POST['red'])) {
    $error = FALSE;
    if (empty($_POST['id_price'])) {
        setcookie('pr_id_price_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    }
    else if (isset($_POST['red'])) {
        $stmt = $db->prepare('SELECT * FROM pr_prices where id_price = ?');
        $stmt->execute([$_POST['id_price']]);
        if(empty($stmt->fetch())) {
            setcookie('pr_id_price_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        }
    }
    else {setcookie('pr_id_price_value', $_POST['id_price'], time() + 24 * 60 * 60);}
    if (empty($_POST['name'])) {
        setcookie('pr_name_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    }
    else {setcookie('pr_name_value', $_POST['name'], time() + 24 * 60 * 60);}
    if (empty($_POST['price'])) {
        setcookie('pr_price_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    }
    else {setcookie('pr_price_value', $_POST['price'], time() + 24 * 60 * 60);}
    if ($errors) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_id_price_error', '', 100000);
        setcookie('pr_name_error', '', 100000);
        setcookie('pr_price_error', '', 100000);
    }
    if (isset($_POST['add'])) {
        try {
            $stmt->prepare('INSERT INTO pr_prices (id_price, name, price) VALUES (?, ?, ?)');
            $stmt->execute([$_POST['id_price'], $_POST['name'], $_POST['price']]);
        }
        catch(PDOException $e){
            echo ('Error : ' . $e->getMessage());
            exit();
        }
    }
    else {
        try {
            $stmt->prepare('UPDATE pr_prices SET name = ?, price = ? WHERE id_price = ?');
            $stmt->execute([$_POST['name'], $_POST['price'], $_POST['id_price']]);
        }
        catch(PDOException $e){
            echo ('Error : ' . $e->getMessage());
            exit();
        }
    }
}
else {
    $error = FALSE;
    if (empty($_POST['id_price'])) {
        setcookie('pr_id_price_error', '1', time() + 24 * 60 * 60);
        $error = TRUE;
    }
    else {
        $stmt = $db->prepare('SELECT * FROM pr_prices where id_price = ?');
        $stmt->execute([$_POST['id_price']]);
        if (empty($stmt->fetch())) {
            setcookie('pr_id_price_error', '2', time() + 24 * 60 * 60);
            $error = TRUE;
        }
        else {setcookie('pr_id_price_value', $_POST['id_price'], time() + 24 * 60 * 60);}
    }
    if ($errors) {
        header('Location: admin.php');
        exit();
    } else {
        setcookie('pr_id_price_error', '', 100000);
    }
    try {
        $stmt = $db->prepare('DELETE FROM pr_order_price WHERE id_price = ?');
        $stmt->execute([$_POST['id_price']]);
        $stmt = $db->prepare('DELETE FROM pr_prices WHERE id_price = ?');
        $stmt->execute([$_POST['id_price']]);
    }
    catch(PDOException $e){
        echo ('Error : ' . $e->getMessage());
        exit();
    }
}

setcookie('pr_price_save', '1');

// Делаем перенаправление.
header('Location: ./');