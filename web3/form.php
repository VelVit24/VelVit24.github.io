<form action="" method="POST">
    <label>
        <input name="name" type="text" placeholder="ФИО">
    </label><br/>
    <label>
        <input name="phone" type="tel" placeholder="Телефон">
    </label><br/>
    <label>
        <input name="email" type="email" placeholder="E-mail">
    </label><br/>
    <label>
        <input name="birthday" type="date" placeholder="Дата рождения">
    </label><br/>
    <label>
        <input type="radio" name="gender" value="male" checked>
        <input type="radio" name="gender" value="female">
    </label>
    <label>
        <select multiple>
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
    <label>
        <textarea name="biography" placeholder="Биография"></textarea>
    </label><br/>
    <label for="cb" class="label-checkbox">
        <input required="required" name="check" type="checkbox" id="cb"> С контрактом ознакомлен(а).
    </label><br/>
    <input type="submit" value="Сохранить">
</form>
