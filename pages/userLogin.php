<?php
session_start();
if(array_key_exists('user', $_SESSION)){
    header("Location: ./userPage.php");
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти/Зарегестрироваться</title>
    <link rel="stylesheet" href="../styles/userAuth.css">
</head>

<body class="page">
    <header>
    <form class="form" method="POST">
      <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
    </form>
    </header>
    <main class="auth">
        <nav class="navbar navbar_position-top">
            <button class="button button_type-login" disabled="true">Войти</button>
            <button class="button button_type-register">Зарегестрироваться</button>
        </nav>

        <form class="form" name="formLog" action="../php/userAuth.php" method="post">
            <input class="form__input" name="login" placeholder="Логин" minlength="3" maxlength="20" required>

            <input class="form__input" name="password" placeholder="Пароль" type="password" minlength="3" maxlength="30"
                required>
            <button class="button button_type-submit" type="submit">Войти</button>
        </form>

        <form class="form form_visibility-hidden" name="formReg" action="../php/userReg.php">
            <input class="form__input" placeholder="Имя" name="firstname" required>
            <input class="form__input" placeholder="Фамилия" name="lastname" required>
            <input class="form__input" placeholder="Отчество" name="middlename">

            <input class="form__input" placeholder="Имя пользователя" name="username" minlength="3" maxlength="20" required>
            <input class="form__input" placeholder="Пароль" type="password" name="password" required>

            <input class="form__input" placeholder="EMail" type="email" name="email" required>
            <button class="button button_type-submit" type="submit">Зарегестрироваться</button>
        </form>
    </main>
    <footer></footer>
</body>
<script src="../js/userAuth/userAuth.js"></script>

</html>