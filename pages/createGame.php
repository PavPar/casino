
<?php
  include "../php/index_tpl.php";
  checkAuth("./userLogin.php");
  $games = getGames();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать игру</title>
    <link rel="stylesheet" href="../styles/create.css">
</head>

<body class="page">
    <header>
    <form class="form" method="POST">
      <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
    </form>
    </header>
    <div class='join-container'>
        <form class="form join-form form-flex" name="create">
          <input type="text" name="name" placeholder="Введите название игры" required>
          <input type="text" name="desc" placeholder="Введите комментарий" required>
          <select id="time" name="time" required>
            <option value="120">Через 2 минут</option>
            <option value="300">Через 5 минут</option>
            <option value="900">Через 15 минут</option>
            <option value="1800">Через полчаса</option>
            <option value="3600">Через час</option>
          </select>
          <?php
            foreach ($games as $game) {
              echo '<div><input type="radio" name="game" value="'.$game['game_slug'].'" onclick="radioHandler(this);" required>
              <label for="'.$game['game_slug'].'">'.$game['game_name'].'</label></div>';
            }
          ?>
          <div class="bottom-border-margin"></div>
          <button type='submit' class='good_button'  formaction="../php/createGame.php">Создать</button>
        </form>
        <?php 
          $games = getGames();
          foreach ($games as $game) {
            echo "<div class='game-desc' id='". $game['game_slug'] ."' style='display:none'>";
            setGameDescTPL('', '', $game['game_name'], $game['rules'], $game['game_slug']);  
            echo '</div>';
          }
        ?>
    </div>
    <script>
      function radioHandler(radio) {
        let games = Array.from(document.querySelectorAll('.game-desc'))
        games.forEach(game => game.style.display='none')
        document.getElementById(radio.value).style.display='block'
        console.log(document.getElementById(radio.value))
      }
    </script>
    <footer></footer>
</body>
</html>