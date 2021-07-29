<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <title>Author</title>
   </head>
   <body>
      <!-- header -->
      <?php include 'parts/header.php'; ?>
      <?php
      include 'config.php';
      include 'functions.php';
      $id = isset($_GET['id']) ? $_GET['id'] : 1;
      $booksAuthors = get_booksAuthors($id);
      ?>
      <main role="main">
         <?php
         $result = get_author($id);
         if (!empty($result)) {
         $author  = $result[0];
         }
         if(empty($author)) : ?>
         <?php include '404.php'; ?>
         <?php else : ?>
         <div class="jumbotron">
            <div class="container">
               <h1 class="display-3"><?=$author['name']; ?></h1>
               <p>Авторы, бла, бла, неотемлимая часть книги, бла, бла. без них, бла, бла, ничего бы не вышло</p>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <img class="img-fluid" src="<?=$author['image']; ?>" alt="">
               </div>
               <div class="col-md-8">
                  <?=$author['biography']; ?>
               </div>
            </div>
         </div>
         <?php endif; ?>
         <?php if(!empty($author)) : ?>
         <div class="container">
            <h2 class="mb-4">Книги автора:</h2>
            <!-- Catalog -->
            <?php foreach ($booksAuthors as $booksAuthorId): ?>
            <div class="card-list">
               <div class="row card-item mb-4 pb-4 border-bottom">
                  <div class="col-md-3">
                     <img class="card-img" src="<?=$booksAuthorId['image']; ?>">
                  </div>
                  <div class="col-md-9">
                     <h2><?=$booksAuthorId['nameBook']; ?></h2>
                     <h6>Автор: <a href="/author?id=<?=$booksAuthorId['author_id'];?>"> <?=$booksAuthorId['name']; ?> </a> </h6>
                     <p><?=truncate_string($booksAuthorId['description'],480); ?></p>
                     <p class="text-small"><span class="font-weight-bold">год издания:</span> <?=$booksAuthorId['year']; ?></p>
                      <p class="text-small"><span class="font-weight-bold">жанр:</span><a href="/genre?id=<?=$booksAuthorId['genre_id'];?>"> <?=$booksAuthorId['nameGenre']; ?></a></p>
                  </div>
               </div>
            </div>
            <?php endforeach; ?>
         </div>
         <?php endif; ?>
      </main>
      <!-- footer -->
      <?php include 'parts/footer.php'; ?>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   </body>
</html>