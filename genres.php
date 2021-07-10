<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <title>Genres</title>
   </head>
   <body>
      <!-- header -->
      <?php
      include 'parts/header.php';
      include 'config.php';
      include 'functions.php';
      $get_genres=get_genres();
      ?>
      <main role="main">
         <div class="jumbotron">
            <div class="container">
               <h1 class="display-3">Тут список жанров</h1>
               <p>Выбрать подходящую книгу легче всего по жанру. Перейдите по ссылке интересующего жанра и вы увидите книги и авторов.</p>
            </div>
         </div>
         <div class="container marketing">
            <div class="row">
               <?php foreach ($get_genres as $key => $genre):?>
               <div class="col-md-4">
                  <div class="card mb-4 box-shadow">
                     <div class="card-body">
                        <p class="card-header text-bold"><a href="/genre?id=<?=$genre['genre_id'];?>"><?=$genre['nameGenre'];?></a></p>
                        <p class="card-text"><?=truncate_string($genre['descriptionGenre'],100)?></p>
                     </div>
                  </div>
               </div>
               <?php
               endforeach; ?>
            </div>
         </div>
      </main>
      <!-- footer -->
      <?php include 'parts/footer.php'; ?>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   </body>
</html>