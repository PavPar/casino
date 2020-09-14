<?php include "../../php/admin-control.php"?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Онлайн Казино</title>
    <link rel="stylesheet" type="text/css" href="../../styles/index.css">
</head>

<body class="page">
    <header class="header">
        <h1 class="header__title">Контроль</h1>
    </header>
    <main class="content">
        <section class="sessions">
            <nav class="sessions__navbar">
                <div></div>
            </nav>

            <?php echo(getValTPL(getData('table_name', true)))?>

        </section>
        <nav class="navbar navbar_position-right">
            <section class="profile">
                <h1 class="profile__title">Управление</h1>

                <form class="form" action="userAuth.html" method="POST">
                    <button class="button button_type-home" formaction="./admin.html">Страница управления</button>
                    <button class="button button_type-home" formaction="../../index.php">На главную</button>
                    <button class="button button_type-logout" formaction="../logout.php">Выйти из системы</button>
                </form>

            </section>
        </nav>
    </main>
    <footer class="footer">

    </footer>
</body>

</html>