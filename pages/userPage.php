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
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js" integrity="sha256-w8BXa9KXx+nmhO9N4hupvlLy+cAtqEarnB40DVJx2xA=" crossorigin="anonymous"></script>
</head>

<body class="page">
    <header>

    </header>
    <main>
        <section class="profile profile_position-left">
            <img class="profile__avatar">
            <h1 class="profile__title"><?php echo ($_SESSION["user"]["username"]); ?></h1>
            <p class="profile__subtitle">ФИО : <?php echo ($_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"] . " " . $_SESSION["user"]["middlename"]) ?></p>
            <p class="profile__subtitle">Ваш балланс: <?php echo (getUserMoney($_SESSION["user"]["id"]))?></p>

            <form class="form" action="userAuth.html" method="POST">
                <button class="button button_type-money" type="submit">Пополнить балланс</button>
                <button class="button button_type-home" formaction="../index.php">На главную страницу</button>
            </form>
        </section>
        <section class="chart_container">
            <canvas id="chart"></canvas >
        </section>
        
        <?php echo '<script>const sqlData ='.(getUserMoneyAgg($_SESSION["user"]["id"])).'</script>'?>
        <script>
            const data = Object.values(sqlData).map(_ => _.total)
            const ctx = document.getElementById('chart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array(data.length).fill(''),
                    datasets: [{
                        label: 'Баланс пользователя',
                        data,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        pointHoverBorderColor: 'rgba(255, 255, 255, 1)'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            </script>
        
    </main>
    <footer></footer>
</body>

</html>