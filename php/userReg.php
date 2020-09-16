<?php
include "db.php";

$userData = array(
    "username" => getData("username", true),
    "password" => getData("password", true),
    "firstName" => getData("firstname", true),
    "lastName" => getData("lastname", true),
    "middleName" => getData("middlename", false),
    "email" => getData("email", true),
);

function SendMail($email, $userName)
{
    $subject = 'Спасибо за регистрацию';
    $message = 'Ваш аккаунт: ' . $userName . ' был успешно создан, ждем вас в нашем казино!';
    $headers = 'From: http://phpcasino123.000webhostapp.com/';
    return mail($email, $subject, $message, $headers);
}

if (saveUserData($userData)) {
    SendMail($userData['email'], $userData['username']);
    header("Location: ../index.php");
} else {
    echo ("Something went wrong");
}
