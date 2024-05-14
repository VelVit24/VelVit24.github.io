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
    <div class="container">
        <h3>Прайс лист</h3>
        <table>
            <tr>
                <th>Название</th>
                <th>Цена</th>
            </tr>
            <?php
            var_dump($data);
            for($i=0;$i<count($data);$i++) {
                print('<tr>');
                print('<td>'.$data[$i][1].'</td><td>'.$data[$i][2].'</td></tr>');
                print('</tr>');
            }
            ?>
        </table>
        <h3>Разместить заказ</h3>
        <?php
        if ($_COOKIE['order_save']) {
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
        <form action="" method="POST">
            <select multiple name="order[]">
                <?php
                for($i=0;$i<count($data);$i++) {
                    print('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
                }
                ?>
            </select>
        </form>
    </div>
    <?php } ?>
</div>