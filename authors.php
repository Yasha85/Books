<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Authors</title>
</head>
<body>
<?php
include 'config.php';
include 'functions.php';
$authors = get_authors();
?>
<?php include 'parts/header.php'; ?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Внимание!</h1>
            <p>Эта страница посвящена нашим любимым авторам, здесь вы можете почитать их биографию и посмотреть как они
                выглядят) </p>
        </div>
    </div>
    <div class="container marketing">
        <?php foreach ($authors as $key => $author): ?>
            <div class="row featurette">
                <div class="col-md-7 <? if (($key + 1) % 2 == 0) {
                    echo 'order-md-2';
                } ?> ">
                    <h2 class="featurette-heading"><?= $author['name']; ?></h2>
                    <p class="lead"><?= truncate_string($author['biography'], 300); ?></p>
                    <a class="btn btn-lg btn-primary" href="/author?id=<?= $author['author_id']; ?>" role="button">Подробнее</a>
                </div>
                <div class="col-md-5 <? if (($key + 1) % 2 == 0) {
                    echo 'order-md-1';
                } ?>">
                    <a href="/author?id=<?= $author['author_id']; ?>"><img class="featurette-image img-fluid mx-auto"
                                                                           src="<?= $author['image']; ?>"></a>
                </div>
            </div>
            <hr class="featurette-divider">
        <?php
        endforeach; ?>
</main>
</div>
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