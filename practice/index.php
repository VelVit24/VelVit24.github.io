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
        print('Регистрация');
    }
    include ('form_reg.php');
    ?>
    <a href="login.php">ВХОД</a>
</div>