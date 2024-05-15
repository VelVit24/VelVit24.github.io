<?php
header('Content-Type: text/html; charset=UTF-8');
include('db_conn.php');
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

print('<h2>Заказы</h2>');
$stmt = $db->query('SELECT * FROM pr_orders join');
$row = $stmt->fetch();
$stmt = $db->query('SELECT id_order, name_service, price from pr_order_price join pr_prices on pr_order_price.id_price = pr_prices.id_price');
$row2 = $stmt2->fetchAll();
$stmt = $db->query('select sum(price) from pr_order_price join pr_prices on pr_order_price.id_price = pr_prices.id_price group by(id_order);');
$row3 = $stmt2->fetchAll();
?>
<link rel="stylesheet" href='style.css' type="text/css">
<table border="1">
    <tr>
        <th>ID заказа</th>
        <th>ID пользователя</th>
        <th>Дата</th>
        <th>Email</th>
        <th>День рождения</th>
        <th>Пол</th>
        <th>Биография</th>
        <th>Языки программирования</th>
    </tr>
    <?php while ($row = $stmt->fetch()) {
        print('<tr>');

        for($i = 0; $i < 7; $i++) {
            print('<td>'.$row[$i].'</td>');
        }
        print('<td>');
        foreach ($row2 as $i) {
            if ($row['id_app'] == $i['id_app']) {
                print($i['name_lang'].'<br/>');
            }
        }
        print('</td>');
    }
    ?>

</table>