<?php
include "db.php";



// if(array_key_exists('user', $_SESSION)){
//     header("Location: ../pages/userPage.php");
// }

if (checkUserPassword(getData("login", true), getData("password", true))) {
    $_SESSION["user"] = arrayFromRes(getUserProfileData(getData("login", true)));
    header("Location: ../index.php");
} else {
    header("Location: ../pages/userLogin.php");
}
