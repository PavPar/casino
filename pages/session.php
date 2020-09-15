
<?php
  include "../php/index_tpl.php";
  checkAuth("./userLogin.php");
  if (null === getData("id")) {
    //header("Location: ../index.php");
  } else {
    $session = getSessionInfo(getData("id", true));
    $game = getGameInfo($session["game_id"]);
    consolelog(json_encode($game));
    if ($session['starts_at'] < time()) {
      $count = getSessionResult($_SESSION["user"]["id"], getData("id", true))[0]['amount'];
      $wintext = $count < 0 ? "Проигрыш!":"Выигрыш!";
      if ($count > 0) $count ='+' . $count;
    } else {
      $wintext = '';
      $count = '00:00:00';
    }
  }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game['game_name'];?></title>
    <link rel="stylesheet" href="../styles/join.css">
    <script>
      const startsAt = <?php echo $session['starts_at'];?> + 5
    </script>
</head>

<body class="page">
    <header>
    <form class="form" method="POST">
      <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
    </form>
    </header>
    <div class="join-container">
      <div class='user-list form-flex' >
        <p id="win-statnent" class="timer"><?php echo $wintext;?></p> 
        <p id="timer" class="timer"><?php echo $count;?></p>
        <h1>Список Игроков</h1>
        <ul>
          <?php 
            $players = getSessionPlayers(getData("id", true));
            foreach($players as $x)
            {
                echo '<li>' . $x[ 'firstName' ] .' ' . $x[ 'middleName' ].' '. $x[ 'lastName' ]. '</li>';
            }
              ?>
        </ul>
      </div> 
      <div class='game-desc'>
        <?php 
          setGameDescTPL($session['name'], $session['info'], $game['game_name'], $game['rules'], $game['game_slug']);  
        ?>
      </div> 
    </div>
    <script>
      let countDownDate = startsAt * 1000
      if (countDownDate > Date.now()) {
        let x = setInterval(function() {
          let now = Date.now()
          let distance = countDownDate - now;
          let hours = Math.floor(distance / (1000 * 60 * 60))+'';
          let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)) +'';
          let seconds = Math.floor((distance % (1000 * 60)) / 1000) +'';

          document.getElementById("timer").innerHTML = hours.padStart(2, '0') + ":" + minutes.padStart(2, '0') + ":" + seconds.padStart(2, '0');
          if (distance < 0) {
            clearInterval(x);
            location.reload();
          }
        }, 1000);
      }
    </script>
    <footer></footer>
  </body>
</html>