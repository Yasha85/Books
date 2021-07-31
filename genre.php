<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Genre</title>
</head>
<body>
<!-- header -->
<?php
include('parts/header.php');
include('functions.php');
include('config.php');
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$booksGenre = get_booksGenre($id);
$result = get_booksGenre($id);
if (!empty($result)) {
    $genre = $result[0];
}
$uniqueAuthors = [];
foreach ($booksGenre as $item) {
    $uniqueAuthors[$item['author_id']] = $item['name'];
} ?>
<?php
if (empty($genre)) : ?>
    <?php
    include '404.php'; ?>
<?php
else : ?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?= $genre['nameGenre']; ?></h1>
            <p>Хороший выбор) Почитайте подробнее о жанре и выберите книгу по душе!!!</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?= $genre['descriptionGenre']; ?>
            </div>
        </div>
    </div>
    <?php
    endif; ?>
    <?php
    if (!empty($genre)) : ?>
        <hr>
        <div class="mb-4 mt-4 container">
            <h2 class="mb-4">В этом жанре писали следующие авторы:</h2>
            <?php
            foreach ($uniqueAuthors as $authorId => $authorName): ?>
                <ul>
                    <li><a href="/author?id=<?= $authorId; ?>"> <?= $authorName; ?> </a></li>

                </ul>
            <?php
            endforeach; ?>
        </div>
        <hr>
        <div class="container">
            <h2 class="mb-4">Книги жанра:</h2>
            <!-- Catalog --><?php
            foreach ($booksGenre as $booksGenreId): ?>
                <div class="card-list">
                    <div class="row card-item mb-4 pb-4 border-bottom">
                        <div class="col-md-3">
                            <img class="card-img" src="<?= $booksGenreId['image']; ?>">
                        </div>
                        <div class="col-md-9">
                            <h2><?= $booksGenreId['nameBook']; ?></h2>
                            <h6>Автор: <a
                                        href="/author?id=<?= $booksGenreId['author_id']; ?>"> <?= $booksGenreId['name']; ?> </a>
                            </h6>
                            <p><?= truncate_string($booksGenreId['description'], 480); ?></p>
                            <p class="text-small"><span
                                        class="font-weight-bold">год издания:</span> <?= $booksGenreId['year']; ?></p>
                            <p class="text-small"><span class="font-weight-bold">жанр:</span> <a
                                        href="/genre?id=<?= $booksGenreId['genre_id']; ?>"> <?= $booksGenreId['nameGenre']; ?> </a>
                            </p>
                        </div>
                    </div>

                </div>
            <?php
            endforeach; ?>
        </div>
    <?php
    endif; ?>
</main>
<!-- footer -->
<?php
include('parts/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>