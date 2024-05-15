<?php
header('Content-Type: text/html; charset=UTF-8');
include('../db_conn.php');
$stmt = $db->query("SELECT * FROM admin");
$row = $stmt->fetch();
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $row['login']||
    md5($_SERVER['PHP_AUTH_PW']) != $row['pass']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}
?>
<html>
<head>
    <title>Form</title>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href='style.css' type="text/css">
</head>
<body>
<div class="container">
    <h3>Прайс лист</h3>
    <table border="2">
        <tr>
            <th>id_price</th>
            <th>name_service</th>
            <th>price</th>
        </tr>
        <?php
        $stmt = $db->query("SELECT * FROM pr_prices");
        while ($row = $stmt->fetch()) {
            print('<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>');
        }
        ?>
    </table>
    <h3>Изменение прайс листа</h3>
    <?php
    $messages = array();

    if (!empty($_COOKIE['pr_price_save'])) {
        setcookie('pr_price_save', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены.';
    }
    $errors = array();
    $errors['id_price'] = !empty($_COOKIE['pr_id_price_error']);
    $errors['name'] = !empty($_COOKIE['pr_name_error']);
    $errors['price'] = !empty($_COOKIE['pr_price_error']);

    if ($errors['id_price']) {
        if ($_COOKIE['pr_id_price_error'] == 1)
            $messages[] = '<div class="error">Заполните id.</div>';
        if ($_COOKIE['pr_id_price_error'] == 2)
            $messages[] = '<div class="error">Такого id нет.</div>';
        setcookie('pr_id_price_error', '', 100000);
    }
    if ($errors['name']) {
        if ($_COOKIE['pr_name_error'] == 1)
            $messages[] = '<div class="error">Заполните название.</div>';
        setcookie('pr_name_error', '', 100000);
    }
    if ($errors['price']) {
        if ($_COOKIE['pr_price_error'] == 1)
            $messages[] = '<div class="error">Заполните цену.</div>';
        setcookie('pr_reg_phone_error', '', 100000);
    }

    $values = array();
    $values['id_price'] = empty($_COOKIE['pr_id_price_error']) ? '' : $_COOKIE['pr_id_price_error'];
    $values['name'] = empty($_COOKIE['pr_name_error']) ? '' : $_COOKIE['pr_name_error'];
    $values['price'] = empty($_COOKIE['pr_price_error']) ? '' : $_COOKIE['pr_price_error'];
    ?>
    <form action="adm_price_form_act.php" method="POST">
        <label>ID<br/>
            <input name="id_price" <?php if ($errors['id_price']) {print 'class="error"';} ?> value="<?php print $values['id_price']; ?>">
        </label><br/>
        <label>Название<br/>
            <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>">
        </label><br/>
        <label>Цена<br/>
            <input name="price" <?php if ($errors['price']) {print 'class="error"';} ?> value="<?php print $values['price']; ?>">
        </label><br/>
        <input type="submit" name="add" value="Добавить"><br/>
        <input type="submit" name="red" value="Изменить"><br/>
        <input type="submit" name="del" value="Удалить"><br/>
    </form>
</div>