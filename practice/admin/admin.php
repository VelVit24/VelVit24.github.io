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
    <link rel="stylesheet" href='../style.css' type="text/css">
</head>
<body>
<div class="container">
    <h3>Пользователи</h3>
    <div class="cont">
        <table>
            <tr>
                <th>id</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Email</th>
            </tr>
            <?php
            $stmt = $db->query("SELECT * FROM pr_users");
            while ($row = $stmt->fetch()) {
                print('<tr>');
                for ($i=0;$i<count($row)/2;$i++) {
                    print('<td>' . $row[$i] . '</td>');
                }
                print('</tr>');
            }
            ?>
        </table>
        <h3>Изменение пользователей</h3>
        <?php
        $messages = array();

        if (!empty($_COOKIE['pr_user_save'])) {
            setcookie('pr_user_save', '', 100000);
            $messages[] = 'Спасибо, результаты сохранены.';
        }
        $errors = array();
        $errors['id_user'] = !empty($_COOKIE['pr_user_id_user_error']);
        $errors['last_name'] = !empty($_COOKIE['pr_user_last_name_error']);
        $errors['first_name'] = !empty($_COOKIE['pr_user_first_name_error']);
        $errors['date'] = !empty($_COOKIE['pr_user_date_error']);
        $errors['phone'] = !empty($_COOKIE['pr_user_phone_error']);
        $errors['email'] = !empty($_COOKIE['pr_user_email_error']);

        if ($errors['id_user']) {
            if ($_COOKIE['pr_id_user_user_error'] == 1)
                $messages[] = '<div class="error">Заполните id.</div>';
            if ($_COOKIE['pr_id_user_user_error'] == 2)
                $messages[] = '<div class="error">Такого id нет.</div>';
            setcookie('pr_id_user_user_error', '', 100000);
        }
        if ($errors['last_name']) {
            if ($_COOKIE['pr_user_last_name_error'] == 1)
                $messages[] = '<div class="error">Заполните Фамилию.</div>';
            setcookie('pr_user_last_name_error', '', 100000);
        }
        if ($errors['first_name']) {
            if ($_COOKIE['pr_user_first_name_error'] == 1)
                $messages[] = '<div class="error">Заполните Имя.</div>';
            setcookie('pr_user_first_name_error', '', 100000);
        }
        if ($errors['date']) {
            if ($_COOKIE['pr_user_date_error'] == 1)
                $messages[] = '<div class="error">Заполните дату рождения.</div>';
            setcookie('pr_user_date_error', '', 100000);
        }
        if ($errors['phone']) {
            if ($_COOKIE['pr_user_phone_error'] == 1)
                $messages[] = '<div class="error">Заполните телефон.</div>';
            setcookie('pr_user_phone_error', '', 100000);
        }
        if ($errors['email']) {
            if ($_COOKIE['pr_user_email_error'] == 1)
                $messages[] = '<div class="error">Заполните email.</div>';
            setcookie('pr_user_email_error', '', 100000);
        }

        $values = array();
        $values['id_user'] = empty($_COOKIE['pr_user_id_user_error']) ? '' : $_COOKIE['pr_user_id_user_error'];
        $values['last_name'] = empty($_COOKIE['pr_user_last_name_error']) ? '' : $_COOKIE['pr_user_last_name_error'];
        $values['first_name'] = empty($_COOKIE['pr_user_first_name_error']) ? '' : $_COOKIE['pr_user_first_name_error'];
        $values['date'] = empty($_COOKIE['pr_user_date_error']) ? '' : $_COOKIE['pr_user_date_error'];
        $values['phone'] = empty($_COOKIE['pr_user_phone_error']) ? '' : $_COOKIE['pr_user_phone_error'];
        $values['email'] = empty($_COOKIE['pr_user_email_error']) ? '' : $_COOKIE['pr_user_email_error'];
        if (!empty($messages)) {
            print('<div id="messages">');
            // Выводим все сообщения.
            foreach ($messages as $message) {
                print($message);
            }
            print('</div>');
        }
        ?>
        <form action="adm_user_form_act.php" method="POST">
            <label>ID<br/>
                <input name="id_user" <?php if ($errors['id_user']) {print 'class="error"';} ?> value="<?php print $values['id_user']; ?>">
            </label><br/>
            <label>Фамилия<br/>
                <input name="last_name" <?php if ($errors['last_name']) {print 'class="error"';} ?> value="<?php print $values['last_name']; ?>">
            </label><br/>
            <label>Имя<br/>
                <input name="first_name" <?php if ($errors['first_name']) {print 'class="error"';} ?> value="<?php print $values['first_name']; ?>">
            </label><br/>
            <label>Дата рождения<br/>
                <input name="date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
            </label><br/>
            <label>Телефон<br/>
                <input name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php print $values['phone']; ?>">
            </label><br/>
            <label>Email<br/>
                <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
            </label><br/>
            <input type="submit" name="red" value="Изменить"><br/>
            <input type="submit" name="del" value="Удалить"><br/>
        </form>
    </div>

    <h3>Заказы</h3>
    <div class="cont">
        <h4>Найти заказ по id пользователя</h4>
        <?php
        $messages = array();
        $errors = array();
        $errors['id_user'] = !empty($_COOKIE['pr_adm_order_user_error']);
        if ($errors['id_user']) {
            if ($_COOKIE['pr_adm_order_user_error'] == 1)
                $messages[] = '<div class="error">Заполните id.</div>';
            if ($_COOKIE['pr_adm_order_user_error'] == 2)
                $messages[] = '<div class="error">Такого id нет.</div>';
            setcookie('pr_adm_order_user_error', '', 100000);
        }
        if (!empty($messages)) {
            print('<div id="messages">');
            foreach ($messages as $message) {
                print($message);
            }
            print('</div>');
        }
        ?>
        <form action="adm_order_user_form_act.php" method="POST">
            <label>
                <input name="id_user" <?php if ($errors['id_user']) {print 'class="error"';} ?> value="<?php print $values['id_user']; ?>">
            </label><br/>
            <label>
                <input type="submit" value="Найти">
            </label>
        </form>
        <?php
        if (!empty($_COOKIE['pr_adm_order_user_value'])){
            setcookie('pr_adm_order_user_value', '', 100000);
            $stmt = $db->prepare('SELECT id_order, date from pr_orders where id_user = ?');
            $stmt->execute([$_COOKIE['pr_adm_order_user_value']]);
            $row1 = $stmt->fetchAll();
            $stmt = $db->prepare('select ords.id_order, name_service, price from pr_orders ords, pr_order_price ord, pr_prices pr where ords.id_order = ord.id_order and ord.id_price = pr.id_price and ords.id_user = ?');
            $stmt->execute([$_COOKIE['pr_adm_order_user_value']]);
            $row2 = $stmt->fetchAll();
            ?>
            <table>
                <tr>
                    <th>ID заказа</th>
                    <th>Дата</th>
                    <th>Название</th>
                    <th>Цены</th>
                </tr>
                <?php
                for($i=0;$i<count($row1);$i++) {
                    print('<tr>');
                    print('<td>'.$row1[$i][0].'</td><td>'.$row1[$i][1].'</td><td>');
                    for ($j=0; $j<count($row2);$j++) {
                        if($row1[$i][0] == $row2[$j][0]) {
                            print($row2[$j][1].'<br/>');
                        }
                    }
                    print('</td><td>');
                    for ($j=0; $j<count($row2);$j++) {
                        if($row1[$i][0] == $row2[$j][0]) {
                            print($row2[$j][2].'<br/>');
                        }
                    }
                    print('</td>');
                    print('</tr>');
                }
                ?>
            </table>
            <?php
        }
        ?>
    </div>


    <h3>Прайс лист</h3>
    <table>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Цена</th>
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
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
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


    <h3>Исполнители</h3>
    <table>
        <tr>
            <th>id</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Дата рождения</th>
            <th>Телефон</th>
            <th>Email</th>
        </tr>
        <?php
        $stmt = $db->query("SELECT * FROM pr_performers");
        while ($row = $stmt->fetch()) {
            print('<tr>');
            for ($i=0;$i<count($row)/2;$i++) {
                print('<td>' . $row[$i] . '</td>');
            }
            print('</tr>');
        }
        ?>
    </table>
    <h3>Изменение Исполнителей</h3>
    <?php
    $messages = array();

    if (!empty($_COOKIE['pr_perf_save'])) {
        setcookie('pr_perf_save', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены.';
    }
    $errors = array();
    $errors['id_perf'] = !empty($_COOKIE['pr_id_perf_error']);
    $errors['last_name'] = !empty($_COOKIE['pr_last_name_error']);
    $errors['first_name'] = !empty($_COOKIE['pr_first_name_error']);
    $errors['date'] = !empty($_COOKIE['pr_date_error']);
    $errors['phone'] = !empty($_COOKIE['pr_phone_error']);
    $errors['email'] = !empty($_COOKIE['pr_email_error']);

    if ($errors['id_perf']) {
        if ($_COOKIE['pr_id_perf_error'] == 1)
            $messages[] = '<div class="error">Заполните id.</div>';
        if ($_COOKIE['pr_id_perf_error'] == 2)
            $messages[] = '<div class="error">Такого id нет.</div>';
        setcookie('pr_id_perf_error', '', 100000);
    }
    if ($errors['last_name']) {
        if ($_COOKIE['pr_last_name_error'] == 1)
            $messages[] = '<div class="error">Заполните Фамилию.</div>';
        setcookie('pr_last_name_error', '', 100000);
    }
    if ($errors['first_name']) {
        if ($_COOKIE['pr_first_name_error'] == 1)
            $messages[] = '<div class="error">Заполните Имя.</div>';
        setcookie('pr_first_name_error', '', 100000);
    }
    if ($errors['date']) {
        if ($_COOKIE['pr_date_error'] == 1)
            $messages[] = '<div class="error">Заполните дату рождения.</div>';
        setcookie('pr_date_error', '', 100000);
    }
    if ($errors['phone']) {
        if ($_COOKIE['pr_phone_error'] == 1)
            $messages[] = '<div class="error">Заполните телефон.</div>';
        setcookie('pr_phone_error', '', 100000);
    }
    if ($errors['email']) {
        if ($_COOKIE['pr_email_error'] == 1)
            $messages[] = '<div class="error">Заполните email.</div>';
        setcookie('pr_email_error', '', 100000);
    }

    $values = array();
    $values['id_perf'] = empty($_COOKIE['pr_id_perf_error']) ? '' : $_COOKIE['pr_id_perf_error'];
    $values['last_name'] = empty($_COOKIE['pr_last_name_error']) ? '' : $_COOKIE['pr_last_name_error'];
    $values['first_name'] = empty($_COOKIE['pr_first_name_error']) ? '' : $_COOKIE['pr_first_name_error'];
    $values['date'] = empty($_COOKIE['pr_date_error']) ? '' : $_COOKIE['pr_date_error'];
    $values['phone'] = empty($_COOKIE['pr_phone_error']) ? '' : $_COOKIE['pr_phone_error'];
    $values['email'] = empty($_COOKIE['pr_email_error']) ? '' : $_COOKIE['pr_email_error'];
    if (!empty($messages)) {
        print('<div id="messages">');
        // Выводим все сообщения.
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
    ?>
    <form action="adm_perf_form_act.php" method="POST">
        <label>ID<br/>
            <input name="id_perf" <?php if ($errors['id_perf']) {print 'class="error"';} ?> value="<?php print $values['id_perf']; ?>">
        </label><br/>
        <label>Фамилия<br/>
            <input name="last_name" <?php if ($errors['last_name']) {print 'class="error"';} ?> value="<?php print $values['last_name']; ?>">
        </label><br/>
        <label>Имя<br/>
            <input name="first_name" <?php if ($errors['first_name']) {print 'class="error"';} ?> value="<?php print $values['first_name']; ?>">
        </label><br/>
        <label>Дата рождения<br/>
            <input name="date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
        </label><br/>
        <label>Телефон<br/>
            <input name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php print $values['phone']; ?>">
        </label><br/>
        <label>Email<br/>
            <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
        </label><br/>
        <input type="submit" name="add" value="Добавить"><br/>
        <input type="submit" name="red" value="Изменить"><br/>
        <input type="submit" name="del" value="Удалить"><br/>
    </form>
</div>