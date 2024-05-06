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
    <label> ID пользователя<br/>
        <input type="text" name="upd_id" <?php if ($errors['ipd_id']) {print 'class="error"';} ?> >
    </label><br/>
    <input type="submit" name="update1" value="Сохранить">
</form>