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
        <h1 class="header__title">Добро пожаловать в наше казино!</h1>
    </header>
    <main class="content">
        <section class="sessions">
            <nav class="sessions__navbar">
              
            </nav>

            <form class="sessions__list" action="./php/joingame.php" method="POST">
                <div class="session session_type-option">
                    <p class="session__name">Пользователи</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>

                </div>

                <div class="session session_type-option">
                    <p class="session__name">Сессии</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>

                </div>

                <div class="session session_type-option">
                    <p class="session__name">Роли</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>

                </div>

                <div class="session session_type-option">
                    <p class="session__name">Источники пополнения</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>


                </div>
                <div class="session session_type-option">
                    <p class="session__name">История игр пользователя</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>


                </div>
                <div class="session session_type-option">
                    <p class="session__name">История пополнений пользователя</p>
                    <button name="session" class="session__button session__button_type-join" value="{SESSION_ID}"
                        style="grid-column: -2">Посмотреть</button>


                </div>

            </form>

        </section>
        <nav class="navbar navbar_position-right">
            <section class="profile">
                <h1 class="profile__title">Управление</h1>

                <form class="form" action="userAuth.html" method="POST">
                    <button class="button button_type-home" formaction="../userPage.php">Ваша страница</button>
                    <button class="button button_type-logout" formaction="../logout.php">Выйти из системы</button>
                </form>

            </section>
        </nav>
    </main>
    <footer class="footer">

    </footer>
</body>

</html>