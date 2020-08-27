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
        <h1 class="header__title">Добро пожаловать в наше казино!</h1>
    </header>
    <main class="content">
        <section class="gamesContainer">
            Здесь будут игры
        </section>
        <nav class="navbar navbar_position-right">
            <?php  getTpl();     ?>
        </nav>
    </main>
    <footer class="footer">

    </footer>
</body>

</html>