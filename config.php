<?php
   $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'mysql'; //имя пользователя, по умолчанию это root
$password = 'mysql'; //пароль, по умолчанию пустой
$db_name = 'storeBooks'; //имя базы данных
//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);


?>