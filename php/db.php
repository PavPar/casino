<?php
$servername = "localhost:3306";
$username = "root";
$password = "vertrigo";
$database = "db";

$conn = new mysqli($servername, $username, $password, $database);

session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Получение данных с проверкой на их существовние
function getData($key, $mandatory = false)
{
    if ($mandatory) {
        if (key_exists($key, $_REQUEST)) {
            return $_REQUEST[$key];
        } else {
            die("Mandatory field is empty: " . $key);
            return null;
        }
    } else {
        if (key_exists($key, $_REQUEST)) {
            return $_REQUEST[$key];
        } else {
            return null;
        }
    }

};

//Проверка выполнения SQL запроса в бд
function CheckQuerry($result, $sql)
{
    global $conn;
    if ($result) {
        return $result;
    } else {
        echo ("Error: " . $sql . "<br>" . $conn->error);
        return false;
    }
}

//Выполнить запрос в БД
function doQuerry($sql)
{
    global $conn;
    $result = $conn->query($sql);
    return CheckQuerry($result, $sql);
}

//Проверка что есть данные
function checkForRows($result)
{
    if ($result) {
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }
}

//Получить массив (ключ,значение) из результата запроса
function arrayFromRes($result)
{
    $res = array();
    return $result->fetch_assoc();
}

function getFromTable($table, $field, $value)
{
    return doQuerry('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = "' . $value . '"');
}

function getMultipleRowsArr($result)
{
    $res = array();
    while ($row = $result->fetch_assoc()) {
        // $row = array_values($row);
        array_push($res, $row);
    }
    return $res;
}

function getUserRole($user_id)
{
    return getValueFromRes(getFromTable('user', 'id', $user_id));
}

//Получить все данные пользователя
function getFullUserData($field, $username)
{
    return doQuerry('SELECT * FROM user WHERE ' . $field . ' = "' . $username . '"');
}

function getUserProfileData($username)
{
    return doQuerry('SELECT id,username, firstname, lastname, middlename FROM user WHERE  username = "' . $username . '"');
}

function checkUserPassword($username, $password)
{
    $userData = getFullUserData('username', $username);
    if (checkForRows($userData)) {
        $userData = arrayFromRes($userData);
        if ($userData['password'] == $password) {
            return true;
        }
    }
    return false;
}

//Преобразовать массив данных в строку с разделителями
function arrToString($arr)
{
    print_r($arr);
    $arr = array_values($arr);
    $res = "";
    $res = $res . ' "' . $arr[0] . '"';
    // echo $res;
    for ($i = 1; $i < count($arr); $i++) {
        $res = $res . ', "' . $arr[$i] . '" ';
    }
    return $res;
}

//Производит сохранение данных пользователя в БД (если нет пользователя с таким же имененем и email)
function saveUserData($userData)
{
    if (!checkForRows(getFullUserData('username', $userData['username'])) && !checkForRows(getFullUserData('email', $userData['email']))) {
        doQuerry('INSERT INTO user VALUES (id,' . arrToString($userData) . ', ' . arrayFromRes(getFromTable('role', 'role_name', 'user'))['role_id'] . ')');
        return true;
    } else {
        echo ("DIDN't pass username/email check<br>");
    }
    return false;
}

function getUserRoleID($role_name)
{
    return arrayFromRes(getFromTable('role', 'role_name', $role_name))['role_id'];
}

function isUserLogged()
{
    if (array_key_exists('user', $_SESSION)) {
        return true;
    }
    return false;
}

//Проверка на уровень пользователя
function isUserAdmin($user_id)
{
    $user_roleID = getUserRole($user_id);
    $role_id = getUserRoleID('admin');


    if ($role_id == $user_roleID) {
        return true;
    }
    return false;
}

//Проверка и переход
function checkAuth($authPage)
{
    if (!isUserLogged()) {
        header("Location: " . $authPage);
    }
}

function getGameID($gamename)
{
    return arrayFromRes(getFromTable('game', 'game_slug', $gamename))['game_id'];
}

function getStateID($statename)
{
    return arrayFromRes(getFromTable('session_state', 'state_name', $statename))['state_id'];
}

function getSessionInfo($session_id)
{
    return arrayFromRes(getFromTable('session', 'session_id', $session_id));
}

//Вернуть все сессии
function getSessions()
{
    return getMultipleRowsArr(doQuerry('SELECT * FROM session'));
}

function getGameInfo($game_id)
{
    return arrayFromRes(getFromTable('game', 'game_id', $game_id));
}

function countPlayers($session_id)
{
    return array_values(arrayFromRes(doQuerry('SELECT COUNT(user_id) as players FROM user_session WHERE session_id = ' . $session_id)))[0];
}

function maxPlayers($session_id)
{
    $sessionInfo = getSessionInfo($session_id);
    $gameInfo = getGameInfo($sessionInfo['game_id']);

    return $gameInfo['max_users'];
}

//Создать игру
function createSession($session_name, $session_info, $game_slug)
{
    return doQuerry('INSERT INTO session VALUES(session_id,' . getGameID($game_slug) . ',' . getStateID('open') . ',' . arrToString(array($session_name, $session_info)) . ')');
}

