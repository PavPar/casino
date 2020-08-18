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

if (saveUserData($userData)) {
    echo ("We did it");
} else {
    echo ("Something went wrong");
}
