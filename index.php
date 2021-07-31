<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>"New Book" интернет-магазин здорового читателя</title>
</head>
<body>
<?php
include 'config.php';
include 'functions.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$offset = $limit * ($page - 1);
$books = get_books($limit, $offset);
//чтоб получить количество страниц в постраничной навигации - нам нужно знать общее количество книг в бд. Пишем функцию getAllBooksCount, которая вернет количество книг
$allBooksCount = getAllBooksCount();
//Допустим она вернула 8. Делим количество книг на лимит и округляем в большую сторону. Округление сам доделаешь.
$pageCount = ceil($allBooksCount / $limit);
?>
<!-- header -->
<?php include 'parts/header.php'; ?>
<?php if (empty($books)) : ?>
<?php include '404.php'; ?>
<?php else : ?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Дорогие читатели!</h1>
            <p>Приветстуем Вас в нашем интернет-магазине.<br>
                Мы рады предложить вам огромный выбор книг на любой вкус, как от нашего издательства, так и мировую
                художественную литературу и даже самиздат! Наслаждайтесь выбором! </p>
        </div>
    </div>
    <?php endif;?>
    <div class="container">
        <!-- Catalog -->
        <div class="card-list">
            <!-- $key cейчас не используется никак, можно без него -->
            <?php foreach ($books as $book): ?>
                <div class="row card-item mb-4 pb-4 border-bottom">
                    <div class="col-md-3">
                        <img class="card-img" src="<?= $book['image']; ?>">
                    </div>
                    <div class="col-md-9">
                        <h2><?= $book['nameBook']; ?></h2>
                        <h6>Автор:<a href="/author?id=<?= $book['author_id']; ?>"> <?= $book['name']; ?> </a></h6>
                        <p><?= truncate_string($book['description'], 480); ?></p>
                        <p class="text-small"><span class="font-weight-bold">год издания:</span> <?= $book['year']; ?>
                        </p>
                        <p class="text-small"><span class="font-weight-bold">жанр:</span> <a
                                    href="/genre?id=<?= $book['genre_id']; ?>"><?= $book['nameGenre']; ?></a></p>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
        <!-- pagination -->
        <nav class="text-center" aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Выводим ссылку на предыдущую страницу только если мы на 2 или более странице -->
                <?php if ($_GET['page'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="/?page=<?= $_GET['page'] - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- Выводим в цикле нужное количество страниц -->
                <?php
                for ($i = 1; $i <= $pageCount; $i++) {
                    echo '<li class="page-item"><a class="page-link" href="/?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
                <!-- Выводим ссылку на следующую страницу только если мы не на последней странице -->
                <?php if ($_GET['page'] < $pageCount): ?>
                    <li class="page-item">
                        <a class="page-link" href="/?page=<?= $_GET['page'] + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- /container -->
</main>
<!-- footer -->
<?php include 'parts/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>