<?php
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
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
        <input type="radio" name="gender" value="male" <?php if ($errors['gender']) {print 'class="error-ch"';} ?> <?php if ($values['gen']=="male") {print 'checked';} ?> >  Мужской<br/>
        <input type="radio" name="gender" value="female" <?php if ($errors['gender']) {print 'class="error-ch"';} ?> <?php if ($values['gen']=="female") {print 'checked';} ?> >  Женский
    </label><br/>
    <label>Языки программирования:<br/>
        <select multiple name="languages[]" <?php if ($errors['lang']) {print 'class="error"';} ?>>
            <option value="1" <?php if (strpos($values['lang'], "|1|")) {print 'selected';} ?>>Pascal</option>
            <option value="2" <?php if (strpos($values['lang'], "|2|")) {print 'selected';} ?>>C</option>
            <option value="3" <?php if (strpos($values['lang'], "|3|")) {print 'selected';} ?>>C++</option>
            <option value="4" <?php if (strpos($values['lang'], "|4|")) {print 'selected';} ?>>JavaScript</option>
            <option value="5" <?php if (strpos($values['lang'], "|5|")) {print 'selected';} ?>>PHP</option>
            <option value="6" <?php if (strpos($values['lang'], "|6|")) {print 'selected';} ?>>Python</option>
            <option value="7" <?php if (strpos($values['lang'], "|7|")) {print 'selected';} ?>>Java</option>
            <option value="8" <?php if (strpos($values['lang'], "|8|")) {print 'selected';} ?>>Haskel</option>
            <option value="9" <?php if (strpos($values['lang'], "|9|")) {print 'selected';} ?>>Clojure</option>
            <option value="10" <?php if (strpos($values['lang'], "|10|")) {print 'selected';} ?>>Prolog</option>
            <option value="11" <?php if (strpos($values['lang'], "|11|")) {print 'selected';} ?>>Scala</option>
        </select>
    </label><br/>
    <label>Биография<br/>
        <textarea name="biography" <?php if ($errors['bio']) {print 'class="error"';} ?> ><?php print $values['bio']; ?></textarea>
    </label><br/>
    <label for="cb" class="label-checkbox">
        <input name="check" type="checkbox" id="cb" value="1" <?php if ($errors['check']) {print 'class="error-ch"';} ?> > С контрактом ознакомлен(а).
    </label><br/>
    <input type="submit" name="ok" value="Сохранить">
</form>