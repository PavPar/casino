<?php
include "db.php";

if (checkUserPassword(getData("login", true), getData("password", true))) {
    echo("We did it");
} else {
    echo("Something went wrong");
}