<?php 
include "./php/index_tpl.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Онлайн Казино</title>
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
</head>

<body class="page">
    <header class="header">
        <h1 class="header__title">Добро пожаловать в казино!</h1>
    </header>
    <main class="content">
    <section class="sessions">
            <nav class="sessions__navbar">
                <?php
                if (isUserLogged()) echo '<form action="./pages/createGame.php" method="POST">
                    <button class="good_button">Создать игру</button>
                </form>'
                ?>
                <!-- <button>Записанные игры</button>
                <button>Завершенные игры</button> -->
            </nav>
            <form class="sessions__list" action="./pages/joinGame.php" method="POST">
            <?php 
            $sessions = getSessions();
            consolelog(json_encode($sessions));
            for ($i = 0; $i < count($sessions); $i++) {
                setCardTPL( $sessions[$i]['name'], $sessions[$i]['info'], "0", "0", $sessions[$i]['session_id'], $sessions[$i]['state']);
            }
            
                 
            ?>
            </form>
        </section>
        <nav class="navbar navbar_position-right">
            <?php  getTpl();     ?>
        </nav>
    </main>
    <footer class="footer">

    </footer>
</body>

</html>