<html>
    <head>
        <title>Form</title>
        <meta charset="utf-8">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
            .error {
              border: 2px solid red;
            }
        </style>
    </head>
<body>
<div class="header">
    <h1>Drupal</h1>
</div>
<div class="container">
    <div class="cont">
        <div class="title">
            <h2>Оставить заявку для связи с нами</h2>
        </div>
        <?php
        if (!empty($messages)) {
            print('<div id="messages">');
            // Выводим все сообщения.
            foreach ($messages as $message) {
                print($message);
            }
            print('</div>');
        }

        // Далее выводим форму отмечая элементы с ошибками классом error
        // и задавая начальные значения элементов ранее сохраненными.
        ?>
        <form action="" method="POST">
            <label>Ваше ФИО<br/>
                <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>">
            </label><br/>
            <label>Номер телефона<br/>
                <input name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php print $values['phone']; ?>">
            </label><br/>
            <label>E-mail<br/>
                <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
            </label><br/>
            <label>Дата рождения<br/>
                <input name="birthday" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>">
            </label><br/>
            <label>Пол<br/>
                <input type="radio" name="gender" value="male" <?php if ($errors['date']) {print 'class="error"';} ?> <?php if ($values['gen']=="male") {print 'checked';} ?> >  Мужской<br/>
                <input type="radio" name="gender" value="female" <?php if ($errors['date']) {print 'class="error"';} ?> <?php if ($values['gen']=="female") {print 'checked';} ?> >  Женский
            </label><br/>
            <label>Языки программирования:<br/>
                <select multiple name="languages[]">
                    <option value="1">Pascal</option>
                    <option value="2">C</option>
                    <option value="3">C++</option>
                    <option value="4">JavaScript</option>
                    <option value="5">PHP</option>
                    <option value="6">Python</option>
                    <option value="7">Java</option>
                    <option value="8">Haskel</option>
                    <option value="9">Clojure</option>
                    <option value="10">Prolog</option>
                    <option value="11">Scala</option>
                </select>
            </label><br/>
            <label>Биография<br/>
                <textarea name="biography" <?php if ($errors['bio']) {print 'class="error"';} ?> ><?php print $values['bio']; ?></textarea>
            </label><br/>
            <label for="cb" class="label-checkbox">
                <input name="check" type="checkbox" id="cb" value="1" <?php if ($errors['check']) {print 'class="error"';} ?> > С контрактом ознакомлен(а).
            </label><br/>
            <input type="submit" value="Сохранить">
        </form>
    </div>
</div>
</body>

</html>

