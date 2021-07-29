<?php
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'mysql'; //имя пользователя, по умолчанию это root
$password = 'mysql'; //пароль, по умолчанию пустой
$db_name = 'storebooks'; //имя базы данных
//Соединяемся с базой данных используя наши доступы:
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES  => false,
];
$pdo = new PDO($dsn, $user, $password, $opt);


