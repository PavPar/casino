<?php
include "db.php";

if(array_key_exists('user', $_SESSION)){
    header("Location: ../pages/userPage.html");
}

if (checkUserPassword(getData("login", true), getData("password", true))) {
    $_SESSION["user"] = getUserProfileData(getData("login", true));
    header("Location: ../index.html");
} else {
    header("Location: ../pages/userAuth.html");
}
