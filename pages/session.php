
<?php
  include "../php/index_tpl.php";
  checkAuth("./userLogin.php");
  if (null === getData("id")) {
    //header("Location: ../index.php");
  } else {
    $session = getSessionInfo(getData("id", true));
    $game = getGameInfo($session["game_id"]);
    consolelog(json_encode($session));
  }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game['name'];?></title>
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
        <p id="timer" class="timer">00:00:00</p>
        <h1>Список Игроков</h1>
        <ul>
          <?php 
            $players = getSessionPlayers(getData("id", true));
            consolelog(json_encode($players));
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
            window.location =  window.location
          }
        }, 1000);
      }
    </script>
    <footer></footer>
  </body>
</html>