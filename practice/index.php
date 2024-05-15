<html>
<head>
    <title>Form</title>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href='style.css' type="text/css">
</head>
<body>
<div class="header">
    <h1>Фото мастерская</h1>
</div>
<div class="container">
    <?php
    if (empty($_SESSION['practice_login'])) {
        print('<h3>Регистрация</h3>');
    }
    include ('form_reg.php');
    ?>
    <a href="login.php">ВХОД</a>
    <?php if (!empty($_SESSION['practice_login'])) {
        include ('db_conn.php');
        $stmt = $db->query('SELECT * FROM pr_prices');
        $data = $stmt->fetchAll();?>
    <h3>Прайс лист</h3>
    <table>
        <tr>
            <th>Название</th>
            <th>Цена</th>
        </tr>
        <?php
        for($i=0;$i<count($data);$i++) {
            print('<tr>');
            print('<td>'.$data[$i][1].'</td><td>'.$data[$i][2].'</td></tr>');
            print('</tr>');
        }
        ?>
    </table>
    <h3>Разместить заказ</h3>
    <?php
    if (!empty($_COOKIE['order_save'])) {
        setcookie('order_save', '', 100000);
        $message = 'Спасибо, результаты сохранены.';
    }
    if (!empty($_COOKIE['pr_order_error'])) {
        $message = '<div class="error">Пусто.</div>';
        setcookie('pr_order_error', '', 100000);
    }
    if (!empty($message)) {
        print('<div id="messages">'.$message.'</div>');
    }
    ?>
    <form action="form_order_act.php" method="POST">
        <select multiple name="order[]">
            <?php
            for($i=0;$i<count($data);$i++) {
                print('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
            }
            ?>
        </select><br/>
        <input type="submit" value="Сохранить" name="order_s">
    </form>
    <h3>Ваши заказы</h3>
    <?php
    $stmt = $db->prepare('SELECT id_order, date from pr_orders where id_user = ?');
    $stmt->execute([$_SESSION['practice_uid']]);
    $row1 = $stmt->fetchAll();
    $stmt = $db->prepare('select ords.id_order, name_service, price from pr_orders ords, pr_order_price ord, pr_prices pr where ords.id_order = ord.id_order and ord.id_price = pr.id_price and ords.id_user = ?');
    $stmt->execute([$_SESSION['practice_uid']]);
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
    <?php }
    if (!empty($_SESSION['login'])) {
        print('<form action="exit.php" method="POST">');
        print('<input type="submit" name="act_exit" value="Выход"></form>');
    }
    ?>
</div>