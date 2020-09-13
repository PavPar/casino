
<?php
  include "../php/index_tpl.php";
  checkAuth("./userLogin.php");
  consolelog(json_encode($_SESSION["user"]));
  if (null === getData("session")) {
    header("Location: ../index.php");
  } else if (null !== getData("bet")) {
    echo (joinSession($_SESSION["user"]["id"], getData("session", true), getData("bet", true)));
    header("Location: ./session.php?id=" . getData("session", true));
  } else {
    $session = getSessionInfo(getData("session", true));
    $game = getGameInfo($session["game_id"]);
    consolelog(json_encode($session));
  }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Присоедениться</title>
    <link rel="stylesheet" href="../styles/join.css">
</head>

<body class="page">
    <header>
    <form class="form" method="POST">
      <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
    </form>
    </header>
    <div class="join-container">
        <form class="form join-form" name="formReg">
            <h2><?php echo 'Введите сумму от ' .$game['min_bet']. ' до ' .$game['max_bet'];  ?></h2>
            <br>
            <input class="form__input" value=<?php echo $game['min_bet'];?> name="bet" type="number" id="quantity" min=<?php echo $game['min_bet'];?> max=<?php echo $game['max_bet'];?> required>
            <button class="make_bet" type="submit">Присоединиться</button>
            <input hidden name="session" value=<?php echo $session['session_id'];?> ></input>
        </form>
        <div class='game-desc'>
        <?php 
            setGameDescTPL($session['name'], $session['info'], $game['game_name'], $game['rules']);  
            ?>
        </div> 
    </div>
    <footer></footer>
</body>
</html>