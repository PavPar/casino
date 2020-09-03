<!DOCTYPE html>
<html lang="ru">
<?php
include "../php/db.php";
checkAuth("./userLogin.php");

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница пользователя</title>
    <link rel="stylesheet" href="../styles/userPage.css">
</head>

<body class="page">
    <header>

    </header>
    <main>
        <section class="profile profile_position-center">
            <img class="profile__avatar">
            <h1 class="profile__title"><?php echo ($_SESSION["user"]["username"]); ?></h1>
            <p class="profile__subtitle">ФИО : <?php echo ($_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"] . " " . $_SESSION["user"]["middlename"]) ?></p>
            <p class="profile__subtitle">Ваш балланс: <?php echo (getUserMoney($_SESSION["user"]["id"]))?></p>

            <form class="form" action="userAuth.html" method="POST">
                <button class="button button_type-money" type="submit">Пополнить балланс</button>
                <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
            </form>
        </section>
    </main>
    <footer></footer>
</body>

</html>