<?php
include('/home/u67330/sql.php');
$db = new PDO('mysql:host=localhost;dbname=u67330', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>