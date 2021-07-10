<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <title>Writetous</title>
   </head>
   <body>
      <!-- header -->
      <?php include 'parts/header.php';
      include 'functions.php';
      include 'config.php';
      ?>
      <main role="main">
         <div class="jumbotron">
            <div class="container">
               <h1 class="display-3">Напишите нам</h1>
               <p>Тут вы можете рассказать немного о себе, чтобы нам было легче подобрать книгу для любого нашего читателя! </p>
            </div>
         </div>
      </main>
      
      <?php if (isset($_POST['submit'])): ?>
      <?php if ((mb_strlen($_POST['firstname'])) < 2) {$errors[] ='Фамилия слишком короткая';}
      if ((mb_strlen($_POST['firstname'])) > 50) {$errors[] = 'Фамилия слишком длинная';}
      if ((mb_strlen($_POST['lastname'])) < 2) {$errors[] = 'Имя слишком короткое';}
      if ((mb_strlen($_POST['lastname'])) > 50) {$errors[] = 'Имя слишком длинное';}
      if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))  {$errors[] = 'Email - не валидный';}
      if (empty($_POST['genre'])) {$errors[]= 'Выберите хотя бы один жанр';}
      ?>
      <?php  if (empty($errors)):?>
      <?php
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $Email = $_POST['Email'];
      $genre = implode(', ', $_POST['genre']);
      $number_of_books = $_POST['number_of_books'];
      $like_reading = $_POST['like_reading'];
      $about = $_POST['about'];
      if($link->connect_error){
      die("Ошибка: " . $link->connect_error);
      }
      mysqli_query($link, "SET NAMES 'utf8'");
      $query = "INSERT INTO `readers`(`firstname`, `lastname`, `Email`, `genre`,`number_of_books`,`like_reading`,`about`)
      VALUES ('$firstname','$lastname','$Email','$genre', '$number_of_books','$like_reading','$about')";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      ?>
      <div class="alert alert-success" role="alert">
         Сообщение успешно отправлено!
      </div>
      <?php
      $message = get_message();
      $From_mail = $_POST['Email'];
      mail('NewBook@example.com', 'О читателе', $message, "From: $From_mail" ); ?>
      <?php else:?>
      <div class="alert alert-danger" role="alert">
         <?php foreach($errors as $err) {
         echo $err . "<br/>";
         }  ?>
      </div>
      <?php endif;?>
      <?php endif;?>
      <div class="container">
         <form action="" method="post">
            <div class="form-group">
               <label for="exampleFormControlInput1">Ваша фамилия</label>
               <input type="text" class="form-control"<?php if ((!empty($_POST)) && (!empty($errors))):?> value="<?=$_POST['firstname'] ?? '';?>" <?php endif; ?> name="firstname" placeholder="Иванов(а)">
               <label for="exampleFormControlInput1">Ваше имя</label>
               <input type="text" class="form-control"<?php if((!empty($_POST)) && (!empty($errors))):?> value="<?=$_POST['lastname'] ?? '';?>" <?php endif; ?> name="lastname" placeholder="Иван(а)">
            </div>
            <div class="form-group">
               <label for="exampleFormControlInput1">Ваша электронная почта</label>
               <input type="text" class="form-control" <?php if((!empty($_POST)) && (!empty($errors))):?> value="<?=$_POST['Email'] ?? '';?>" <?php endif; ?> name="Email"  placeholder="name@example.com">
            </div>
            <div class="form-group">
               <label for="exampleFormControlSelect1">Сколько книг за год вы читаете?</label>
               <select class="form-control" name="number_of_books">
                  <option <?php if((!empty($_POST)) && (!empty($errors)) && ($_POST['number_of_books']) === '1'): ?>selected="selected"<?php endif; ?>  value="1" >1</option>
                  <option <?php if((!empty($_POST)) && (!empty($errors)) && ($_POST['number_of_books']) === '2'): ?>selected="selected"<?php endif; ?>  value="2" >2</option>
                  <option <?php if((!empty($_POST)) && (!empty($errors)) && ($_POST['number_of_books']) === '3'): ?>selected="selected"<?php endif; ?>  value="3" >3</option>
                  <option <?php if((!empty($_POST)) && (!empty($errors)) &&  ($_POST['number_of_books']) === '4'): ?>selected="selected"<?php endif; ?>  value="4" >4</option>
                  <option <?php if((!empty($_POST)) && (!empty($errors)) && ($_POST['number_of_books']) === '5'): ?>selected="selected"<?php endif; ?>  value="5" >5</option>
               </select>
            </div>
            Какие жанры любишь?<br>
            <div class="form-check">
               <input class="form-check-input" type="checkbox"<?php if((!empty($_POST['genre'])) && (!empty($errors)) && (in_array('Антиутопия',$_POST['genre']))): ?>      checked="checked"<?php endif; ?> value="Антиутопия" name="genre[]">
               <label class="form-check-label" for="defaultCheck1">
                  Антиутопия
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="checkbox"<?php if((!empty($_POST['genre'])) && (!empty($errors)) && (in_array('Юмор',$_POST['genre']))): ?>      checked="checked"<?php endif; ?> value="Юмор" name="genre[]">
               <label class="form-check-label" for="defaultCheck2">
                  Юмор
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="checkbox"<?php if((!empty($_POST['genre'])) && (!empty($errors)) && (in_array('Фэнтези',$_POST['genre']))): ?>      checked="checked"<?php endif; ?> value="Фэнтези" name="genre[]">
               <label class="form-check-label" for="defaultCheck3">
                  Фэнтези
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="checkbox"<?php if((!empty($_POST['genre'])) && (!empty($errors)) && (in_array('Приключения',$_POST['genre']))): ?>      checked="checked"<?php endif; ?> value="Приключения" name="genre[]">
               <label class="form-check-label" for="defaultCheck4">
                  Приключения
               </label>
            </div>
            <div class="form-group">
               <label for="exampleFormControlSelect2">Насколько вы любите читать?</label>
               <select multiple class="form-control" name="like_reading">
                  <option value="Совсем нет">Совсем нет</option>
                  <option value="Не очень">Не очень</option>
                  <option value="Средненько">Средненько</option>
                  <option value="Сильно">Сильно</option>
                  <option value="Очень сильно">Очень сильно</option>
               </select>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Расскажите о себе</label>
               <textarea class="form-control" name="about" rows="3"></textarea>
               <input type="submit" value="Отправить" name="submit">
            </div>
         </form>
      </div>
      <!-- footer -->
      <?php include 'parts/footer.php'; ?>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   </body>
</html>