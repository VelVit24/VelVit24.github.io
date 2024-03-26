<html>
<head>
    <title>Form</title>
    <meta charset="utf-8">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href='style.css' type="text/css">
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
        <form action="" method="POST">
            <label>Ваше ФИО<br/>
                <input name="name" type="text">
            </label><br/>
            <label>Номер телефона<br/>
                <input name="phone" type="tel">
            </label><br/>
            <label>E-mail<br/>
                <input name="email" type="email">
            </label><br/>
            <label>Дата рождения<br/>
                <input name="birthday" type="date">
            </label><br/>
            <label>Пол<br/>
                <input type="radio" name="gender" value="male" checked>  Мужской<br/>
                <input type="radio" name="gender" value="female">  Женский
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
                <textarea name="biography"></textarea>
            </label><br/>
            <label for="cb" class="label-checkbox">
                <input required="required" name="check" type="checkbox" id="cb"> С контрактом ознакомлен(а).
            </label><br/>
            <input type="submit" value="Сохранить">
        </form>
    </div>
</div>
</body>

</html>