function checkSessionForState($session_id, $state)
{
    $sessionInfo = getSessionInfo($session_id);
    $validity = true;

    if (count($sessionInfo) == 1) {
        $validity = false;
        return $validity;
    }

    if ($sessionInfo['state_id'] != getStateID($state)) {
        $validity = false;
        return $validity;
    }

    return $validity;
}

function isUserInSession($user_id, $session_id)
{
    return checkForRows(doQuerry('SELECT * FROM user_session WHERE user_id = ' . $user_id . ' AND session_id = ' . $session_id));
}

function joinSession($user_id, $session_id, $bet)
{
    $sessionInfo = getSessionInfo($session_id);
    $gameInfo = getGameInfo($sessionInfo['game_id']);

    $flagJOIN = true;

    if (!checkSessionForState($session_id, 'open')) {
        $flagJOIN = false;
        return "err - no session";
    }

    if (isUserInSession($user_id, $session_id)) {
        $flagJOIN = false;
        return "err - user already in session";
    }

    if (countPlayers($session_id) >= $gameInfo['max_users']) {
        $flagJOIN = false;
        return "err - too many users";
    }

    if (!($bet >= $gameInfo['min_bet'] && $bet <= $gameInfo['max_bet'])) {
        $flagJOIN = false;
        return "err - wrong bet value " . $gameInfo['min_bet'] . ' - ' . $bet . ' - ' . $gameInfo['max_bet'];
    }

    if ($flagJOIN) {
        return doQuerry('INSERT INTO user_session VALUES(' . $user_id . ',' . $session_id . ',' . $bet . ')');
    }

    if (countPlayers($session_id) == $gameInfo['max_users']) {
        sessionStart($session_id);
    }
}

function validateSession()
{
    //TODO: later....
    return true;
}

//получаем класс игры
function getGameClass($game_slug)
{
    switch ($game_slug) {
        case "50/50":
            return new random();
        case "rip_money":
            return new solo();
    }
}

function logData($msg, $filepath)
{
    $log = date('Y-m-d H:i:s') . $msg;
    file_put_contents(__DIR__ . $filepath, $log . PHP_EOL, FILE_APPEND);
}

//Установить определенное состояние сесии
function setSessionState($session_id, $state_id)
{
    return doQuerry('UPDATE session SET state_id = ' . $state_id . ' WHERE session_id = ' . $session_id);
}

//Установить выполнено ли пополнение
// function setUserHistoryComplition($session_id, $user_id, $fullfield)
// {
//     return doQuerry('
//     UPDATE user_session_history
//     SET fullfield = ' . $fullfield . '
//     WHERE user_id = ' . $user_id . '
//     AND session_id = ' . $session_id
//     );
// }

//Сохранить информацию о проведенной игре
function saveUserHistory($session_id, $user_id, $bank_id)
{
    return doQuerry('INSERT INTO user_session_history VALUES (' . $session_id . ',' . $user_id . ',' . $bank_id . ')');
}

function addToUserBankEntry($user_id, $amount, $source)
{
    return doQuerry('INSERT INTO user_bank_history VALUES (id,' . $user_id . ',' . $amount . ', "' . $source . '")');
}

function getValueFromRes($res)
{
    return array_values(arrayFromRes($res))[0];
}
function getJsonFromRes($res)
{
    $rows = array();
    while($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
    return json_encode($rows);
}

//Получить деньги пользователя
function getUserMoney($user_id)
{
    return getValueFromRes(doQuerry('SELECT sum(amount) FROM user_bank_history WHERE user_id = ' . $user_id));
}
function getUserMoneyAgg($user_id) 
{
    return getJsonFromRes(doQuerry(' SELECT amount, @total := @total + amount as total
    FROM user_bank_history, (SELECT @total := 0) as dummy WHERE user_id = ' . $user_id . '
    ORDER BY id;'));
}

//Получить ид пользователей сессии
function getSessionUsers($session_id)
{
    $result = doQuerry('SELECT user_id,bet from user_session where session_id = ' . $session_id);
    $res = array();
    while ($row = $result->fetch_assoc()) {
        $res[$row['user_id']] = $row['bet'];

    }
    return $res;
};

function sessionStart($session_id)
{
    global $conn;
    include getcwd() . "/php/games/solo.php";
    if (!validateSession($session_id)) {
        return false;
    }
    try {
        setSessionState($session_id, getStateID('closed'));

        $sessionInfo = getSessionInfo($session_id);
        $gameInfo = getGameInfo($sessionInfo['game_id']);
        $userData = getSessionUsers($session_id);

        $class = getGameClass($gameInfo['game_slug']);
        $gameResults = $class->run($userData);

        print_r($gameResults);

        setSessionState($session_id, getStateID('finished'));

        foreach ($gameResults as $id => $amount) {
            addToUserBankEntry($id, $amount, 'game');
            saveUserHistory($session_id, $id, $conn->insert_id);
        }

    } catch (Exception $e) {
        setSessionState($session_id, getStateID('failed'));
        echo logData('Caught exception: ', $e->getMessage(), "\n", 'session-log.txt');
    }

    return;
}

function consolelog($data) {
    echo '<script>console.log(' . $data .')</script>';
}
// createSession("2", "3","rip_money");