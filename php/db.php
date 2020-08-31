<?php
$servername = "localhost";
$username = "root";
$password = "vertrigo";
$database = "db";

$conn = new mysqli($servername, $username, $password, $database);

session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Получение данных с проверкой на их существовние
function getData($key, $mandatory)
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
        die("Error: " . $sql . "<br>" . $conn->error);
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
//Получить все данные пользователя
function getFullUserData($field, $username)
{
    return doQuerry('SELECT * FROM user WHERE ' . $field . ' = "' . $username . '"');
}

function getUserProfileData($username)
{
    return doQuerry('SELECT username, firstname, lastname, middlename FROM user WHERE  username = "' . $username . '"');
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
        doQuerry('INSERT INTO user VALUES (id,' . arrToString($userData) . ',' . arrayFromRes(getFromTable('role', 'role_name', 'user'))['role_id'] . ')');
        return true;
    } else {
        echo ("DIDN't pass username/email check<br>");
    }
    return false;
}

function isUserLogged()
{
    if (array_key_exists('user', $_SESSION)) {
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
    return arrayFromRes(getFromTable('game', 'game_name', $gamename))['game_id'];
}

function getStateID($statename)
{
    return arrayFromRes(getFromTable('session_state', 'state_name', $statename))['state_id'];
}
//Вернуть все сессии
function getSessionInfo($session)
{
    return arrayFromRes($session);
}

function getSessions()
{
    return getMultipleRowsArr(doQuerry('SELECT * FROM session'));
}

//Создать игру
function createSession($session_name, $session_info, $game_name)
{
    return doQuerry('INSERT INTO session VALUES(session_id,' . getGameID($game_name) . ',' . getStateID('open') . ',' . arrToString(array($session_name, $session_info)) . ')');
}

