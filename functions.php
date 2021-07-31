<?php
include 'config.php';
$GLOBALS['pdo'] = new PDO($dsn, $user, $password, $opt);
// вывод книг для индекс
function get_books($limit, $offset)
{
    include 'config.php';

//Формируем тестовый запрос:
    $stmt = $GLOBALS['pdo']->prepare("SELECT  books.nameBook, books.author_id, authors.name, books.genre_id, books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
ORDER BY books.nameBook ASC
LIMIT $limit OFFSET $offset ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// считаем количество книг
function getAllBooksCount()
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT COUNT(*) as count FROM books");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
}

// считаем количество авторов
function getAllAuthorsCount()
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT COUNT(*) as count FROM authors");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
}

/*
Функция получает какую-то строку, не обязательно это будет описание книги. В дальшейшем мы будем ее использовать чтоб и другие вещи обрезать. Поэтому назовем строку нейтрально - текст. Длину строки передаем вторым необязательным параметром.
*/
//обрезаем строку
function truncate_string($text, $length = 480)
{
//если длина строки меньше или равна нужной длине - возвращаем ее в исходном виде
    if (mb_strlen($text) <= $length) {
        return $text;
    }
//иначе обрезаем
    return mb_strimwidth($text, 0, $length, "...");
}

//выводим авторов
function get_authors()
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM authors ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// выводим автора по id
function get_author($id)
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM authors
WHERE authors.author_id =?
ORDER BY name ASC
LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//выводим все книги автора по id
function get_booksAuthors($id)
{
    include 'config.php';
//Делаем запрос к БД, результат запроса пишем в $result:
    $stmt = $GLOBALS['pdo']->prepare("SELECT  books.nameBook, books.author_id, books.genre_id, authors.name,  books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
WHERE authors.author_id = ?
ORDER BY books.nameBook ASC");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//выводим все жанры
function get_genres()
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT * FROM genres ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// выводим жанры по id
/*function get_genre($id)
{include 'config.php';
$stmt = $GLOBALS['pdo']->prepare  ("SELECT * FROM genres
WHERE genres.genre_id = ?
ORDER BY nameGenre ASC
LIMIT 1");
$stmt->execute([$id]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
*/
// выводим книги по жанрам
function get_booksGenre($id)
{
    include 'config.php';
    $stmt = $GLOBALS['pdo']->prepare("SELECT  books.nameBook, authors.name, books.genre_id, genres.descriptionGenre, authors.author_id, books.description, genres.nameGenre, books.year, books.image
FROM books
INNER JOIN authors ON authors.author_id=books.author_id
INNER JOIN genres ON genres.genre_id=books.genre_id
WHERE genres.genre_id = ?
ORDER BY books.nameBook ASC");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_message()
{
    $message = 'Вам новое письмо <br>';
    $message .= 'Имя: ' . $_POST['lastname'] . '<br>';
    $message .= 'Фамилия: ' . $_POST['firstname'] . '<br>';
    $message .= 'Насколько любит читать: ' . $_POST['like_reading'] . '<br>';
    $message .= 'Любимые жанры: ' . implode(', ', $_POST['genre']) . '<br>';
    $message .= 'Читает : ' . $_POST['number_of_books'] . ' книги в месяц' . '<br>';
    $message .= 'Информация о читателе: ' . $_POST['about'];
    return $message;
}

function check_length($value, $min, $max)
{
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}
