
<?php
include "../php/index_tpl.php";
checkAuth("./userLogin.php");
$games = getGames();

function addOption($row, $field_id, $field_name)
{
    return ' <option value="' . $row[$field_id] . '">' . $row[$field_name] . '</option>';
}

function getListOptions($table_name, $field_id, $field_name)
{
    $result = getAllFromTable($table_name);

    $res = '';
    while ($row = $result->fetch_assoc()) {
        $res = $res . addOption($row, $field_id, $field_name);
    }

    return $res;
}

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

        <form class="form form_type-admin" name="formReg" action="../php/createGame.php">
                <input class="form__input" placeholder="Имя сессии" name="name" required>
                <input class="form__input" placeholder="Инфо" name="info">

                <select  class="form__input" name="game_id">
                <?php echo(getListOptions('game', 'game_id','game_name')) ?>

                </select>
                 <select class="form__input" name="time" required>
            <option value="120">Через 2 минут</option>
            <option value="300">Через 5 минут</option>
            <option value="900">Через 15 минут</option>
            <option value="1800">Через полчаса</option>
            <option value="3600">Через час</option>
          </select>
                <button class="button button_type-home" type="submit">Добавить</button>
            </form>

        <?php
$games = getGames();
foreach ($games as $game) {
    echo "<div class='game-desc' id='" . $game['game_slug'] . "' style='display:none'>";
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