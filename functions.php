<?php
// вывод книг для индекс
function get_books($limit, $offset)
{include 'config.php';
//Делаем запрос к БД, результат запроса пишем в $result:
mysqli_query($link, "SET NAMES 'utf8'");
//Формируем тестовый запрос:
$query = "SELECT  books.nameBook, authors.name,  books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
ORDER BY books.nameBook ASC
LIMIT $limit OFFSET $offset ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
// считаем количество книг
function getAllBooksCount()
{include 'config.php';
$query = "SELECT COUNT(*) as count FROM books";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_fetch_assoc($result) ['count'];
return $count;
}
// считаем количество авторов
function getAllAuthorsCount()
{
include 'config.php';
$query = "SELECT COUNT(*) as count FROM authors";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_fetch_assoc($result) ['count'];
return $count;
}
/*
Функция получает какую-то строку, не обязательно это будет описание книги. В дальшейшем мы будем ее использовать чтоб и другие вещи обрезать. Поэтому назовем строку нейтрально - текст. Длину строки передаем вторым необязательным параметром.
*/
//обрезаем строку
function truncate_string($text, $length = 480)
{
//если длина строки меньше или равна нужной длине - возвращаем ее в исходном виде
if (mb_strlen($text) <= $length){
return $text;
}
//иначе обрезаем
return mb_strimwidth($text, 0, $length, "...");
}
//выводим авторов
function get_authors()
{include 'config.php';
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT * FROM authors ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
// выводим автора по id
function get_author($id)
{include 'config.php';
mysqli_query($link, "SET NAMES 'utf8'");
$query =  "SELECT * FROM authors
WHERE authors.author_id =$id
ORDER BY name ASC
LIMIT 1";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
//выводим все книги автора по id
function get_booksAuthors($id)
{include 'config.php';
//Делаем запрос к БД, результат запроса пишем в $result:
mysqli_query($link, "SET NAMES 'utf8'");
//Формируем тестовый запрос:
$query = "SELECT  books.nameBook, authors.name,  books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
WHERE authors.author_id = $id
ORDER BY books.nameBook ASC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
//выводим все жанры
function get_genres()
{include 'config.php';
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT * FROM genres ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
// выводим жанры по id
/*function get_genre($id)
{include 'config.php';
mysqli_query($link, "SET NAMES 'utf8'");
$query =  "SELECT * FROM genres
WHERE genres.genre_id = $id
ORDER BY nameGenre ASC
LIMIT 1";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
*/
// выводим книги по жанрам
function get_booksGenre($id)
{include 'config.php';
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT  books.nameBook, authors.name, genres.descriptionGenre, authors.author_id, books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
WHERE genres.genre_id = $id
ORDER BY books.nameBook ASC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
return $data;
}
function get_message() {
$message = 'Вам новое письмо <br>';
$message .= 'Имя: ' . $_POST['lastname'] . '<br>';
$message .= 'Фамилия: ' . $_POST['firstname'] . '<br>';
$message .= 'Насколько любит читать: ' . $_POST['like_reading'] . '<br>';
$message .= 'Любимые жанры: ' . implode(', ', $_POST['genre']) . '<br>';
$message .= 'Читает : ' .  $_POST['number_of_books'] . ' книги в месяц' . '<br>';
$message .= 'Информация о читателе: ' . $_POST['about'] ;
return $message;}
function check_length($value, $min, $max) {
$result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
return !$result;
}
/*if (isset($_POST['submit'])) {
<?php if (check_length($_POST['firstname'],2,50)):?>

$message = get_message();
$From_mail = $_POST['Email'];
mail('NewBook@example.com', 'О читателе', $message, "From: $From_mail" );} */